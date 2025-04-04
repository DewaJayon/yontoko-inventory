@extends('layouts.app')

@section('content')
    <x-alert />
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        POS
                    </h2>
                    <div class="text-secondary mt-1">{{ $products->firstItem() }}-{{ $products->lastItem() }} dari {{ $products->total() }} product</div>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <div class="me-3">
                            <div class="input-icon">
                                <input type="text" name="search" id="search" value="" class="form-control" placeholder="Search…" autocomplete="off">
                                <span class="input-icon-addon">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                        <path d="M21 21l-6 -6"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-8">
                    <div class="row" id="products">
                        @forelse ($products as $product)
                            <div class="col-sm-6 col-lg-3 mb-3" style="cursor: pointer" onclick="addToCart({{ $product->id }})">
                                <div class="card card-sm">
                                    <div class="d-block">
                                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top">
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div>{{ Str::limit($product->name, 10), '...' }}</div>
                                                <div class="text-secondary">{{ $product->category->name }}</div>
                                                <div class="text-secondary">Rp. {{ number_format($product->price) }}</div>
                                            </div>
                                            <div class="ms-auto">
                                                <span class="text-secondary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-packages">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                        <path d="M2 13.5v5.5l5 3" />
                                                        <path d="M7 16.545l5 -3.03" />
                                                        <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                        <path d="M12 19l5 3" />
                                                        <path d="M17 16.5l5 -3" />
                                                        <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" />
                                                        <path d="M7 5.03v5.455" />
                                                        <path d="M12 8l5 -3" />
                                                    </svg>
                                                    {{ $product->qty }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-center text-secondary">
                                    <h1 class="text-center">
                                        Product Tidak Ditemukan
                                    </h1>
                                </div>
                            </div>
                        @endforelse

                        {{ $products->links('Components.pagination') }}

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card cart">
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="checkout"></div>
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
            getCart();

            const search = $('#search');

            search.on('keyup', function() {
                $.ajax({
                    url: "{{ route('pos.search') }}",
                    method: "GET",
                    data: {
                        search: $(this).val()
                    },
                    success: function(data) {
                        $('#products').html(data);
                    }
                })
                if (search.val() == '' || search.val() == null) {
                    location.reload();
                }
            })


            $('.add-to-cart').on('click', function() {
                var productId = $(this).data('product-id');
                $.ajax({
                    url: "{{ route('cart.store') }}",
                    method: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        product_id: productId
                    },
                    success: function(data) {
                        getCart();
                        toastMixin.fire({
                            animation: true,
                            title: data.message,
                        });
                    },
                    error: function(data) {
                        toastMixin.fire({
                            icon: 'error',
                            animation: true,
                            title: data.responseJSON.message,
                        })
                    }
                })
            })

        });

        function getCart() {
            $.ajax({
                url: "{{ route('cart.index') }}",
                method: "GET",
                success: function(data) {
                    $('.cart').html(data);
                }
            })
        }

        function clearCart() {
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
                    $.ajax({
                        url: "{{ route('cart.clear') }}",
                        method: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function(data) {
                            getCart();
                        }
                    })
                }
            });
        }

        function plus(id) {
            $.ajax({
                url: "{{ route('cart.store-qty') }}",
                method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: id,
                    quantity: 1
                },
                success: function(data) {
                    getCart();
                }
            })
        }

        function minus(id) {
            $.ajax({
                url: "{{ route('cart.destroy-qty') }}",
                method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: id,
                    quantity: 1
                },
                success: function(data) {
                    getCart();
                }
            })
        }

        function storeInputQty(id) {
            var qty = $('#quantity').val();

            $.ajax({
                url: "{{ route('cart.store-qty') }}",
                method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: id,
                    quantity: qty
                },
                success: function(data) {
                    getCart();
                },
                error: function(data) {
                    Swal.fire({
                        icon: 'error',
                        animation: true,
                        title: data.responseJSON.message,
                    })

                    getCart();
                }
            })
        }

        function addToCart(id) {
            var productId = id;
            $.ajax({
                url: "{{ route('cart.store') }}",
                method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    product_id: productId
                },
                success: function(data) {
                    getCart();
                    toastMixin.fire({
                        animation: true,
                        title: data.message,
                    });
                },
                error: function(data) {
                    toastMixin.fire({
                        icon: 'error',
                        animation: true,
                        title: data.responseJSON.message,
                    })
                }
            })
        }

        function checkout() {
            $.ajax({
                url: "{{ route('pos.checkout') }}",
                method: "GET",
                success: function(data) {
                    $('.checkout').html(data);
                    $('#modal-checkout').modal('show');
                }
            })
        }
    </script>
@endsection
