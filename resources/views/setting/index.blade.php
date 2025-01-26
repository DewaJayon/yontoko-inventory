@extends('layouts.app')
@section('content')
    <x-page-header title="Settings" />

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="row g-0">
                    <div class="col-12 col-md-3 border-end">
                        <div class="card-body">
                            <h4 class="subheader">Settings</h4>
                            <div class="list-group list-group-transparent">
                                <a href="{{ route('setting.index') }}" class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('setting.index') ? 'active' : '' }}">
                                    Account
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-9 d-flex flex-column">
                        <div class="card-body">
                            <h2 class="mb-4">Account</h2>
                            <h3 class="card-title">Profile Details</h3>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img src="{{ asset('storage/' . auth()->user()->photo ?? 'img/default-profile.jpg') }}" class="avatar avatar-xl photo">
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="btn" onclick="document.querySelector('.image').click()">
                                        Ganti Photo
                                    </a>
                                    <input hidden class="btn image" type="file" name="photo">
                                    <input type="hidden" name="old_photo" value="{{ auth()->user()->photo }}">
                                </div>
                            </div>
                            <h3 class="card-title mt-4">Profile</h3>
                            <div class="row g-3">
                                <div class="col-md">
                                    <div class="form-label">Nama</div>
                                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" name="name">
                                </div>
                            </div>
                            <h3 class="card-title mt-4">Email</h3>
                            <div>
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" class="form-control w-auto" value="{{ auth()->user()->email }}" name="email">
                                    </div>
                                    <div class="col-auto">
                                        <a href="#" class="btn">
                                            Change
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <h3 class="card-title mt-4">Password</h3>
                            <div>
                                <a href="{{ route('password.request') }}" class="btn">
                                    Ubah Password
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal modal-blur fade" id="modal-photo" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ganti Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3 align-items-end">
                        <div class="col-auto">
                            <img id="photo" src="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary sumbit-btn" id="save-photo">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var toastMixin = Swal.mixin({
            toast: true,
            icon: "success",
            title: "General Title",
            animation: false,
            position: "top-right",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });

        $(document).ready(function() {
            var $modal = $('#modal-photo');
            var photo = document.getElementById('photo');
            var cropper;

            $("body").on("change", ".image", function(e) {
                var files = e.target.files;
                var done = function(url) {
                    photo.src = url;
                    $modal.modal('show');
                };

                var reader;
                var file;
                var url;

                if (files && files.length > 0) {
                    file = files[0];

                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function(e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(photo, {
                    aspectRatio: 1,
                    viewMode: 3,
                    preview: '.preview'
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });

            $("#save-photo").click(function() {
                canvas = cropper.getCroppedCanvas({
                    width: 1000,
                    height: 1000,
                });

                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;

                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "{{ route('setting.change-photo') }}",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr("content"),
                                photo: base64data,
                                old_photo: $('input[name="old_photo"]').val()
                            },
                            success: function(data) {
                                $modal.modal('hide');

                                toastMixin.fire({
                                    icon: 'success',
                                    animation: true,
                                    title: data.message,
                                });

                                $('.photo').attr('src', data.photo);
                            }
                        });
                    }
                });
            })
        })
    </script>
@endsection
