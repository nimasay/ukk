<?php

namespace App\Http\Livewire;

use App\Mail\TransaksiMail;
use App\Models\Paket;
use App\Models\Barang;
use App\Models\DetailBarang;
use App\Models\Konsumen;
use App\Models\Transaksi as ModelsTransaksi;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class Transaksi extends Component
{
    public $nama, $email, $hp, $alamat, $paket_nama_paket, $berat, $total_bayar, $barang = [];

    public function mount()
    {
       array_push($this->barang, "");
    }

    protected function rules()
    {
        return [
            'nama' => 'required',
            'email' => ['required', 'email'],
            'hp' => ['required', 'digits:12', 'numeric'],
            'alamat'=> 'required', 
            'paket_nama_paket' => 'required',
            'berat' => 'required|min:1|numeric',
            'barang' => 'array',
            'barang.*' => 'required'

        ];
    }

    public function tambah_barang()
    {
        array_push($this->barang, "");
    }

    public function hapus_barang($key)
    {
        unset($this->barang[$key]);
    }

    public function store()
    {
        $this->validate();

        DB::transaction(function () {
            $paket = Paket::find($this->paket_nama_paket);
       
            $user = User::create([
                'name' =>$this->nama,
                'email' => $this->email,
                'role_id' =>3 
            ]);
            
            Konsumen::create([
                'hp'=> $this->hp,
                'alamat' => $this->alamat,
                'user_id' => $user->id,
            ]);

            $barang = Barang::create([
                'berat' => $this->berat,
                'user_id' => $user->id,
            ]);
            
            foreach ($this->barang as $item) {
                DetailBarang::create([
                    'barang_id' => $barang->id,
                    'nama' => $item
                ]);
            }
            
            $transaksi = ModelsTransaksi::create([
                'paket_id' => $this->paket_nama_paket,
                'barang_id' => $barang->id,
                'total_bayar' => $paket->harga * $this->berat,
                'tanggal_diterima' => now(),
                'tanggal_diambil' => now()->addHours($paket->durasi),
                'status' => 0
            ]);

            Mail::to($this->email)->send(new TransaksiMail($transaksi));

            session()->flash('succes', 'Input Data successfully.');
            return redirect('/progres');
        });

    }

    public function render()
    {
        if ($this->paket_nama_paket && $this->berat) {
            $paket = Paket::find($this->paket_nama_paket);
            $this->total_bayar = $paket->harga * $this->berat;
        } else {
            $this->total_bayar = 0 ;
        }
        $paket = Paket::all();
        return view('livewire.transaksi', compact('paket'));
    }
}
