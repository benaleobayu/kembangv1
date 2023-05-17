@extends('layouts.main')

@section('content')
    <div class="table p-2 mt-5">
        @can('Create_Langganan')
            <div class="fiturbutton p-3 d-flex flex-row-reverse">
                <button class="btn btn-primary" onclick="window.location='{{ url('/orders/create') }}'"><i
                        class="bi bi-plus-lg"></i><span class="me-2">Tambah</span> </button>
            </div>
        @endcan
        <div class="row search-breadcrumbs d-flex">
            <div class="col d-flex">
                <div class="flex-row">
                    <form action="/orders/import" method="POST" id="import-form">
                        @csrf
                        <label for="day_id">Import Hari:</label>
                        <div class="input-group mb-3 ms-auto">
                            <select name="day_id" id="day_id" class="form-select">
                                @foreach ($days as $day)
                                    <option value="{{ $day->id }}">{{ $day->name }}</option>
                                @endforeach
                            </select>
                            <button class="import-btn btn btn-primary rounded d-inline" type="submit">Import</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col d-flex align-items-end flex-row-reverse">
                <form action="/orders/{{ $slug }}" method="get">
                    <div class="input-group mb-3 ms-auto">
                        <button onclick="window.location='/orders/{{ $slug }}'" type="button" class="btn"
                            rel="tooltip" title="Reset"><i class="bi bi-arrow-clockwise"></i></button>

                        <input type="text" class="form-control rounded-start" placeholder="Cari ..." aria-label="Cari"
                            aria-describedby="button-addon2" name="search" value="{{ $search }}">
                        <button class="btn btn-outline-secondary px-3" type="submit" id="button-addon2">Cari</button>
                    </div>
                </form>
            </div>
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

                @if (count($data) > 0)
                    @php
                        $nomor = 1 + ($data->currentPage() - 1) * $data->perPage();
                    @endphp
                    @foreach ($data as $d)
                        <tr>
                            <td class="text-top">{{ $nomor++ }}</td>
                            <td>{{ $d->name }}
                                <hr> {{ $d->address }}, {{ $d->regencies->name }}, {{ $d->regencies->city }} <br> Telp :
                                {{ $d->phone }}
                            </td>
                            <td class="text-top">{{ $d->flowers->name }}</td>
                            <td class="text-top text-center">{{ $d->total }}</td>
                            <td class="text-top">{{ $d->regencies->name }}</td>
                            <td class="text-top">{{ $d->notes }}</td>
                            <td class="text-top">{{ $d->day->name }}</td>
                            <td class="text-top">{{ $d->pic }}</td>
                            <td class="text-top" style="white-space: nowrap">
                              
                                @can('Edit_Langganan')
                                    <button class="badge border-0 p-2 bg-warning"
                                        onclick="window.location='{{ url('/orders/' . $d->id . '/edit') }}'">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                @endcan
                                @can('Delete_Langganan')
                                    <form action="/orders/{{ $d->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="delete-btn badge border-0 p-2 bg-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="p-0">
                            <h1 class="position-absolute top-50 start-50">No Results</h1>
                        </td>
                    </tr>
                @endif

            </tbody>
        </table>
        {{ $data->links() }}


    </div>
    @push('alert_delete')
        @include('layouts.sweetalert.alert-delete')
    @endpush
    
    @push('alert_import')
        @include('layouts.sweetalert.alert-import')
    @endpush

@endsection
