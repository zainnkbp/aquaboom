<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Carbon\CarbonPeriod;
use Filament\Facades\Filament;
use Illuminate\Http\Request;

class AdminDashboardV2Controller extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Enforce staff access to admin panel
        if (!$user || !$user->canAccessPanel(Filament::getPanel('admin'))) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $paidStatuses = ['paid', 'scanned'];

        // 1. Sales Today & Orders Today
        $salesToday = (float) Transaction::whereIn('status', $paidStatuses)
            ->whereDate('created_at', today())
            ->sum('total_price');

        $ordersTodayCount = Transaction::whereIn('status', $paidStatuses)
            ->whereDate('created_at', today())
            ->count();

        // 2. Sales This Month vs Last Month
        $salesThisMonth = (float) Transaction::whereIn('status', $paidStatuses)
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('total_price');

        $salesLastMonth = (float) Transaction::whereIn('status', $paidStatuses)
            ->whereYear('created_at', now()->subMonth()->year)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->sum('total_price');

        $monthGrowthPercent = 0;
        if ($salesLastMonth > 0) {
            $monthGrowthPercent = round((($salesThisMonth - $salesLastMonth) / $salesLastMonth) * 100, 1);
        }

        // 3. Today's Gate Manifest & Attendance
        $todayArrivals = Transaction::whereDate('visit_date', today())
            ->whereIn('status', ['paid', 'scanned', 'pending'])
            ->with(['items.ticketPackage', 'addOns.addOn'])
            ->orderBy('is_redeemed', 'asc')
            ->orderBy('updated_at', 'desc')
            ->get();

        $todayExpectedPax = 0;
        $todayCheckedInPax = 0;
        foreach ($todayArrivals as $tx) {
            $pax = $tx->items->sum('quantity') ?: 1;
            $todayExpectedPax += $pax;
            if ($tx->is_redeemed || $tx->status === 'scanned') {
                $todayCheckedInPax += $pax;
            }
        }

        $todayCheckInRate = $todayExpectedPax > 0 ? round(($todayCheckedInPax / $todayExpectedPax) * 100) : 0;

        // 4. Monthly Tickets Sold
        $ticketsSoldThisMonth = (int) TransactionItem::whereHas('transaction', function ($query) use ($paidStatuses) {
            $query->whereIn('status', $paidStatuses)
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month);
        })->sum('quantity');

        // 5. 14-Day Trend Data
        $start = today()->subDays(13);
        $period = CarbonPeriod::create($start, today());

        $chartLabels = [];
        $chartRevenue = [];
        $chartPax = [];

        foreach ($period as $date) {
            $chartLabels[] = $date->translatedFormat('d M');

            $chartRevenue[] = (float) Transaction::whereIn('status', $paidStatuses)
                ->whereDate('created_at', $date)
                ->sum('total_price');

            $chartPax[] = (int) TransactionItem::whereHas('transaction', function ($q) use ($date, $paidStatuses) {
                $q->whereIn('status', $paidStatuses)
                    ->whereDate('created_at', $date);
            })->sum('quantity');
        }

        // 6. Ticket Distribution Data
        $distItems = TransactionItem::whereHas('transaction', function ($q) use ($paidStatuses) {
            $q->whereIn('status', $paidStatuses);
        })
        ->with('ticketPackage')
        ->get()
        ->groupBy(function ($item) {
            return $item->ticketPackage ? $item->ticketPackage->name : 'Tiket Masuk';
        });

        $distLabels = [];
        $distData = [];
        foreach ($distItems as $name => $group) {
            $distLabels[] = $name;
            $distData[] = (int) $group->sum('quantity');
        }

        if (empty($distLabels)) {
            $distLabels = ['Belum Ada Penjualan'];
            $distData = [0];
        }

        // 7. Recent Orders
        $recentOrders = Transaction::with(['items.ticketPackage'])
            ->latest()
            ->limit(8)
            ->get();

        return view('admin.dashboard-v2', compact(
            'user',
            'salesToday',
            'ordersTodayCount',
            'salesThisMonth',
            'salesLastMonth',
            'monthGrowthPercent',
            'todayArrivals',
            'todayExpectedPax',
            'todayCheckedInPax',
            'todayCheckInRate',
            'ticketsSoldThisMonth',
            'chartLabels',
            'chartRevenue',
            'chartPax',
            'distLabels',
            'distData',
            'recentOrders'
        ));
    }

    public function reschedule(Request $request, $id)
    {
        $request->validate([
            'visit_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'visit_date' => $request->visit_date,
            'notes' => $request->notes,
        ]);

        return back()->with('success', "Tiket #{$transaction->order_id} berhasil di-reschedule ke {$request->visit_date}.");
    }

    public function checkIn($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'is_redeemed' => true,
            'redeemed_at' => now(),
            'status' => 'scanned',
        ]);

        return back()->with('success', "Tiket #{$transaction->order_id} berhasil divalidasi masuk (Check-in).");
    }
}
