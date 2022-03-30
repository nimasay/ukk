<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Paket;
use App\Models\Konsumen;
use App\Models\Barang;
use App\Models\DetailBarang;
use App\Models\Transaksi;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paket = Paket::find(2);

        $user = User::create([
            'name' => 'bunga',
            'email' => 'bunga@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => 3
        ]);

        Konsumen::create([
                'user_id' => $user->id,
                'hp' => '089952137932',
                'alamat' => 'Jl. Bandung',
        ]);

        $barang = Barang::create([
            'user_id' => $user->id,
            'berat' => 2
        ]);

        DetailBarang::create([
            'barang_id' => $barang->id,
            'nama' => 'seragam'
        ]);

         DetailBarang::create([
            'barang_id' => $barang->id,
            'nama' => 'celana'
        ]);


        Transaksi::create([
            'paket_id' => $paket->id,
            'barang_id' => $barang->id,
            'total_bayar' => $barang->berat * $paket->harga,
            'status' => 0,
            'tanggal_diterima' => now(),
            'tanggal_diambil' => now()->addHours($paket->durasi)
        ]);
    }
}
