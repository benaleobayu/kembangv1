@extends('layouts.main')

@section('content')
    <div class="table p-2 mt-5">
        @can('Create_Langganan')
            <div class="fiturbutton p-3 d-flex flex-row-reverse">
                <button class="btn btn-primary" onclick="window.location='{{ url('/subscribers/create') }}'"><i
                        class="bi bi-plus-lg"></i><span class="me-2">Tambah</span> </button>
            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                data-bs-whatever="@mdo">Open modal for @mdo</button>
        @endcan
        <div class="searching-box">
            <form action="/subscribers" method="get">
                <div class="input-group w-25 mb-3 ms-auto">
                    <button onclick="window.location='/subscribers'" type="button" class="btn" rel="tooltip"
                        title="Reset"><i class="bi bi-arrow-clockwise"></i></button>

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
                                <button class="badge border-0 p-2 bg-info"
                                    onclick="window.location='{{ url('/subscribers/' . $d->id) }}'">
                                    <i class="bi bi-eye"></i>
                                </button>
                                @can('Edit_Langganan')
                                    <button class="badge border-0 p-2 bg-warning"
                                        onclick="window.location='{{ url('/subscribers/' . $d->id . '/edit') }}'">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                @endcan
                                @can('Delete_Langganan')
                                    <form action="/subscribers/{{ $d->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="badge border-0 p-2 bg-danger"
                                            onclick="return confirm('User akan dihapus?')">
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
        {{-- apadeh --}}

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog bg-white">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Recipient:</label>
                                <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                            <select class="js-example-basic-single" name="state" class="form-select">
                                <option value="AL">Alabama</option>
                                <option value="WY">Wyoming</option>
                                <option value="WY">Wyoming</option>
                                <option value="WY">Wyoming</option>
                                <option value="WY">Wyoming</option>
                                <option value="WY">Wyoming</option>
                            </select>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

        const exampleModal = document.getElementById('exampleModal')
        if (exampleModal) {
            exampleModal.addEventListener('show.bs.modal', event => {
                // Button that triggered the modal
                const button = event.relatedTarget
                // Extract info from data-bs-* attributes
                const recipient = button.getAttribute('data-bs-whatever')
                // If necessary, you could initiate an Ajax request here
                // and then do the updating in a callback.

                // Update the modal's content.
                const modalTitle = exampleModal.querySelector('.modal-title')
                const modalBodyInput = exampleModal.querySelector('.modal-body input')

                modalTitle.textContent = `New message to ${recipient}`
                modalBodyInput.value = recipient
            })
        }
    </script>
@endsection
