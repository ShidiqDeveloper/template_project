<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::create([
            'nama_barang' => 'Barang Satu',
            'jlh_barang' => 2,
            'total_harga' => 200,
            'kembalian' => 50
        ]);
    }
}
