<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = ['paket_id','barang_id','total_bayar','status', 'tanggal_diterima', 'tanggal_diambil'];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
