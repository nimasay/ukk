<?php

namespace App\Http\Livewire;


use App\Models\Transaksi;
use Livewire\WithPagination;
use Livewire\Component;


class Progres extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search, $tanggal_diambil, $tanggal_diterima ;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function aksi(Transaksi $transaksi)
    {
        $transaksi->update([
            'status' => $transaksi->status +1
        ]);

        session()->flash('succes', 'Aksi successfully updated.');
    }

    public function pembayaran($transaksi_id)
    {
        session(['transaksi_id' => $transaksi_id]);
        return redirect('/pembayaran');
    }

    public function format_search()
    {
        $this->search =  '';
    }

    public function render()
    {
        if ($this->search || $this->tanggal_diterima ) {
            $progres = Transaksi::WhereHas('barang', function($barang) {
                $barang->whereHas('user', function($user){
                    $user->where('name', 'like', '%'. $this->search .'%');
                });
            })
            ->where('tanggal_diterima', 'like', '%'. $this->tanggal_diterima .'%')
            ->where('tanggal_diambil', 'like', '%'. $this->tanggal_diambil .'%')
            ->latest()->paginate(5);        
        } else {
            $progres = Transaksi::latest()->paginate(5);        
        }
        return view('livewire.progres', compact('progres'));
    }
}
