@if ($tambah)
<!-- Modal -->
<div class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-right: 17px; display: block;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Layanan Laundry</h5>
                <button wire:click="format" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="nama_paket">Jenis Paket </label>
                <input wire:model="nama_paket" type="text" class="form-control" id="nama_paket" >
                @error('nama_paket') <small class="text-danger">{{ $message }}</small> @enderror
              </div>
              <div class="form-group">
                <label for="durasi">Durasi </label>
                <input wire:model="durasi" type="number" min="1" class="form-control" id="durasi" >
                @error('durasi') <small class="text-danger">{{ $message }}</small> @enderror
              </div>
              <div class="form-group">
                <label for="harga">Harga </label>
                <input wire:model="harga" type="number" min="1" class="form-control" id="harga" >
                @error('harga') <small class="text-danger">{{ $message }}</small> @enderror
              </div>
              
            </form>
        </div>
        <div class="modal-footer">
            <button wire:click="format" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button wire:click="store" type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
  </div>
</div>
    
@endif