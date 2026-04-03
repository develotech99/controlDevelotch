<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('bank_accounts')) {
            DB::table('bank_accounts')
                ->where('currency', 'USD')
                ->update(['currency' => 'GTQ']);
        }

        if (Schema::hasTable('payment_receipts')) {
            DB::table('payment_receipts')
                ->where('currency', 'USD')
                ->update(['currency' => 'GTQ']);
        }
    }

    public function down(): void
    {
        // No action, dado que revertir moneda a USD no es deseado.
    }
};