@push('alert_import')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Menggunakan SweetAlert untuk konfirmasi sebelum mengimpor data
        document.getElementById('import-form').addEventListener('submit', function (event) {
            event.preventDefault(); // Mencegah form submit secara langsung
    
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin mengimpor data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi diterima, submit form secara asynchronous menggunakan fetch
                    fetch(event.target.action, {
                        method: event.target.method,
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams(new FormData(event.target))
                    }).then(response => {
                        if (response.ok) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Data berhasil diimpor.',
                                icon: 'success'
                            }).then(() => {
                                // Me-refresh halaman setelah submit berhasil
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Terjadi kesalahan saat mengimpor data.',
                                icon: 'error'
                            });
                        }
                    }).catch(error => {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat mengimpor data.',
                            icon: 'error'
                        });
                    });
                }
            });
        });
    </script>
@endpush
