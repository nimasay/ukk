@if (session()->has('succes'))
<div class="alert alert-success" role="alert">
    {{ session('succes') }}
</div>
@endif