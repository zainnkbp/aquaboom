<?php

namespace Tests\Feature;

use App\Livewire\QrScanner;
use App\Models\TicketPackage;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class QrScannerExpiredTest extends TestCase
{
    use RefreshDatabase;

    protected function createExpiredTransaction(): Transaction
    {
        $pkg = TicketPackage::create([
            'name' => 'Tiket Masuk Reguler',
            'price' => 50000,
            'description' => 'Akses all wahana',
            'is_active' => true,
        ]);

        $transaction = Transaction::create([
            'order_id' => 'AQB-TEST-EXPD-1234',
            'customer_name' => 'Budi Pengunjung',
            'customer_email' => 'budi@example.com',
            'customer_phone' => '08123456789',
            'visit_date' => Carbon::yesterday()->toDateString(), // Expired
            'subtotal' => 100000,
            'total_price' => 100000,
            'status' => 'paid',
            'is_redeemed' => false,
        ]);

        TransactionItem::create([
            'transaction_id' => $transaction->id,
            'ticket_package_id' => $pkg->id,
            'quantity' => 2,
            'price' => 50000,
            'subtotal' => 100000,
        ]);

        return $transaction;
    }

    public function test_expired_ticket_triggers_expired_status(): void
    {
        $admin = User::create([
            'name' => 'Admin Gate',
            'email' => 'admin_gate_' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'role' => User::ROLE_SUPER_ADMIN,
        ]);

        $transaction = $this->createExpiredTransaction();

        Livewire::actingAs($admin)
            ->test(QrScanner::class)
            ->call('processScan', $transaction->order_id)
            ->assertSet('scanResult', 'expired')
            ->assertSet('expiredTransactionId', $transaction->id);

        $transaction->refresh();
        $this->assertFalse($transaction->is_redeemed);
    }

    public function test_superadmin_can_override_expired_ticket_directly(): void
    {
        $superAdmin = User::create([
            'name' => 'Super Admin Manager',
            'email' => 'super_mgr_' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'role' => User::ROLE_SUPER_ADMIN,
        ]);

        $transaction = $this->createExpiredTransaction();

        Livewire::actingAs($superAdmin)
            ->test(QrScanner::class)
            ->call('processScan', $transaction->order_id)
            ->set('overrideReason', '🌧️ Kompensasi Cuaca / Hujan')
            ->call('overrideExpiredTicket')
            ->assertSet('scanResult', 'success');

        $transaction->refresh();
        $this->assertTrue($transaction->is_redeemed);
        $this->assertEquals('scanned', $transaction->status);
        $this->assertStringContainsString('[OVERRIDE EXPIRED]', $transaction->notes);
        $this->assertStringContainsString('Super Admin Manager', $transaction->notes);
        $this->assertStringContainsString('Kompensasi Cuaca / Hujan', $transaction->notes);
    }

    public function test_validator_requires_valid_supervisor_pin_to_override(): void
    {
        // 1. Create supervisor with PIN 123456
        User::create([
            'name' => 'Supervisor Jaga',
            'email' => 'spv_jaga_' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'role' => User::ROLE_ADMIN,
            'pin' => '123456',
        ]);

        // 2. Create gate validator
        $validator = User::create([
            'name' => 'Satpam Loket',
            'email' => 'satpam_' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'role' => User::ROLE_VALIDATOR,
            'pin' => '999999',
        ]);

        $transaction = $this->createExpiredTransaction();

        // Failed attempt with wrong PIN
        Livewire::actingAs($validator)
            ->test(QrScanner::class)
            ->call('processScan', $transaction->order_id)
            ->set('overrideReason', '🏢 Dispensasi Manajemen / GM')
            ->set('supervisorPin', '000000')
            ->call('overrideExpiredTicket')
            ->assertSet('scanResult', 'expired')
            ->assertSet('overrideErrorMessage', 'PIN Supervisor / Admin tidak valid atau tidak cocok!');

        $transaction->refresh();
        $this->assertFalse($transaction->is_redeemed);

        // Success attempt with correct supervisor PIN 123456
        Livewire::actingAs($validator)
            ->test(QrScanner::class)
            ->call('processScan', $transaction->order_id)
            ->set('overrideReason', '🏢 Dispensasi Manajemen / GM')
            ->set('supervisorPin', '123456')
            ->call('overrideExpiredTicket')
            ->assertSet('scanResult', 'success');

        $transaction->refresh();
        $this->assertTrue($transaction->is_redeemed);
        $this->assertStringContainsString('Supervisor Jaga', $transaction->notes);
        $this->assertStringContainsString('Satpam Loket', $transaction->notes);
    }
}
