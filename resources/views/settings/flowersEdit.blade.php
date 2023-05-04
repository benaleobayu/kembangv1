@extends('layouts.main')

@section('content')
<div class="pageHeading text-center my-3">
    <h1>Tambah Data Regency</h1>
</div>
<div class="container">
    <form action="/flowers/{{ $data->id }}" method="post">
        @csrf
        @method('PUT')
        <label for="code">Code</label>
        <input type="text" name="code" id="code" class="form-control mb-3" value="{{ old('code', $data->code) }}">

        <label for="name">Nama Bunga</label>
        <input type="text" name="name" id="name" class="form-control mb-3" value="{{ old('code', $data->name) }}">

        <label for="price">Price</label>
        <input type="text" name="price" id="price" class="form-control mb-3" value="{{ old('code', $data->price) }}">

        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" onclick="window.location='/regencies'" class="btn btn-warning">Kembali</button>
    </form>
</div>
@endsection