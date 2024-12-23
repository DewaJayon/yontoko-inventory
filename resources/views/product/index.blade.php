@extends('layouts.app')
@section('content')
    <x-page-header title="Product">
        <a href="{{ route('product.create') }}" class="btn btn-primary d-none d-sm-inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
            </svg>
            Tambah Product
        </a>
    </x-page-header>

    <!-- Page body -->
    <x-alert />
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Product</h3>
                        </div>
                        <div class="table-responsive p-3">
                            <table id="dataTable" class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Category</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Code</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->qty }}</td>
                                            <td>{{ $product->code }}</td>
                                            <td>
                                                <div class="row g-2 align-items-start justify-content-start d-flex">

                                                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto">
                                                        <a href="{{ route('product.edit', $product->slug) }}" class="btn btn-facebook w-100 btn-icon edit-button" aria-label="Edit"">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                                <path d="M16 5l3 3" />
                                                            </svg>
                                                        </a>
                                                    </div>

                                                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto">
                                                        <button class="btn btn-twitter w-100 btn-icon show-button" aria-label="Show" data-slug="{{ $product->slug }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                            </svg>
                                                            </a>
                                                    </div>

                                                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto">
                                                        <form action="{{ route('product.destroy', $product->slug) }}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-google w-100 btn-icon delete-button show-confirm" aria-label="Delete">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                    <path d="M4 7l16 0" />
                                                                    <path d="M10 11l0 6" />
                                                                    <path d="M14 11l0 6" />
                                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="showModal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <div class="row">
                        <span class="badge text-white mb-2 stock rounded-pill"></span>
                        <span class="badge text-white status"></span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-12 ">
                            <span class="">
                                <img class="product-image">
                            </span>
                        </div>

                        <div class="col-12 mt-3">
                            <input type="text" class="form-control product-code" readonly>
                            <small class="form-text text-muted">Code Product</small>
                        </div>

                        <div class="col-12 mt-3">
                            <input type="text" class="form-control product-price" readonly>
                            <small class="form-text text-muted">Harga Product</small>
                        </div>

                        <div class="col-12 mt-3">
                            <textarea rows="5" class="form-control product-description" readonly></textarea>
                            <small class="form-text text-muted">Deskripsi Product</small>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.show-button').click(function() {

                var url = "{{ route('product.show', ':slug') }}";
                url = url.replace(':slug', $(this).data('slug'));

                $.ajax({
                    url: url,
                    method: "GET",
                    data: {
                        slug: $(this).data('slug')
                    },
                    success: function(response) {
                        $('#showModal').modal('show');
                        $('.modal-title').text(response.product.name);
                        $('.stock').text('Stock : ' + response.product.qty);
                        $('.status').text('Status :' + (response.product.status == 1 ? ' Ready' : ' Not Ready'));
                        $('.product-code').val(response.product.code);
                        $('.product-price').val(response.product.price);
                        $('.product-description').val(jQuery(response.product.description).text());
                        $('.product-image').attr('src', 'storage/' + response.product.image);
                    },
                })
            });
        });
    </script>
@endsection
