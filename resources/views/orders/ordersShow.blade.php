@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="top-zone mt-3">
            <nav class="breadcrumb">
                <a class="breadcrumb-item text-decoration-none fs-5" href="/orders">Langganan</a>
                <span class="breadcrumb-item fs-5 active" aria-current="page">Show [{{ $data->name }}]</span>
            </nav>
            {{-- <div class="breadcrumbs mt-5 mb-0">
                <h4>
                    {!! Breadcrumbs::render('orders.index') !!} / Show
                </h4>
            </div> --}}
            <div class="card px-5 mb-5">
                <div class="card-body">
                    <form action="/orders/{{ $data->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col">
                                <label class="py-1" for="name">Nama</label>
                                <input name="name" class="form-control py-1 @error('name') is-invalid @enderror" type="text" value="{{ $data->name }}" disabled readonly>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label class="py-1" for="phone">Nomor Handphone</label>
                                <input name="phone" class="form-control py-1 @error('phone') is-invalid @enderror"
                                    type="text" value="{{ $data->phone }}" disabled readonly>
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>




                        <label class="py-1" for="address">Alamat</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" cols="30"
                            rows="3" disabled readonly>{{ $data->address }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <label class="py-1" for="regencies_id">Daerah</label>
                        <select name="regencies_id" id="regencies_id" class="form-select" disabled readonly>
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
                            <div class="card-header">Pesanan</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <label class="py-1" for="flowers_id">Bunga</label>
                                        <select name="flowers_id" id="flowers_id" class="form-select" disabled readonly>
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
                                            type="text" value="{{ $data->total }}" disabled readonly>
                                        @error('total')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <label class="py-1" for="day">Tanggal Pengiriman</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $data->date) }}" disabled readonly>

                                <label class="py-1" for="notes">Catatan</label>
                                <textarea class="form-control" name="notes" id="notes" cols="30" rows="5" disabled readonly>{{ $data->notes }}</textarea>
                            
                                <div class="row mt-3">
                                  <div class="col">
                                    <label for="image">Hasil Pengerjaan</label>
                                    <img class="border rounded img-fluid d-block" style="max-height:400px" src="{{ asset('storage/' . $data->image) }}" alt="">
                                 </div>
                                </div>
                            </div>
                        </div>



                        <button type="button" class="btn btn-warning my-3"
                            onclick="window.location='{{ url('/orders') }}'">Kembali</button>
                    </form>

                </div>
            </div>
        </div>
    @endsection
