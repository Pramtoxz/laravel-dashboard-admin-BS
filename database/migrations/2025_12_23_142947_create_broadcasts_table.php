<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('broadcasts', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('pesan');
            $table->enum('tipe', ['promo', 'info', 'pengumuman'])->default('info');
            $table->enum('target', ['all', 'verified'])->default('all');
            $table->integer('total_terkirim')->default(0);
            $table->timestamp('dikirim_pada')->nullable();
            $table->foreignId('dikirim_oleh')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('broadcasts');
    }
};
