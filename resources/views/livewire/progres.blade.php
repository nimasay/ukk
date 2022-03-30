<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('layouts/sidebar')
        </div>
        <div class="col-md-9">
            <h2>Check your laundry process in here!</h2>

           {{--@include('layouts\paket\tambah')
            @include('layouts\paket\edit')
            @include('layouts\paket\hapus')--}}
            @include('layouts\flashdata')
           
            <div class="row mb-3 ">
                <div class="col-md-4">
                    <label> Tanggal Diterima </label>
                    <input wire:model="tanggal_diterima" type="date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label> Tanggal Diambil </label>
                    <input wire:model="tanggal_diambil" type="date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label> Search </label>
                    <div class="input-group">
                        <input wire:model="search" type="text" class="form-control" placeholder="Search">
                        <div class="input-group-prepend" style="cursor: pointer">
                            <div wire:click="format_search" class="input-group-text">X</div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <table class="table table-striped">
                <thead>
                  <tr>
                    <th width="10%" scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Total Bayar</th>
                    <th scope="col">Jenis Paket</th>
                    <th scope="col">Tanggal Diterima</th>
                    <th scope="col">Tanggal Diambil</th>
                    <th scope="col">Status</th>
                    @can('admin')
                    <th width="10%" scope="col">Aksi</th>
                    @endcan
                  </tr>
                </thead>
                <tbody>
                    @foreach ($progres as $item)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$item->barang->user->name}}</td>
                        <td>Rp. {{ number_format($item->total_bayar) }}</td>
                        <td>{{$item->paket->nama_paket}}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_diterima)->format('d m Y, H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_diambil)->format('d m Y, H:i') }}</td>
                        <td>
                            @if ($item->status == 0)
                                <span class="badge badge-secondary">Sudah Diterima</span>
                            @elseif ($item->status == 1)
                                <span class="badge badge-primary">On Process</span>
                            @elseif ($item->status == 2)
                                <span class="badge badge-primary">Dryer</span>
                            @elseif ($item->status == 3)
                                <span class="badge badge-primary">Di setrika</span>
                            @elseif ($item->status == 4)
                                <span class="badge badge-warning">Menunggu Pembayaran</span>
                            @elseif ($item->status == 5)
                                <span class="badge badge-success">Sudah Diambil</span>
                            @endif
                        </td>
                        <td>

                            @can('karyawan')
                                @if ($item->status == 0)
                                    <button wire:click="aksi({{$item->id}})" type="button" 
                                        class="btn btn-sm btn-secondary mr-2">On Process</button>
                                @elseif ($item->status == 1)
                                    <button wire:click="aksi({{$item->id}})" type="button" 
                                        class="btn btn-sm btn-primary mr-2">Dryer</button>
                                @elseif ($item->status == 2)
                                    <button wire:click="aksi({{$item->id}})" type="button" 
                                        class="btn btn-sm btn-primary mr-2">Disetrika</button>
                                @elseif ($item->status == 3)
                                    <button wire:click="aksi({{$item->id}})" type="button" 
                                        class="btn btn-sm btn-warning mr-2">Menunggu Dibayar</button>
                                @elseif ($item->status == 4)
                                    <button wire:click="pembayaran({{$item->id}})" type="button" 
                                        class="btn btn-sm btn-success mr-2">Pembayaran</button>
                                @endif
                            @endcan
                            
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
              {{ $progres->links() }}
        </div>
    </div>
</div>