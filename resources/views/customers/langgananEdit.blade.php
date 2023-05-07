@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="top-zone mt-3">
            <nav class="breadcrumb">
                <a class="breadcrumb-item text-decoration-none fs-5" href="/subscribers">Langganan</a>
                <span class="breadcrumb-item fs-5 active" aria-current="page">Edit</span>
            </nav>
            {{-- <div class="breadcrumbs mt-5 mb-0">
                <h4>
                    {!! Breadcrumbs::render('subscribers.index') !!} / Show
                </h4>
            </div> --}}
            <div class="card px-5">
                <div class="card-body">
                    <form action="/subscribers/{{ $data->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col">
                                <label class="py-1" for="name">Nama</label>
                                <input name="name" class="form-control py-1 @error('name') is-invalid @enderror"
                                    type="text" value="{{ $data->name }}" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label class="py-1" for="phone">Nomor Handphone</label>
                                <input name="phone" class="form-control py-1 @error('phone') is-invalid @enderror"
                                    type="text" value="{{ $data->phone }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>




                        <label class="py-1" for="address">Alamat</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" cols="30"
                            rows="3" required>{{ $data->address }}</textarea>
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
                        <div class="card mt-3">
                            <div class="card-header">
                                Pesanan
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <label class="py-1" for="flowers_id">Bunga</label>
                                        <select name="flowers_id" id="flowers_id" class="form-select" required>
                                            <option>Pilih Daerah</option>
                                            @foreach ($flowers as $row)
                                                @if (old('flowers_id', $data->flowers->id) == $row->id)
                                                    <option value="{{ $row->id }}" selected>{{ $row->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label class="py-1" for="total">Jumlah</label>
                                        <input name="total" class="form-control py-1 @error('total') is-invalid @enderror"
                                            type="text" value="{{ $data->total }}" required>
                                        @error('total')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <label class="py-1" for="day">Hari Langganan</label>
                                <select name="day" id="day" class="form-select" required>
                                    <option value="">Pilih ...</option>
                                    <option value="{{ old('day', 'daily') }}" {{ old('day') == 'daily' ? 'selected' : '' }}>Regular</option>
                                    <option value="{{ old('day', 'sub-mon') }}" {{ old('day') == 'sub-mon' ? 'selected' : '' }}>Senin</option>
                                    <option value="{{ old('day', 'sub-wed') }}" {{ old('day') == 'sub-wed' ? 'selected' : '' }}>Rabu</option>
                                    <option value="{{ old('day', 'sub-sat') }}" {{ old('day') == 'sub-sat' ? 'selected' : '' }}>Sabtu</option>
                                </select>

                                <label class="py-1" for="notes">Catatan</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" cols="30"
                                    rows="5">{{ $data->notes }}</textarea>
                                @error('interest')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>



                        <button type="submit" class="btn btn-info my-3">Simpan</button>
                        <button type="button" class="btn btn-warning mx-3"
                            onclick="window.location='{{ url('/subscribers') }}'">Kembali</button>
                    </form>

                </div>
            </div>
        </div>
    @endsection
