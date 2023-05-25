@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="top-zone mt-3">
            <nav class="breadcrumb">
                <a class="breadcrumb-item text-decoration-none fs-5" href="/orders">Langganan</a>
                <span class="breadcrumb-item fs-5 active" aria-current="page">Edit</span>
            </nav>
        
            <div class="card px-5">
                <div class="card-body">
                    <form action="/orders" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="py-1" for="name">Nama</label>
                                <input name="name" class="form-control py-1 @error('name') is-invalid @enderror"
                                    type="text" value="{{ old('name')}}" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label class="py-1" for="phone">Nomor Handphone</label>
                                <input name="phone" class="form-control py-1 @error('phone') is-invalid @enderror"
                                    type="text" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
        
                        <label class="py-1" for="address">Alamat</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" cols="30"
                            rows="3" required>{{ old('address')}}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
        
                        <label class="py-1" for="regencies_id">Daerah</label>
                        <select name="regencies_id" id="regencies_id" class="form-select" required>
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
                                <div class="row">
                                    <div class="col">Pesanan</div>
                                    <div class="col d-flex flex-row-reverse">
                                        <button type="button" class="btn btn-primary" id="add-pesanan">Tambah
                                            Pesanan</button>
                                    </div>
                                </div>
        
                            </div>
                            <div id="order-section">
                                <div class="card-body" id="pesanan-container">
                                   
                                </div>
                            </div>
                        </div>
                        <label class="py-1" for="day_id">Hari Pengiriman</label>
                        <select name="day_id" id="day_id" class="form-select" required data-validation="[NOTEMPTY]">
                            <option value="">{{ $day->id }}</option>
                            @foreach ($day as $row)
                                @if (old('day_id') == $row->id)
                                    <option value="{{ $row->id }}" selected>{{ $row->name }} - {{ $row->date }}</option>
                                @else
                                    <option value="{{ $row->id }}">{{ $row->name }} - {{ $row->date }}</option>
                                @endif
                            @endforeach
                        </select>
        
                        <label class="py-1" for="notes">Catatan</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" cols="30"
                            rows="5">{{ old('')}}</textarea>
                        @error('interest')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="row mt-3">
                            <div class="col-6">
                                <label for="image">Hasil Pengerjaan</label>
                                <input type="hidden" name="oldImage" value="{{ old('')}}">
                                @if (old(''))
                                    <img src="{{ asset('storage/' . old('')) }}" alt="" class="img-preview img-fluid  mb-3 d-block" style="max-height: 400px; border: 1px solid darkgrey; border-radius: 5px">
                                @else
                                    <img src="" alt=""
                                        class="img-preview img-fluid mb-3 d-block" style="max-height: 400px">
                                @endif
                                <input type="file" class="form-control  @error('image') is-invalid @enderror" name="image" id="image" onchange="previewImage()">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
        
                        <button type="submit" class="btn btn-info my-3">Simpan</button>
                        <button type="button" class="btn btn-warning mx-3"
                            onclick="window.location='{{ url('/orders') }}'">Kembali</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            // Mendapatkan data bunga dari server
            var flowersData = @json($flowers);
            let index = 0;
                        // Event listener untuk tombol "Tambah Pesanan"
            document.getElementById('add-pesanan').addEventListener('click', function() {
                addPesananInput(index);
                index++
            });
        
            // Event listener untuk tombol "Hapus Pesanan"
            document.getElementById('pesanan-container').addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-pesanan')) {
                    removePesananInput(e.target.parentNode.parentNode.parentNode);
                }
            });
        
            // Fungsi untuk menambahkan input pesanan
            function addPesananInput(index) {
                var container = document.getElementById('pesanan-container');
                var pesananItem = document.createElement('div');
                pesananItem.classList.add('pesanan-item');
                pesananItem.innerHTML = `
                    <div class="row d-flex">
                        <div class="col">
                            <label class="py-1" for="flowers_id">Bunga</label>
                            <select name="pesanans[${index}][flowers_id]" class="form-select" required>
                                ${generateFlowersOptions()}
                            </select>
                        </div>
                        <div class="col">
                            <label class="py-1" for="total">Total</label>
                            <input name="pesanans[${index}][total]" class="form-control py-1" type="text" required>
                        </div>
                        <div class="col d-flex align-items-end">
                            <button type="button" class="btn btn-danger remove-pesanan">Hapus Pesanan</button>
                        </div>
                    </div>
                `;
                container.appendChild(pesananItem);
            }
            
        
            // Fungsi untuk menghapus input pesanan
            function removePesananInput(pesananItem) {
                pesananItem.remove();
            }
        
            // Fungsi untuk menghasilkan opsi bunga dalam elemen select
            function generateFlowersOptions() {
                var options = '';
                flowersData.forEach(function(flower) {
                    options += `<option value="${flower.id}">${flower.name}</option>`;
                });
                return options;
            }
        </script>
    @endsection
