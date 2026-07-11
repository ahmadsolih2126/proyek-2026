<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alat_olahragas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_alat');
            $table->string('kategori'); 
            $table->integer('jumlah');
            $table->string('kondisi')->default('Baik'); 
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alat_olahragas');
    }
};