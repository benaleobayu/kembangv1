@push('alert_delete')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    const url = this.parentNode.action;

                    swal({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin menghapus data ini?',
                        icon: 'warning',
                        buttons: ['Batal', 'Hapus'],
                        dangerMode: true,
                    }).then((confirmed) => {
                        if (confirmed) {
                            // Lakukan permintaan Ajax ke URL penghapusan
                            axios.delete(url)
                                .then(response => {
                                    // Tindakan yang ingin Anda lakukan setelah penghapusan berhasil
                                    // Contoh: Menampilkan notifikasi, memperbarui tampilan, dll.
                                    swal('Berhasil', 'Data berhasil dihapus', 'success')
                                        .then(() => {
                                            location
                                                .reload(); // Memuat ulang halaman setelah penghapusan berhasil
                                        });
                                })
                                .catch(error => {
                                    // Tindakan yang ingin Anda lakukan jika terjadi kesalahan
                                    swal('Error',
                                        'Terjadi kesalahan saat menghapus data',
                                        'error');
                                });
                        }
                    });
                });
            });
        });
    </script>
@endpush