<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['penjualan_id' => 1, 'user_id' => 1, 'pembeli' => 'John Doe', 'penjualan_kode' => 'PJN001', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 2, 'user_id' => 2, 'pembeli' => 'Jane Doe', 'penjualan_kode' => 'PJN002', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 3, 'user_id' => 1, 'pembeli' => 'Alice', 'penjualan_kode' => 'PJN003', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 4, 'user_id' => 2, 'pembeli' => 'Bob', 'penjualan_kode' => 'PJN004', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 5, 'user_id' => 3, 'pembeli' => 'Eve', 'penjualan_kode' => 'PJN005', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 6, 'user_id' => 2, 'pembeli' => 'Charlie', 'penjualan_kode' => 'PJN006', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 7, 'user_id' => 1, 'pembeli' => 'David', 'penjualan_kode' => 'PJN007', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 8, 'user_id' => 2, 'pembeli' => 'Grace', 'penjualan_kode' => 'PJN008', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 9, 'user_id' => 3, 'pembeli' => 'Harry', 'penjualan_kode' => 'PJN009', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 10, 'user_id' => 2, 'pembeli' => 'Isaac', 'penjualan_kode' => 'PJN010', 'penjualan_tanggal' => now()],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
