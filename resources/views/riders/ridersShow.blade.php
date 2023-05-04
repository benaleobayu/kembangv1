@extends('layouts.main')

@section('content')
    <div class="table p-2 mt-5">

        <div class="container px-5">
                <label class="mt-3" for="name">Nama</label>
                <input name="name" class="form-control py-1 @error('name') is-invalid @enderror" type="text"
                    value="{{ $data->name }}" disabled readonly>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <label class="mt-3" for="address">Alamat - Nama Jalan, Nomor Rumah / Komplek </label>
                <input name="address" class="form-control py-1 @error('address') is-invalid @enderror"
                    value="{{ $data->address }}" type="text" disabled readonly>
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="row p-0">
                    <div class="regencies col-md-6">
                        <label class=" mt-3 px-2" for="regencies_id">Daerah</label>
                        <select name="regencies_id" id="regencies_id" class="form-select py-1 mt-1" disabled readonly>
                            <option>Pilih Daerah</option>
                            @foreach ($regency as $row)
                                @if (old('regencies_id', $data->regencies->id ) == $row->id)
                                    <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                @else
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="regencies col-md-6">
                        <label class=" mt-3 px-2" for="regencies_id">Kota</label>
                        <select name="regencies_id" id="regencies_id" class="form-select py-1 mt-1" disabled readonly>
                            <option>Pilih Daerah</option>
                            @foreach ($regency as $row)
                                @if (old('regencies_id', $row->id) == $row->id)
                                    <option value="{{ $row->id }}" selected>{{ $row->city }}</option>
                                @else
                                    <option value="{{ $row->id }}">{{ $row->city }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="row p-0">
                    <div class="phone-dob col-md-6">
                        <label class="mt-3 px-2" for="phone">Nomor Handphone</label>
                        <input name="phone" class="form-control py-1 @error('phone') is-invalid @enderror" type="text"
                            value="{{ $data->phone }}}" disabled readonly>
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="phone-dob col-md-6">
                        <label for="dob" class="mt-3 px-2">Tanggal Lahir</label>
                        <input id="dob" name="dob" class="form-control" type="date" value="{{ $data->dob }}" disabled readonly />
                    </div>
                </div>
                <button class="btn btn-warning mt-3" onclick="window.location='{{ url('/riders') }}'">Kembali</button>

        </div>
    </div>
 
@endsection
