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
            $table->text('alamat');
            $table->string('t_lahir');
            $table->string('contact');
            $table->string('jobs');
            $table->string('status')->default('active');
            $table->unsignedBigInteger('user_id');
            $table->softDeletes('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
