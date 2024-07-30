<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('bukti_bayar')->nullable()->after('harga');
            $table->enum('status', ['pending', 'completed'])->default('pending')->after('bukti_bayar');
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('bukti_bayar');
            $table->dropColumn('status');
        });
    }
}
