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
                                    <img src="{{ asset('storage/' . auth()->user()->photo ?? 'img/default-profile.jpg') }}" class="avatar avatar-xl">
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-photo">
                                        Ganti Photo
                                    </a>
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


    <div class="modal modal-blur fade " id="modal-photo" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ganti Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3 align-items-end">
                        <div class="col-auto">
                            <div class="avatar avatar-upload rounded">
                                <img src="{{ asset('storage/' . auth()->user()->photo ?? 'img/default-profile.jpg') }}" alt="{{ auth()->user()->name }}" class="avatar-img rounded" id="img-preview">
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Photo</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" onchange="previewImage(event)">
                            <input type="hidden" name="old_photo" value="{{ auth()->user()->photo }}">
                            @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary sumbit-btn" data-bs-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var previewImage = function(event) {
            var output = document.getElementById('img-preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };

        $(document).ready(function() {
            $('.sumbit-btn').click(function() {
                $.ajax({
                    url: "{{ route('setting.change-photo') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        // photo: $('#photo').prop('files')[0],
                        // photo: $('input[name=photo]').prop('files')[0],
                        photo: $('input[name=photo]').val(),
                        old_photo: $('input[name=old_photo]').val()
                    },
                    success: function(response) {
                        if (response.status == 'success') {

                        }
                    }
                })
            });
        });
    </script>
@endsection
