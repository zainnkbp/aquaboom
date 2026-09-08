<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class DashboardV2Controller extends Controller
{
    public function __invoke(Request $request)
    {
        $user = auth()->user();
        if (!$user || !$user->canAccessPanel(\Filament\Facades\Filament::getPanel('admin'))) {
            return redirect('/admin/login');
        }

        $paidStatuses = ['paid', 'scanned'];

        // 1. Key Metrics
        $salesToday = (float) Transaction::whereIn('status', $paidStatuses)
            ->whereDate('created_at', today())
            ->sum('total_price');

        $ordersTodayCount = Transaction::whereIn('status', $paidStatuses)
            ->whereDate('created_at', today())
            ->count();

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

        // Today's Manifest Pax
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
        $checkInRate = $todayExpectedPax > 0 ? round(($todayCheckedInPax / $todayExpectedPax) * 100) : 0;

        $ticketsSoldThisMonth = (int) TransactionItem::whereHas('transaction', function ($query) use ($paidStatuses) {
            $query->whereIn('status', $paidStatuses)
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month);
        })->sum('quantity');

        // Sparklines (7 days revenue)
        $revenueSparkline = [];
        for ($i = 6; $i >= 0; $i--) {
            $d = today()->subDays($i);
            $revenueSparkline[] = (float) Transaction::whereIn('status', $paidStatuses)
                ->whereDate('created_at', $d)
                ->sum('total_price');
        }

        // 2. 14-Day Trend Chart Data
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

        // 3. Package Distribution
        $items = TransactionItem::whereHas('transaction', function ($q) use ($paidStatuses) {
            $q->whereIn('status', $paidStatuses);
        })
        ->with('ticketPackage')
        ->get()
        ->groupBy(function ($item) {
            return $item->ticketPackage ? $item->ticketPackage->name : 'Lainnya';
        });

        $packageLabels = [];
        $packageValues = [];
        foreach ($items as $name => $group) {
            $packageLabels[] = $name;
            $packageValues[] = $group->sum('quantity');
        }

        if (empty($packageLabels)) {
            $packageLabels = ['Tiket Regular', 'Duo Pass', 'Four Pack'];
            $packageValues = [1, 1, 1];
        }

        // 4. Recent Orders
        $recentOrders = Transaction::with(['items.ticketPackage'])
            ->latest()
            ->limit(8)
            ->get();

        return view('dashboard-v2', compact(
            'salesToday',
            'ordersTodayCount',
            'salesThisMonth',
            'monthGrowthPercent',
            'todayArrivals',
            'todayExpectedPax',
            'todayCheckedInPax',
            'checkInRate',
            'ticketsSoldThisMonth',
            'revenueSparkline',
            'chartLabels',
            'chartRevenue',
            'chartPax',
            'packageLabels',
            'packageValues',
            'recentOrders'
        ));
    }
}
