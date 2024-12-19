@extends('layouts.app')

@section('content')
    <x-page-header title="Users">
        <button class="btn btn-primary d-none d-sm-inline-block" onclick="create()">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
            </svg>
            Tambah User
        </button>

    </x-page-header>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Invoices</h3>
                        </div>
                        <div class="table-responsive p-3" id="table"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal title="User" modal-id="modal-user">
        <div id="modal-body"></div>
    </x-modal>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            table();

            $("#tombol-simpan").click(function() {
                console.log("update");
            })
        })

        function table() {
            $.get("{{ route('users.table') }}", {}, function(data, status) {
                $("#table").html(data);
                new DataTable('#userTable');
            });
        }

        function showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function create() {
            $.get("{{ route('users.create') }}", {}, function(data, status) {
                $("#modal-body").html(data);
                $("#modal-user").modal('show');
            });
        }

        function store() {
            var photo = $("#photo").val();
            var name = $("#name").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var role = $("#role").val();

            $.ajax({
                type: "post",
                url: "{{ route('users.store') }}",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    photo: photo,
                    name: name,
                    email: email,
                    password: password,
                    role: role
                },
                success: function(data) {
                    $("#modal-user").modal('hide');

                    Swal.fire({
                        title: "Success",
                        text: "User berhasil ditambahkan",
                        icon: "success",
                    });

                    table();

                },
                error: function(data) {
                    $('#errors').removeClass('d-none');
                    $('#errors').html('<ul>');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $('#errors ul').append('<li>' + value + '</li>');
                    });
                    $('#errors').append('</ul>');
                }
            });
        }

        function show(id) {
            var url = "{{ route('users.show', ':id') }}";
            url = url.replace(':id', id);
            $.get(url, {}, function(data, status) {
                $("#modal-body").html(data);
                $("#modal-user").modal('show');
            });
        }

        function update(id) {
            var url = "{{ route('users.update', ':id') }}";
            url = url.replace(':id', id);

            var photo = $("#photo").val();
            var name = $("#name").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var role = $("#role").val();

            $.ajax({
                type: "PUT",
                url: url,
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    photo: photo,
                    name: name,
                    email: email,
                    password: password,
                    role: role
                },
                success: function(data) {

                    $("#modal-user").modal('hide');

                    Swal.fire({
                        title: "Success",
                        text: "User berhasil diupdate",
                        icon: "success",
                    });

                    table();

                },
                error: function(data) {
                    $('#errors').removeClass('d-none');
                    $('#errors').html('<ul>');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $('#errors ul').append('<li>' + value + '</li>');
                    });
                    $('#errors').append('</ul>');
                }
            })

        }

        function destroy(id) {
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
                    var url = "{{ route('users.destroy', ':id') }}";
                    url = url.replace(':id', id);
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr("content")
                        },
                        success: function(data) {
                            Swal.fire({
                                title: "Success",
                                text: "User berhasil dihapus",
                                icon: "success",
                            });
                            table();
                        }
                    })
                }
            });

        }
    </script>
@endsection
