@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="top-zone mt-3">
            <nav class="breadcrumb">
                <a class="breadcrumb-item text-decoration-none fs-5" href="/roles">Roles</a>
                <span class="breadcrumb-item fs-5 active" aria-current="page">Edit</span>
            </nav>
            {{-- <div class="breadcrumbs mt-5 mb-0">
                <h4>
                    {!! Breadcrumbs::render('roles.index') !!} / Show
                </h4>
            </div> --}}
            <div class="card px-5">
                <div class="card-body">
                    <form action="/roles/{{ $data->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <label class="py-1" for="name">Nama</label>
                                <input name="name" class="form-control py-1 @error('name') is-invalid @enderror"
                                    type="text" value="{{ old('name', $data->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">

                            </div>
                        </div>

                        <h6 class="mt-3">Edit Roles</h6>

                        <table class="table table-responsive mt-3" cellpadding=10 cellspacing=0 border=1>
                            <thead>
                                <tr>
                                    <th>Menus</th>
                                    <th class="text-center">Read</th>
                                    <th class="text-center">Create</th>
                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><h6 class="my-2">Customers</h6></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="Read Customers"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="Create Customers"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="Edit Customers"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="Delete Customers"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h6 class="my-2">Data Langganan</h6></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                                 <tr>
                                    <td><h6 class="my-2">Data Riders</h6></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                                  <tr>
                                    <td><h6 class="my-2">Data Pesanan</h6></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                                 <tr>
                                    <td><h6 class="my-2">Ongkos Rider</h6></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                                 <tr>
                                    <td><h6 class="my-2">Tagihan Customers</h6></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                                  <tr>
                                    <td><h6 class="my-2">Dokumentasi Pesanan</h6></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="A"
                                                id="flexCheckDefault" name="permissions[]" {{ $finding->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>


                        <button type="submit" class="btn btn-info my-3">Simpan</button>
                        <button type="button" class="btn btn-warning mx-3"
                            onclick="window.location='{{ url('/roles') }}'">Kembali</button>
                    </form>

                </div>
            </div>
        </div>
    @endsection
