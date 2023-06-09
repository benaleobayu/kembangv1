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
                    <form action="/subscribers" method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="py-1" for="selectName">Nama</label>
                                <select name="name" id="selectName" class="form-select py-1 mt-1" required oninput="getCustomerData(this.value)">
                                    @foreach ($data as $row)
                                        @if (old('name') == $row->id)
                                            <option value="{{ $row->name }}" selected>{{ $row->name }}</option>
                                        @else
                                            <option value="{{ $row->name }}">{{ $row->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label class="py-1" for="phone">Nomor Handphone</label>
                                <input name="phone" id="phone" class="form-control py-1 @error('phone') is-invalid @enderror"
                                    type="text" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <label class="py-1" for="address">Alamat</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" cols="30"
                            rows="3">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <label class="py-1" for="regencies_id">Daerah</label>
                        <select name="regencies_id" id="regencies_id" class="form-select">
                            <option>Pilih Daerah</option>
                            @foreach ($regency as $row)
                                @if (old('regencies_id') == $row->id)
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
                                            <option value="">Pilih Bunga</option>
                                            @foreach ($flowers as $row)
                                                @if (old('flowers_id') == $row->id)
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
                                            type="text" value="{{ old('total') }}" required>
                                        @error('total')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <label class="py-1" for="day">Hari Pengiriman</label>
                                <select name="day_id" id="day_id" class="form-select" required>
                                    @foreach ($day as $row)
                                        @if (old('day_id') == $row->id)
                                            <option value="{{ $row->id }}" selected>{{ $row->name }}
                                            </option>
                                        @else
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                <label class="py-1" for="notes">Catatan</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" cols="30"
                                    rows="5">{{ old('notes') }}</textarea>
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
        <script>
            function getCustomerData(name) {
                fetch('/get-customer-data/' + name)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('address').value = data.address;
                        document.getElementById('phone').value = data.phone;
                        document.getElementById('regencies_id').value = data.regencies_id;
                        document.getElementById('notes').value = data.notes;
                    });
            }
        </script>
    @endsection
