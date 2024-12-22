@extends('layouts.app')

@section('content')
    <x-page-header title="Category" />

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-lg-8 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Category</h3>
                        </div>
                        <div class="table-responsive p-3" id="table"></div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Category</h3>
                        </div>

                        <div class="mb-3 p-3">
                            <label class="form-label required">Nama</label>
                            <div>
                                <input type="text" class="form-control" id="name" placeholder="Masukkan Nama Category" autocomplete="off">
                            </div>
                        </div>

                        <div class="mb-3 align-items-center justify-content-center d-flex">
                            <button class="btn btn-primary d-none d-sm-inline-block create-button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Tambah Category
                            </button>
                            <a href="{{ route('category.index') }}" class="btn btn-success d-none back-button">
                                Kembali
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            table();

            const Toast = Swal.mixin({
                toast: true,
                icon: "success",
                title: "General Title",
                animation: false,
                position: "top-right",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });

            $('.create-button').click(function() {
                var name = $('#name').val();

                $.ajax({
                    type: "post",
                    url: "{{ route('category.store') }}",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        name: name,
                    },
                    success: function(response) {
                        document.getElementById('name').value = '';

                        table();

                        Toast.fire({
                            animation: true,
                            title: response.message,
                        })
                    },
                    error: function(response) {
                        console.log(response);
                    }
                })
            })

            $(document).on('click', '.delete-button', function() {

                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Hapus!",
                }).then((result) => {
                    if (result.isConfirmed) {

                        var id = $(this).data('id');
                        var url = "{{ route('category.destroy', ':id') }}";
                        url = url.replace(':id', id);

                        $.ajax({
                            type: "delete",
                            url: url,
                            data: {
                                _token: $('meta[name="csrf-token"]').attr("content"),
                                id: id,
                            },
                            success: function(response) {
                                table();

                                Toast.fire({
                                    animation: true,
                                    title: response.message,
                                })
                            },
                            error: function(response) {
                                console.log(response);
                            }
                        })
                    }
                });
            })

            $(document).on('click', '.edit-button', function() {
                var id = $(this).data('id');
                var url = "{{ route('category.edit', ':id') }}";
                url = url.replace(':id', id);
                var updateButton = document.querySelector('.create-button');
                updateButton.classList.add('update-button');

                document.querySelector('.back-button').classList.remove('d-none');

                $.get(url, function(data) {
                    document.getElementById('name').value = data.data.name;
                    updateButton.innerHTML = 'Update'
                    updateButton.setAttribute('data-id', data.data.id)
                })

                updateButton.addEventListener('click', function() {
                    var id = $(this).data('id');
                    var url = "{{ route('category.update', ':id') }}";
                    url = url.replace(':id', id);

                    var name = $('#name').val();

                    $.ajax({
                        type: "put",
                        url: url,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr("content"),
                            name: name,
                        },
                        success: function(response) {
                            document.getElementById('name').value = '';

                            table();

                            Toast.fire({
                                animation: true,
                                title: response.message,
                            })
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    })
                })

            })
        })

        function table() {
            $.get("{{ route('category.table') }}", function(data) {
                $('#table').html(data);
                new DataTable('#categoryTable');
            })
        }
    </script>
@endsection
