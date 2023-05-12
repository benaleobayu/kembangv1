@extends('layouts.main')

@section('content')
    <div class="table p-2 mt-5">
        <div class="fiturbutton p-3 d-flex flex-row-reverse">
            <button class="btn btn-primary" onclick="window.location='{{ url('/orders/create') }}'"><i
                    class="bi bi-plus-lg"></i><span class="me-2">Tambah</span> </button>
        </div>
        <div class="searching-box">
            <form action="/orders" method="get">
                <div class="input-group w-25 mb-3 ms-auto">
                    <button onclick="window.location='/orders'"  type="button" class="btn" rel="tooltip" title="Reset"><i class="bi bi-arrow-clockwise"></i></button>

                    <input type="text" class="form-control rounded-start" placeholder="Cari ..." aria-label="Cari"
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
                    <th>Tanggal</th>
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
                        <td class="text-top">{{ $nomor++ }}</td>
                        <td>{{ $d->name }} <hr> {{ $d->address }}, {{ $d->regencies->name }}, {{ $d->regencies->city }} <br> Telp :
                            {{ $d->phone }}</td>
                        <td class="text-top">{{ $d->flowers->name }}</td>
                        <td class="text-top text-center">{{ $d->total }}</td>
                        <td class="text-top">{{ $d->regencies->name }}</td>
                        <td class="text-top">{{ $d->notes }}</td>
                        <td class="text-top">{{ $d->date }}</td>
                        <td class="text-top">{{ $d->pic }}</td>
                        <td class="text-top" style="white-space: nowrap">
                            <button class="badge border-0 p-2 bg-info" onclick="window.location='{{ url('/orders/' . $d->id) }}'">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button class="badge border-0 p-2 bg-warning"
                                onclick="window.location='{{ url('/orders/' . $d->id . '/edit') }}'">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="/orders/{{ $d->id }}" method="post" class="d-inline">
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

        
    </div>

@endsection
