@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="top-zone mt-3">
            <nav class="breadcrumb">
                <a class="breadcrumb-item text-decoration-none fs-5" href="/subscribers">Langganan</a>
                <span class="breadcrumb-item fs-5 active" aria-current="page">Edit</span>
            </nav>
          
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
                            <div id="order-section">
                                <div class="card-body">
                                    @foreach ($orders as $index => $order)
                                        <div class="order-item">
                                            <div class="row">
                                                <div class="col">
                                                    <label class="py-1" for="flowers_id">Bunga</label>
                                                    <select name="flowers_id[]" class="form-select" required>
                                                        <option>Pilih Daerah</option>
                                                        @foreach ($flowers as $row)
                                                            @if (old('flowers_id.'.$index, $order['flowers_id']) == $row->id)
                                                                <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                                            @else
                                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label class="py-1" for="count">Jumlah</label>
                                                    <input name="count[]" class="form-control py-1 @error('count') is-invalid @enderror"
                                                        type="text" value="{{ old('count.'.$index, $order['count']) }}" required>
                                                    @error('count.'.$index)
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    <button type="button" class="btn btn-danger remove-order">Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-primary" id="add-order">Tambah Pesanan</button>
                            </div>
                        </div>
                        <label class="py-1" for="day_id">Hari Langganan</label>
                        <select name="day_id" id="day_id" class="form-select" required>
                            <option value="" style="font-weight: 800"> Pilih ...</option>
                            @foreach ($day as $row)
                                @if (old('day_id', $data->day->id) == $row->id)
                                    <option value="{{ $row->id }}" selected>{{ $row->name }}
                                    </option>
                                @else
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endif
                            @endforeach
                        </select>

                        <label class="py-1" for="notes">Catatan</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" cols="30"
                            rows="5">{{ $data->notes }}</textarea>
                        @error('interest')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror



                        <button type="submit" class="btn btn-info my-3">Simpan</button>
                        <button type="button" class="btn btn-warning mx-3"
                            onclick="window.location='{{ url('/subscribers') }}'">Kembali</button>
                    </form>

                </div>
            </div>
        </div>
        <script>
            document.getElementById("add-order").addEventListener("click", function() {
                var orderSection = document.getElementById("order-section");
                var orderItem = document.createElement("div");
                orderItem.classList.add("order-item");
        
                var row = document.createElement("div");
                row.classList.add("row");
        
                var col1 = document.createElement("div");
                col1.classList.add("col");
        
                var label1 = document.createElement("label");
                label1.classList.add("py-1");
                label1.textContent = "Bunga";
        
                var select = document.createElement("select");
                select.setAttribute("name", "flowers_id[]");
                select.classList.add("form-select");
                select.required = true;
        
                // Tambahkan opsi select di sini
        
                col1.appendChild(label1);
                col1.appendChild(select);
        
                // Tambahkan kolom input jumlah (col2) dan tombol hapus (col3) di sini
        
                row.appendChild(col1);
                row.appendChild(col2);
                row.appendChild(col3);
        
                orderItem.appendChild(row);
                orderSection.querySelector(".card-body").appendChild(orderItem);
            });
        
            document.addEventListener("click", function(event) {
                if (event.target.classList.contains("remove-order")) {
                    var orderItem = event.target.closest(".order-item");
                    orderItem.parentNode.removeChild(orderItem);
                }
            });
        </script>
    @endsection
