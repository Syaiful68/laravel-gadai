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
        Schema::create('tb_pinjaman', function (Blueprint $table) {
            $table->id();
            $table->string('code_pinjam');
            $table->bigInteger('nasabah_id');
            $table->string('jaminan');
            $table->integer('pinjaman');
            $table->string('term');
            $table->integer('comisi');
            $table->integer('persentages');
            $table->integer('total');
            $table->date('term_date');
            $table->date('do_date');
            $table->string('user_id');
            $table->string('status')->default('incomplete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pinjaman');
    }
};
