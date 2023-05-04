@extends('layouts.main')

@section('content')
<div class="pageHeading text-center my-3">
    <h1>Tambah Data Regency</h1>
</div>
<div class="container">
    <form action="/regencies" method="post">
        @csrf
        <label for="name">Nama Kecamatan</label>
        <input type="text" name="name" id="name" class="form-control mb-3">

        <label for="city">Nama Kabupaten/Kota</label>
        <input type="text" name="city" id="city" class="form-control mb-3">

        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" onclick="window.location='/regencies'" class="btn btn-warning">Kembali</button>
    </form>
</div>
@endsection