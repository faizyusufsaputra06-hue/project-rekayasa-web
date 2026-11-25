
@extends('admin.template')

@section('title', 'Halaman User')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <!-- Bagian Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">Data user</h5>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary" id="btnAdd">
                    Tambah Data
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Tabel Data User -->
        <div class="table-responsive">
            <table id="tb_user" class="table table-bordered table-striped align-middle" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th width="40" class="text-center">No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="modalUser" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formUser">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required minlength="8">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Masukkan nomor telepon">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Masukkan alamat"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="submit" form="formUser" class="btn btn-primary" id="btnSave">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {

        // Menampilkan Data User menggunakan DataTables
        let table = $('#tb_user').DataTable({
            processing: true,
            ajax: {
                url: '{{ route("list-users") }}',
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + API_TOKEN,
                    'Accept': 'application/json'
                },
                dataSrc: 'data',
                error: function(xhr, error, thrown) {
                    console.log(xhr.responseText);
                    toastr.error('Gagal mengambil data user');
                }
            },
            columns: [
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'name' },
                { data: 'email' },
                { data: 'phone' },
                { data: 'address' },
                { data: 'role' },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <button type="button" class="btn btn-warning btn-sm btn-edit" data-id="${row.id}">
                                Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="${row.id}">
                                Hapus
                            </button>
                        `;
                    }
                }
            ],
            initComplete: function(settings, json) {
                if (json && json.message) {
                    toastr.success(json.message);
                }
            }
        });
        // Membuka Modal Tambah Data
        $('#btnAdd').click(function() {
            $('#formUser')[0].reset();
            $('#modalUser .modal-title').text('Tambah Data User');
            let modal = new bootstrap.Modal(document.getElementById('modalUser'));
            modal.show();
        });

        // Menyimpan Data User
        $('#formUser').submit(function(e) {
            e.preventDefault();
            let button = $('#btnSave');
            button.prop('disabled', true).text('Menyimpan...');
            $.ajax({
                url: '{{ route("users.store") }}',
                type: 'POST',
                data: $(this).serialize(),
                headers: {
                    'Authorization': 'Bearer ' + API_TOKEN,
                    'Accept': 'application/json'
                },

                success: function(response) {
                    toastr.success(response.message || 'Data user berhasil ditambahkan');
                    bootstrap.Modal.getInstance(
                        document.getElementById('modalUser')
                    ).hide();
                    $('#formUser')[0].reset();
                    table.ajax.reload();
                },

                error: function(xhr) {
                    console.log(xhr.responseJSON);
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value[0]);
                        });
                    } else if (xhr.status === 401) {
                        toastr.error('Token tidak valid. Silakan login kembali.');
                    } else {
                        toastr.error(xhr.responseJSON?.message || 'Gagal menyimpan data user');
                    }
                },

                complete: function() {
                    button.prop('disabled', false).text('Simpan');
                }
            });
        });
    });
</script>
@endpush
