<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Karyawan;
use App\Models\Paket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin
        $role = Role::create([
            'nama' => 'admin'
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@hitmeup.com',
            'password' => bcrypt('admin123'),
            'role_id' => $role->id
        ]);


        //karyawan
        $role = Role::create([
            'nama' => 'karyawan'
        ]);

        $user = User::create([
            'name' => 'karyawan',
            'email' => 'karyawan@hitmeup.com',
            'password' => bcrypt('admin123'),
            'role_id' => $role->id
        ]);

        Karyawan::create([
            'user_id' => $user->id ,
            'hp' => '089662715412',
            'alamat' => 'Jl.Soekarno'
        ]);


        //konsumen
        $role = Role::create([
            'nama' => 'konsumen'
        ]);

       

        //Tambah Data Paket
        Paket::create([
            'nama_paket' => 'Reguler',
            'durasi' => '3',
            'harga' => '10000'
        ]);

        Paket::create([
            'nama_paket' => 'Express',
            'durasi' => '1',
            'harga' => '20000'
        ]);

        Paket::create([
            'nama_paket' => 'Dry Clean',
            'durasi' => '2',
            'harga' => '25000'
        ]);

        Paket::create([
            'nama_paket' => 'Cuci Lipat',
            'durasi' => '3',
            'harga' => '8000'
        ]);


    }
}
