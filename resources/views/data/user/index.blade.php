@extends('layouts.app')
@section('title', 'Data User - Sistem Informasi Apotek')
@section('user', 'active')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data User
        </h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span>{{ $message }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if (isset($errors) && $errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Avatar</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        <div class="text-center">
                                            @if ($user->avatar)
                                            <img class="rounded-circle" style="height:75px; width:75px;"
                                            src="{{ asset('storage/' . $user->avatar) }}">
                                            @else
                                            <img class="rounded-circle" style="height:75px; width:75px;"
                                            src="{{ asset('img/undraw_profile.svg') }}">
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $user->nama_user }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->no_hp }}</td>
                                    <td>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">
                                            <i class="fas fa-pen-to-square"></i>
                                        </a>
                                        <button type="submit" class="btn btn-danger"
                                            onclick="swalDelete({{ $user->id }})">
                                            <i class="fas fa-trash"></i>
                                            <form id="id-{{ $user->id }}"
                                                action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('head-script')
    <link href="{{ asset('datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@push('body-script')
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function swalDelete(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Yakin ingin menghapus user ini?',
                text: "Sekali dihapus data akan hilang",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#id-${id}`).submit();

                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Data user telah dihapus.',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Batal',
                        'User tidak jadi dihapus',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
