<?php

namespace Tests\Feature;

use App\Models\Transaction;
use App\Models\TicketPackage;
use App\Models\TransactionItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TicketQuotaTest extends TestCase
{
    use RefreshDatabase;

    public function test_ticket_package_calculates_remaining_daily_quota_correctly(): void
    {
        $package = TicketPackage::create([
            'name' => 'Weekday Pass Quota Test',
            'type' => 'regular',
            'validity_type' => 'weekday',
            'price' => 50000,
            'is_active' => true,
            'daily_quota' => 10,
        ]);

        $this->assertEquals(10, $package->getAvailableQuotaForDate('2026-10-01'));

        // Simulate 4 tickets booked on 2026-10-01 with paid status
        $transaction = Transaction::create([
            'order_id' => 'AQB-TEST-12345',
            'customer_name' => 'Test User',
            'customer_email' => 'test@example.com',
            'customer_phone' => '081234567890',
            'visit_date' => '2026-10-01',
            'subtotal' => 200000,
            'total_price' => 200000,
            'status' => 'paid',
        ]);

        TransactionItem::create([
            'transaction_id' => $transaction->id,
            'ticket_package_id' => $package->id,
            'quantity' => 4,
            'price' => 50000,
            'subtotal' => 200000,
        ]);

        $this->assertEquals(6, $package->getAvailableQuotaForDate('2026-10-01'));
        // Different date should still have full quota
        $this->assertEquals(10, $package->getAvailableQuotaForDate('2026-10-02'));
    }

    public function test_livewire_checkout_blocks_adding_quantity_beyond_quota(): void
    {
        $package = TicketPackage::create([
            'name' => 'Limited Pass',
            'type' => 'regular',
            'validity_type' => 'all_days',
            'price' => 75000,
            'is_active' => true,
            'daily_quota' => 2,
        ]);

        $component = Livewire::test(\App\Livewire\Checkout::class)
            ->set('visit_date', date('Y-m-d', strtotime('+2 days')))
            ->call('incrementQuantity', $package->id)
            ->call('incrementQuantity', $package->id);

        $this->assertEquals(2, $component->get('quantities')[$package->id]);

        // Attempting to exceed quota
        $component->call('incrementQuantity', $package->id);
        $this->assertEquals(2, $component->get('quantities')[$package->id]);
        $component->assertHasErrors('quantities');
    }
}
