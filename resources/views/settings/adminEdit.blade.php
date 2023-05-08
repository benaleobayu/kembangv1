@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="top-zone mt-3">
            <nav class="breadcrumb">
                <a class="breadcrumb-item text-decoration-none fs-5" href="/admin">Admin</a>
                <span class="breadcrumb-item fs-5 active" aria-current="page">Edit</span>
            </nav>
            {{-- <div class="breadcrumbs mt-5 mb-0">
                <h4>
                    {!! Breadcrumbs::render('admin.index') !!} / Show
                </h4>
            </div> --}}
            <div class="card px-5">
                <div class="card-body">
                    <form action="/admin/{{ $data->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col">
                                <label class="py-1" for="name">Nama</label>
                                <input name="name" class="form-control py-1 @error('name') is-invalid @enderror"
                                    type="text" value="{{ old('name', $data->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label class="py-1" for="username">Username</label>
                                <input name="username" class="form-control py-1 @error('username') is-invalid @enderror"
                                    type="text" value="{{ old('username', $data->username) }}" required>
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label class="py-1" for="email">Email</label>
                                <input name="email" class="form-control py-1 @error('email') is-invalid @enderror"
                                    type="email" value="{{ old('email', $data->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="py-1" for="password">Password</label>
                                <input type="hidden" name="oldPassword" value="{{ $data->password }}">
                                <input name="password" class="form-control py-1 @error('password') is-invalid @enderror"
                                    type="password" placeholder="isi bila ingin ubah password" >
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>


                        <label class="py-1" for="roles_id">roles_id</label>
                        <select name="roles_id" id="roles_id" class="form-select" required>
                            <option>Pilih Roles</option>
                            @foreach ($roles as $row)
                                @if (old('roles_id', $data->roles->id) == $row->id)
                                    <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                @else
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endif
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-info my-3">Simpan</button>
                        <button type="button" class="btn btn-warning mx-3"
                            onclick="window.location='{{ url('/admin') }}'">Kembali</button>
                    </form>

                </div>
            </div>
        </div>
    @endsection
