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

@push('modal_selectName')
<script>
    document.addEventListener('DOMContentLoaded', function() {
      const openModalBtn = document.getElementById('openModalBtn');
  
      openModalBtn.addEventListener('click', function() {
        swal({
          title: 'Konfirmasi',
          text: 'Apakah Anda ingin membuka modal?',
          icon: 'warning',
          buttons: ['No', 'Yes'],
          dangerMode: true,
        }).then((confirmed) => {
          if (confirmed) {
            // Tindakan yang ingin Anda lakukan jika pengguna memilih "Yes"
            swal({
              title: 'Modal SweetAlert',
              content: {
                element: 'form',
                attributes: {
                  id: 'myForm',
                  action: '/subscribers',
                  method: 'POST',
                },
              },
              buttons: {
                cancel: true,
                confirm: {
                  text: 'Submit',
                  closeModal: false,
                },
              },
            }).then((value) => {
              // Tindakan yang ingin Anda lakukan setelah pengguna menekan tombol "Submit"
              if (value) {
                document.getElementById('myForm').submit();
              }
            });
  
            // Tambahkan form select ke dalam modal SweetAlert
            const form = document.getElementById('myForm');
            const select = document.createElement('select');
            select.id = 'selectOption';
            select.name = 'selectOption';
  
            // Inisialisasi Select2 pada elemen select setelah elemen tersebut ditambahkan ke dalam DOM
            $(document).ready(function() {
              $(select).select2();
            });
  
            // Perulangan foreach untuk menambahkan opsi-opsi pada form select
            const options = {!! json_encode($dataName->pluck('name')) !!};
            options.forEach(option => {
              const optionElement = document.createElement('option');
              optionElement.value = option;
              optionElement.text = option;
              select.appendChild(optionElement);
            });
  
            // Tambahkan token CSRF pada formulir
            const csrfField = document.createElement('input');
            csrfField.type = 'hidden';
            csrfField.name = '_token';
            csrfField.value = '{{ csrf_token() }}';
  
            form.appendChild(csrfField);
            form.appendChild(select);
          }
        });
      });
    });
  </script>
  
@endpush
