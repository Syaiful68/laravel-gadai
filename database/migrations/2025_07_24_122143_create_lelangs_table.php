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
            $table->integer('nominal')->nullable();
            $table->string('status')->default('incomplete');
            $table->string('user_id');
            $table->timestamps();
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
