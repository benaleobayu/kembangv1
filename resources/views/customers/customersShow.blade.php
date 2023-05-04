@extends('layouts.main')

@section('content')
    <div class="table p-2 mt-5">

        <div class="container px-5">
            <form action="" method="get">
            <label class="py-1" for="name">Nama</label>
            <input class="form-control py-1" type="text" value="{{ $data->name }}" disabled readonly>
            <label class="py-1" for="email">Email</label>
            <input class="form-control py-1" type="email" value="{{ $data->email }}" disabled readonly>
            <label class="py-1" for="address">Alamat</label>
            <input class="form-control py-1" type="text" value="{{ $data->address }}" disabled readonly>
            <label class="py-1" for="regencies_id">Daerah</label>
            <input class="form-control py-1" type="text" value="{{ $data->regencies->name }}" disabled readonly>
            <label class="py-1" for="phone">Nomor Handphone</label>
            <input class="form-control py-1" type="text" value="{{ $data->phone }}" disabled readonly>
            <label class="py-1" for="interest">Catatan</label>
            <textarea class="form-control" name="interest" id="interest" cols="30" rows="5" disabled readonly>{{ $data->interest }}</textarea>
        </form>
            <button class="btn btn-warning my-3" onclick="window.location='{{ url('/customers') }}'">Kembali</button>
        </div>
    </div>
@endsection
