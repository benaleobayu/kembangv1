@extends('layouts.main')

@section('content')
<div class="pageHeading text-center my-3">
    <h1>Tambah Data Regency</h1>
</div>
<div class="container">
    <form action="/flowers" method="post">
        @csrf
        <label for="code">Code</label>
        <input type="text" name="code" id="code" class="form-control mb-3">

        <label for="name">Nama Bunga</label>
        <input type="text" name="name" id="name" class="form-control mb-3">

        <label for="price">Price</label>
        <input type="text" name="price" id="price" class="form-control mb-3">

        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" onclick="window.location='/regencies'" class="btn btn-warning">Kembali</button>
    </form>
</div>
@endsection