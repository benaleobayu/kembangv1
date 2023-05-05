@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="top-zone" style="height: 150px">
        </div>
        <div class="card px-5">
            <div class="card-body">
                <label class="py-1" for="name">Nama</label>
                <input class="form-control py-1" type="text" value="{{ $data->name }}" disabled readonly>
                <label class="py-1" for="address">Alamat</label>
                <input class="form-control py-1" type="text" value="{{ $data->address }}" disabled readonly>
                <div class="row">
                    <div class="col-6" style="padding-left: 4px">
                        <label class="py-1 px-2" for="regencies_id">Daerah</label>
                        <input class="form-control py-1" type="text" value="{{ $data->regencies->name }}" disabled
                            readonly>
                    </div>
                    <div class="col-6" style="padding-right: 4px">
                        <label class="py-1" for="regencies_id">Kota</label>
                        <input class="form-control py-1" type="text" value="{{ $data->regencies->name }}" disabled
                            readonly>
                    </div>
                </div>
                <label class="py-1" for="phone">Nomor Handphone</label>
                <input class="form-control py-1" type="text" value="{{ $data->phone }}" disabled readonly>
                <label class="py-1" for="interest">Catatan</label>
                <textarea class="form-control" name="interest" id="interest" cols="30" rows="5" disabled readonly>{{ $data->interest }}</textarea>

                <button class="btn btn-warning my-3" onclick="window.location='{{ url('/customers') }}'">Kembali</button>
            </div>
        </div>
    </div>
@endsection
