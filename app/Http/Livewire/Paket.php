<?php

namespace App\Http\Livewire;

use App\Models\Paket as ModelsPaket;
use Livewire\WithPagination;
use Livewire\Component;

class Paket extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $tambah, $edit, $hapus, $search;
    public $nama_paket, $durasi, $harga, $paket_id;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected function rules()
    {
        return [
            'nama_paket' => 'required',
            'durasi' => 'required|min:1|numeric',
            'harga' => 'required|min:100|numeric',
        ];
    }

    public function show_tambah()
    {
        $this->tambah = true;
    }

    public function store()
    {
      $this->validate();

      ModelsPaket::create([
          'nama_paket' => $this->nama_paket,
          'durasi' => $this->durasi,
          'harga' => $this->harga,
      ]);

      session()->flash('succes', 'Input Data successfully.');
      $this->format();

    }

    public function show_edit(ModelsPaket $paket)
    {
        $this->edit = true;
        $this->paket_id = $paket->id;
        $this->nama_paket = $paket->nama_paket;
        $this->durasi = $paket->durasi;
        $this->harga = $paket->harga;

    }

    public function update()
    {
        $this->validate();

        $paket = ModelsPaket::whereId($this->paket_id)->update([
            'nama_paket' => $this->nama_paket,
            'durasi' => $this->durasi,
            'harga' => $this->harga,

        ]);

        session()->flash('succes', 'Data successfully Updated.');
        $this->format();

    }

    public function show_hapus(ModelsPaket $paket)
    {
        $this->hapus = true;
        $this->paket_id = $paket->id;
        $this->nama_paket = $paket->nama_paket;

    }

    public function destroy()
    {
        ModelsPaket::whereId($this->paket_id)->delete();
        $this->updatingSearch();
        session()->flash('succes', 'Data successfully Deleted!.');
        $this->format();
    }

    public function format()
    {
        $this->tambah = false;
        $this->edit = false;
        $this->hapus = false;
        unset($this->nama_paket, $this->durasi, $this->harga, $this->paket_id);
    }

    public function format_search()
    {
        $this->search =  '';
    }

    public function render()
    {
       if ($this->search) {
        $paket = ModelsPaket::where('nama_paket', 'like', '%'.$this->search .'%')->paginate(5);
       } else {
            $paket = ModelsPaket::paginate(5);
       }
       
        return view('livewire.paket', compact('paket'));
    }
}
