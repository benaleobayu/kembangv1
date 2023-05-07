@extends('layouts.main')

@section('content')
        <div class="table p-2 mt-5">
            <div class="fiturbutton p-3 d-flex flex-row-reverse">
                <button class="btn btn-primary" onclick="window.location='{{ url('/customers/create') }}'"><i
                        class="bi bi-plus-lg"></i><span class="me-2">Tambah</span> </button>
            </div>
            <div class="searching-box">
                <form action="/customers" method="get">
                    <div class="input-group w-25 mb-3 ms-auto">
                        <input type="text" class="form-control" placeholder="Cari ..." aria-label="Cari Riders"
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
                        <th>Alamat & No.Hp</th>
                        <th>Daerah</th>
                        <th>Catatan</th>
                        <th>Create at</th>
                        <th>Update at</th>
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
                            <td>{{ $d->name }}</td>
                            <td class="w-25">{{ $d->address }}, {{ $d->regencies->name }}, {{ $d->regencies->city }} <br> Telp :
                                {{ $d->phone }}</td>
                            <td>{{ $d->regencies->name }}</td>
                            <td class="w-25">{{ $d->interest }}</td>
                            <td>{{ $d->created_at }}</td>
                            <td>{{ $d->updated_at }}</td>
                            <td style="white-space: nowrap">
                                <button class="badge border-0 p-2 bg-info" onclick="window.location='{{ url('/customers/' . $d->id) }}'">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="badge border-0 p-2 bg-warning"
                                    onclick="window.location='{{ url('/customers/' . $d->id . '/edit') }}'">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="/customers/{{ $d->id }}" method="post" class="d-inline">
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
