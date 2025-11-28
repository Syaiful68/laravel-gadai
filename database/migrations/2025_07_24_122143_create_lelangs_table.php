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
        Schema::create('tb_lelang', function (Blueprint $table) {
            $table->id();
            $table->string('code_lelang');
            $table->unsignedBigInteger('pinjam_id');
            $table->unsignedBigInteger('nasabah_id');
            $table->integer('nominal')->nullable();
            $table->string('status')->default('incomplete');
            $table->unsignedBigInteger('user_id');
            $table->softDeletes('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('pinjam_id')->references('id')->on('tb_pinjaman');
            $table->foreign('nasabah_id')->references('id')->on('tb_nasabah');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_lelang');
    }
};
