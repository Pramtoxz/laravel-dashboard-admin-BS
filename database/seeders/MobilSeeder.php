<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mobil;

class MobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           Mobil::create([
            'nama_mobil' => 'Civic',
            'merk' => 'Toyota',
            'plat_nomor' => 'BA 4232 CA',
            'tahun' => '2025',
            'warna' => 'Hitam',
            'jenis_transmisi' => 'manual',
            'kapasitas_penumpang' => 4,
            'harga_sewa_per_hari' => 500000,
            'deskripsi' => 'Lorem Ipsum Kolor',
            'foto_mobil' => 'rent-car-nasi.png',
            'status' => 'tersedia',
        ]);
         Mobil::create([
            'nama_mobil' => 'Civic 2',
            'merk' => 'Toyota',
            'plat_nomor' => 'BA 2321 CA',
            'tahun' => '2025',
            'warna' => 'Hitam',
            'jenis_transmisi' => 'manual',
            'kapasitas_penumpang' => 4,
            'harga_sewa_per_hari' => 500000,
            'deskripsi' => 'Lorem Ipsum Kolor',
            'foto_mobil' => 'rent-car-nasi.png',
            'status' => 'disewa',
        ]);
         Mobil::create([
            'nama_mobil' => 'Civic 3',
            'merk' => 'Toyota',
            'plat_nomor' => 'BA 1234 XC',
            'tahun' => '2025',
            'warna' => 'Hitam',
            'jenis_transmisi' => 'automatic',
            'kapasitas_penumpang' => 4,
            'harga_sewa_per_hari' => 500000,
            'deskripsi' => 'Lorem Ipsum Kolor',
            'foto_mobil' => 'rent-car-nasi.png',
            'status' => 'maintenance',
        ]);
            Mobil::create([
            'nama_mobil' => 'Avanza',
            'merk' => 'Toyota',
            'plat_nomor' => 'BA 4321 IS',
            'tahun' => '2025',
            'warna' => 'Hitam',
            'jenis_transmisi' => 'manual',
            'kapasitas_penumpang' => 4,
            'harga_sewa_per_hari' => 500000,
            'deskripsi' => 'Lorem Ipsum Kolor',
            'foto_mobil' => 'rent-car-nasi.png',
            'status' => 'tersedia',
        ]);
         Mobil::create([
            'nama_mobil' => 'Mobilio',
            'merk' => 'Toyota',
            'plat_nomor' => 'BA 999 QA',
            'tahun' => '2025',
            'warna' => 'Hitam',
            'jenis_transmisi' => 'manual',
            'kapasitas_penumpang' => 4,
            'harga_sewa_per_hari' => 500000,
            'deskripsi' => 'Lorem Ipsum Kolor',
            'foto_mobil' => 'rent-car-nasi.png',
            'status' => 'disewa',
        ]);
         Mobil::create([
            'nama_mobil' => 'Brio',
            'merk' => 'Toyota',
            'plat_nomor' => 'BA 1234 PC',
            'tahun' => '2025',
            'warna' => 'Hitam',
            'jenis_transmisi' => 'automatic',
            'kapasitas_penumpang' => 4,
            'harga_sewa_per_hari' => 500000,
            'deskripsi' => 'Lorem Ipsum Kolor',
            'foto_mobil' => 'rent-car-nasi.png',
            'status' => 'maintenance',
        ]);
    }
}
