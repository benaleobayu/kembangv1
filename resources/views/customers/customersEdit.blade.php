@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="top-zone">
            <div class="breadcrumbs mt-5 mb-0">
                <h4>
                    {!! Breadcrumbs::render('customers.index') !!} / Show
                </h4>
            </div>
            <div class="card px-5">
                <div class="card-body">
                    <form action="/customers/{{ $data->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <label class="py-1" for="name">Nama</label>
                        <input name="name" class="form-control py-1 @error('name') is-invalid @enderror" type="text"
                            value="{{ $data->name }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <label class="py-1" for="address">Alamat</label>
                        <input name="address" class="form-control py-1 @error('address') is-invalid @enderror"
                            type="text" value="{{ $data->address }}" required>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label class="py-1" for="regencies_id">Daerah</label>
                        <select name="regencies_id" id="regencies_id" class="form-select" required>
                            <option>Pilih Daerah</option>
                            @foreach ($regency as $row)
                                @if (old('regencies_id', $data->regencies->id) == $row->id)
                                    <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                @else
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label class="py-1" for="phone">Nomor Handphone</label>
                        <input name="phone" class="form-control py-1 @error('phone') is-invalid @enderror" type="text"
                            value="{{ $data->phone }}" required>
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label class="py-1" for="interest">Catatan</label>
                        <textarea class="form-control @error('interest') is-invalid @enderror" name="interest" id="interest" cols="30"
                            rows="5">{{ $data->interest }}</textarea>
                        @error('interest')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <button type="submit" class="btn btn-info my-3">Simpan</button>
                        <button type="button" class="btn btn-warning mx-3"
                            onclick="window.location='{{ url('/customers') }}'">Kembali</button>
                    </form>

                </div>
            </div>
        </div>
    @endsection
