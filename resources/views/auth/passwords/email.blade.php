@extends('layouts.auth')
@section('content')
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark">
                <img src="" width="110" height="32" alt="Yontoko Inventory" class="navbar-brand-image">
            </a>
        </div>
        <form class="card card-md" method="POST" action="{{ route('password.email') }}" autocomplete="off" novalidate="">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <h2 class="card-title text-center mb-4">Reset Password</h2>
                <p class="text-secondary mb-4">Silahkan Masukkan Email Untuk Melakukan Reset Password</p>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Masukkan email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
                            <path d="M3 7l9 6l9 -6"></path>
                        </svg>
                        Reset Password
                    </button>
                </div>
            </div>
        </form>
        <div class="text-center text-secondary mt-3">
            <a href="{{ route('setting.index') }}">Kembali ke setting</a>
        </div>
    </div>
@endsection
