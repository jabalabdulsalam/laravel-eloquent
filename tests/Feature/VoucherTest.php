<?php

namespace Tests\Feature;

use App\Models\Voucher;
use Database\Seeders\VoucherSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VoucherTest extends TestCase
{
    public function testCreateVoucher()
    {
        $voucher = new Voucher();
        $voucher->name = "Sample Voucher";
        $voucher->voucher_code = "1232444322";
        $voucher->save();

        self::assertNotNull($voucher->id);
    }

    public function testCreateVoucherUUID()
    {
        $voucher = new Voucher();
        $voucher->name = "Sample Voucher";
        $voucher->save();

        self::assertNotNull($voucher->id);
        self::assertNotNull($voucher->voucher_code);
    }

    public function testSoftDelete()
    {
        $this->seed(VoucherSeeder::class);

        $voucher = Voucher::query()->where("name", "=", "Sample Voucher")->first();
        $voucher->delete();

        $voucher = Voucher::query()->where("name", "=", "Sample Voucher")->first();
        self::assertNull($voucher);

        $voucher = Voucher::withTrashed()->where("name", "=", "Sample Voucher")->first();
        self::assertNotNull($voucher);
    }

    public function testLocalScope()
    {
        $voucher = new Voucher();
        $voucher->name = "Sample Voucher";
        $voucher->is_active = true;
        $voucher->save();

        $voucher = Voucher::active()->count();
        self::assertEquals(1, $voucher);

        $voucher = Voucher::nonActive()->count();
        self::assertEquals(0, $voucher);

    }
}
