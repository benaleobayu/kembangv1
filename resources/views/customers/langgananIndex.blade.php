@extends('layouts.main')

@section('content')
    <div class="table p-2 mt-5">
        <div class="fiturbutton p-3 d-flex flex-row-reverse">
            <button class="btn btn-primary" onclick="window.location='{{ url('/subscribers/create') }}'"><i
                    class="bi bi-plus-lg"></i><span class="me-2">Tambah</span> </button>
        </div>
        <div class="searching-box">
            <form action="/subscribers" method="get">
                <div class="input-group w-25 mb-3 ms-auto">
                    <input type="text" class="form-control" placeholder="Cari Riders..." aria-label="Cari Riders"
                        aria-describedby="button-addon2" name="search" value="{{ $search }}">
                    <button class="btn btn-outline-secondary px-3" type="submit" id="button-addon2">Cari</button>
                </div>
            </form>
        </div>
        <table cellpadding=10 cellspacing=0 border=1 class="w-100">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Bunga</th>
                    <th class="text-center">Jumlah</th>
                    <th>Daerah</th>
                    <th>Catatan</th>
                    <th>Hari</th>
                    <th>PIC</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $nomor = 1 + ($data->currentPage() - 1) * $data->perPage();
                @endphp
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $nomor++ }}</td>
                        <td>{{ $d->name }} <hr> {{ $d->address }}, {{ $d->regencies->name }}, {{ $d->regencies->city }} <br> Telp :
                            {{ $d->phone }}</td>
                        <td>{{ $d->flowers->name }}</td>
                        <td class="text-center">{{ $d->total }}</td>
                        <td>{{ $d->regencies->name }}</td>
                        <td>{{ $d->notes }}</td>
                        <td>{{ $d->pic }}</td>
                        <td style="white-space: nowrap">
                            <button class="badge border-0 p-2 bg-info" onclick="window.location='{{ url('/subscribers/' . $d->id) }}'">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button class="badge border-0 p-2 bg-warning"
                                onclick="window.location='{{ url('/subscribers/' . $d->id . '/edit') }}'">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="/subscribers/{{ $d->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge border-0 p-2 bg-danger" onclick="return confirm('User akan dihapus?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show position-absolute end-0 top-0" role="alert">
                <strong>{{ session('success') }}!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

@endsection
