<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('kode_booking')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('mobil_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('durasi_hari');
            $table->decimal('harga_per_hari', 12, 2);
            $table->decimal('total_harga', 12, 2);
            $table->string('bukti_bayar')->nullable();
            $table->enum('status_pembayaran', ['pending', 'verified', 'rejected'])->default('pending');
            $table->enum('status_booking', ['pending', 'confirmed', 'checked_in', 'completed', 'cancelled'])->default('pending');
            $table->text('catatan_customer')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('checked_in_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
