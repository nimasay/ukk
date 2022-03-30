@if ($tambah)
<!-- Modal -->
<div class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-right: 17px; display: block;">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan Kasir</h5>
                <button wire:click="format" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="nama">Nama </label>
                <input wire:model="nama" type="text" class="form-control" id="nama" >
                @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
              </div>
              <div class="form-group">
                <label for="email">Email </label>
                <input wire:model="email" type="email" class="form-control" id="email" >
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input wire:model="password" type="password" class="form-control" id="password">
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
              </div>
              <div class="form-group">
                <label for="password_confirmation">Password Confirmatiom</label>
                <input wire:model="password_confirmation" type="password" class="form-control" id="password_confirmation">
                @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
              </div>
              <div class="form-group">
                <label for="hp">Phone Number</label>
                <input wire:model="hp" type="number" class="form-control" id="hp" min="1">
                @error('hp') <small class="text-danger">{{ $message }}</small> @enderror
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea wire:model="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
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