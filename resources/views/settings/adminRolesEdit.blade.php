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
                    <form action="/roles/{{ $spell->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <label class="py-1" for="name">Nama</label>
                                <input name="name" class="form-control py-1 @error('name') is-invalid @enderror"
                                    type="text" value="{{ old('name', $spell->name) }}" required>
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

                        <input type="checkbox" id="check-all"> Check All <br>

                        <input class="form-check-input d-none" type="checkbox" value="Access" id="flexCheckDefault" name="permissions[]" checked >

                        <table class="table table-responsive mt-3" cellpadding=10 cellspacing=0 border=1>
                            <thead>
                                <tr>
                                    <th style="width:40%">Menu Data</th>
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
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $read . $Customers }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($read . $Customers) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $create . $Customers }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($create . $Customers) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $edit . $Customers }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($edit . $Customers) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $delete . $Customers }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($delete . $Customers) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h6 class="my-2">Data Langganan</h6></td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $read . $Langganan }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($read . $Langganan) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $create . $Langganan }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($create . $Langganan) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $edit . $Langganan }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($edit . $Langganan) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $delete . $Langganan }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($delete . $Langganan) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                                 <tr>
                                    <td><h6 class="my-2">Data Riders</h6></td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $read . $DataRiders }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $read . $DataRiders) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $create . $DataRiders }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $create . $DataRiders) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $edit . $DataRiders }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $edit . $DataRiders) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $delete . $DataRiders }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $delete . $DataRiders) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                                  <tr>
                                    <td><h6 class="my-2">Data Pesanan</h6></td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $read . $DataOrders }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $read . $DataOrders) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $create . $DataOrders }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $create . $DataOrders) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $edit . $DataOrders }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $edit . $DataOrders) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $delete . $DataOrders }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $delete . $DataOrders) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                                 <tr>
                                    <td><h6 class="my-2">Ongkos Rider</h6></td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $read . $PaymentRiders }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $read . $PaymentRiders) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $create . $PaymentRiders }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $create . $PaymentRiders) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $edit . $PaymentRiders }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $edit . $PaymentRiders) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $delete . $PaymentRiders }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $delete . $PaymentRiders) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                                 <tr>
                                    <td><h6 class="my-2">Tagihan Customers</h6></td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $read . $Invoices }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $read . $Invoices) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $create . $Invoices }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $create . $Invoices) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $edit . $Invoices }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $edit . $Invoices) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $delete . $Invoices }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $delete . $Invoices) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                                  <tr>
                                    <td><h6 class="my-2">Dokumentasi Pesanan</h6></td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $read . $Dokumentasi }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $read . $Dokumentasi) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $create . $Dokumentasi }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $create . $Dokumentasi) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $edit . $Dokumentasi }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $edit . $Dokumentasi) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $delete . $Dokumentasi }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo( $delete . $Dokumentasi) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        <table class="table table-responsive mt-3" cellpadding=10 cellspacing=0 border=1>
                            <thead>
                                <tr>
                                    <th style="width:40%">Menu Settings</th>
                                    <th class="text-center">Read</th>
                                    <th class="text-center">Create</th>
                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><h6 class="my-2">Admin</h6></td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $read . $Admin }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($read . $Admin) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $create . $Admin }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($create . $Admin) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $edit . $Admin }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($edit . $Admin) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $delete . $Admin }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($delete . $Admin) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h6 class="my-2">Roles</h6></td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $read . $Roles }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($read . $Roles) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $create . $Roles }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($create . $Roles) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $edit . $Roles }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($edit . $Roles) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $delete . $Roles }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($delete . $Roles) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h6 class="my-2">List Regency</h6></td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $read . $Regency }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($read . $Regency) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $create . $Regency }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($create . $Regency) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $edit . $Regency }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($edit . $Regency) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $delete . $Regency }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($delete . $Regency) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h6 class="my-2">List Flowers</h6></td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $read . $Flower }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($read . $Flower) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $create . $Flower }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($create . $Flower) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $edit . $Flower }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($edit . $Flower) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center my-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $delete . $Flower }}"
                                                id="flexCheckDefault" name="permissions[]" {{ $spell->hasPermissionTo($delete . $Flower) ? 'checked' : '' }}>
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
