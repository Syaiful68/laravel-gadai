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
            $table->unsignedBigInteger('pinjaman_id');
            $table->integer('nominal');
            $table->integer('sisa_bayar');
            $table->date('do_date');
            $table->string('payment_type');
            $table->unsignedBigInteger('user_id');
            $table->softDeletes('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('pinjaman_id')->references('tb_pinjaman')->on('id');
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
