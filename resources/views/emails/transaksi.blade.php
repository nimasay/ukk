@component('mail::message')
# Barang Berhasil Di terima!

@component('mail::table')
|                  |                                                                                 |   
| ---------------- | ------------------------------------------------------------------------------- | 
| Nama             | {{$transaksi->barang->user->name}}                                              | 
| Jenis Paket      | {{$transaksi->paket->nama_paket}}                                               | 
| Berat            | {{$transaksi->barang->berat }}  Kg                                              | 
| Total Bayar      | Rp. {{number_format($transaksi->total_bayar)}}                                  | 
| Tanggal Diterima | {{ \Carbon\Carbon::parse($transaksi->tanggal_diterima)->format('d m Y, H:i') }} | 
| Tanggal Diambil  | {{ \Carbon\Carbon::parse($transaksi->tanggal_diambil)->format('d m Y, H:i') }}  | 
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
