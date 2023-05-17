@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="top-zone mt-3">
            <nav class="breadcrumb">
                <a class="breadcrumb-item text-decoration-none fs-5" href="/daysubscribs">By Date Langganan</a>
                <span class="breadcrumb-item fs-5 active" aria-current="page">Edit</span>
            </nav>
        
            <div class="card px-5">
                <div class="card-body">
                    <form action="/{{ $onSlug }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="py-1" for="name">Nama</label>
                                <select class="form-select @error('name') is-invalid @enderror" name="name" id="name" oninput="generateSlug()" required>
                                    @foreach ($days as $day)
                                        <option value="{{ $day->name }}">{{ $day->name }}</option>
                                    @endforeach
                                </select>
                               
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label class="py-1" for="slug">Slug</label>
                                <input name="slug" id="slug" class="form-control py-1 @error('slug') is-invalid @enderror"
                                    type="text" value="{{ old('slug')}}" required readonly>
                                @error('slug')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col">
                                <label class="py-1" for="date">Tanggal</label>
                                <input name="date" class="form-control py-1 @error('date') is-invalid @enderror"
                                    type="date" value="{{ old('date')}}" required oninput="generateSlug()">
                                @error('date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col">
                        
                            </div>
                        </div>
        
                        <button type="submit" class="btn btn-info my-3">Simpan</button>
                        <button type="button" class="btn btn-warning mx-3"
                            onclick="window.location='{{ url('/daysubscribs') }}'">Kembali</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function generateSlug() {
            var name = document.getElementsByName('name')[0].value;
            var date = document.getElementsByName('date')[0].value;
    
            // Menggabungkan nilai name dan date
            var slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-') + '-' + date;
    
            document.getElementById('slug').value = slug;
        }
    
        // Memanggil generateSlug() saat halaman dimuat untuk menginisialisasi nilai slug
        window.onload = function() {
            generateSlug();
        };
    </script>
@endsection
