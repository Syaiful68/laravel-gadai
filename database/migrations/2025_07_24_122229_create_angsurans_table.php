<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_angsurans', function (Blueprint $table) {
            $table->id();
            $table->string('pinjaman_id');
            $table->integer('nominal');
            $table->integer('sisa_bayar');
            $table->date('do_date');
            $table->string('payment_type');
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_angsurans');
    }
};
