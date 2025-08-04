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
        Schema::create('tb_nasabah', function (Blueprint $table) {
            $table->id();
            $table->integer('nik');
            $table->string('name');
            $table->string('gender');
            $table->string('alamat');
            $table->date('t_lahir');
            $table->string('contact');
            $table->string('jobs');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_nasabah');
    }
};
