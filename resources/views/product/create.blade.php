@extends('layouts.app')
@section('content')
    <x-page-header title="Tambah Product">
        <a href="{{ route('product.index') }}" class="btn btn-primary d-none d-sm-inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left-bar">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M21 12h-18" />
                <path d="M6 9l-3 3l3 3" />
                <path d="M21 9v6" />
            </svg>
            Kembali
        </a>
    </x-page-header>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <form action="{{ route('product.store') }}" method="post" class="card" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4 class="card-title">Tambah Product</h4>
                        </div>
                        <div class="card-body">

                            <div class="row mb-3 align-items-end">
                                <div class="col-4">
                                    <div class="avatar avatar-upload rounded " style="width: 100%; height: 100%;">
                                        <img class="img-fluid" id="img-preview">
                                    </div>
                                </div>

                                <div class="col-8">
                                    <label class="form-label required">Photo</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="photo" name="image" onchange="previewImage(event)">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6 col-lg-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label required">Nama Product</label>
                                        <div>
                                            <input value="{{ old('name') }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama Product"
                                                autocomplete="off">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label required">Code Product</label>
                                        <div>
                                            <input value="{{ old('code') }}" name="code" type="text" class="form-control @error('code') is-invalid @enderror" placeholder="Masukkan Code Product"
                                                autocomplete="off">
                                            @error('code')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label required">Harga Product</label>
                                        <div>
                                            <input value="{{ old('price') }}" name="price" type="number" class="form-control @error('price') is-invalid @enderror" placeholder="Masukkan Harga Product"
                                                autocomplete="off">
                                            @error('price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label required">Stock Product</label>
                                        <div>
                                            <input value="{{ old('qty') }}" name="qty" type="number" class="form-control @error('qty') is-invalid @enderror" placeholder="Masukkan Stock Product"
                                                autocomplete="off">
                                            @error('qty')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label required">Peringatan Stock Minimal</label>
                                        <div>
                                            <input value="{{ old('stock_alert') }}" name="stock_alert" type="number" class="form-control @error('stock_alert') is-invalid @enderror"
                                                placeholder="Masukkan Peringatan Stock Product" autocomplete="off">
                                            @error('stock_alert')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label required">Category</label>
                                        <div>
                                            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                                                <option hidden>Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-3 ">
                                <div class="col-12">
                                    <label for="deskripsi" class="form-label required">Deskripsi</label>
                                    <input id="deskripsi" type="hidden" name="description" value="{{ old('description') }}">
                                    <trix-editor input="deskripsi" value="Editor content goes here"></trix-editor>
                                    @error('description')
                                        <small class="text-danger"></small>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-label">Status</div>
                            <label class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked="" name="status">
                                <span class="form-check-label">Option 1</span>
                            </label>
                            <small class="form-text text-muted">Status product ready untuk dijual</small>
                        </div>

                </div>

                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Tambah Product</button>
                </div>

                </form>
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
    </script>
@endsection
