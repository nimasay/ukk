<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'paket' ;
    protected $fillable = ['nama_paket','durasi', 'harga'];
    use HasFactory;

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
