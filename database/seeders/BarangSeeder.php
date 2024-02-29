<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1,
                'barang_kode' => 'BRG001',
                'kategori_id' => 1, // Elektronik
                'barang_nama' => 'Laptop',
                'harga_beli' => 8000000,
                'harga_jual' => 10000000,
            ],
            [
                'barang_id' => 2,
                'barang_kode' => 'BRG002',
                'kategori_id' => 1, // Elektronik
                'barang_nama' => 'Smartphone',
                'harga_beli' => 3000000,
                'harga_jual' => 4000000,
            ],
            [
                'barang_id' => 3,
                'barang_kode' => 'BRG003',
                'kategori_id' => 1, // Elektronik
                'barang_nama' => 'Kamera Digital',
                'harga_beli' => 6000000,
                'harga_jual' => 8000000,
            ],
            [
                'barang_id' => 4,
                'barang_kode' => 'BRG004',
                'kategori_id' => 2, // Fashion
                'barang_nama' => 'Sepatu Sport',
                'harga_beli' => 500000,
                'harga_jual' => 700000,
            ],
            [
                'barang_id' => 5,
                'barang_kode' => 'BRG005',
                'kategori_id' => 1, // Elektronik
                'barang_nama' => 'Printer',
                'harga_beli' => 1200000,
                'harga_jual' => 1500000,
            ],
            [
                'barang_id' => 6,
                'barang_kode' => 'BRG006',
                'kategori_id' => 3, // Otomotif
                'barang_nama' => 'Sepeda Motor',
                'harga_beli' => 890000,
                'harga_jual' => 700000,
            ],
            [
                'barang_id' => 7,
                'barang_kode' => 'BRG007',
                'kategori_id' => 3, // Otomotif
                'barang_nama' => 'Kaliper',
                'harga_beli' => 250000,
                'harga_jual' => 300000,
            ],
            [
                'barang_id' => 8,
                'barang_kode' => 'BRG008',
                'kategori_id' => 1, // Elektronik
                'barang_nama' => 'Headphone',
                'harga_beli' => 80000,
                'harga_jual' => 120000,
            ],
            [
                'barang_id' => 9,
                'barang_kode' => 'BRG009',
                'kategori_id' => 5,
                'barang_nama' => 'Siksa Kubur',
                'harga_beli' => 400000,
                'harga_jual' => 500000,
            ],
            [
                'barang_id' => 10,
                'barang_kode' => 'BRG010',
                'kategori_id' => 5,
                'barang_nama' => 'Siksa Neraka',
                'harga_beli' => 1000000,
                'harga_jual' => 1300000,
            ],
        ];

        DB::table('m_barang')->insert($data);
    }
}
