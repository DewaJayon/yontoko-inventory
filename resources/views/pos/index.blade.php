@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        POS
                    </h2>
                    <div class="text-secondary mt-1">1-12 of 241 photos</div>
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
                            <div class="col-sm-6 col-lg-3 mb-3">
                                <div class="card card-sm">
                                    <a href="#" class="d-block"><img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"></a>
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
                            <div class="col-12">Belum ada produk</div>
                        @endforelse

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">Cart</h3>
                            <div class="card-actions"></div>
                            <a href="#" class="card-action">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-trash">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <line x1="4" y1="7" x2="20" y2="7" />
                                    <line x1="10" y1="11" x2="10" y2="17" />
                                    <line x1="14" y1="11" x2="14" y2="17" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                            </a>
                        </div>
                        <div class="row row-cards p-3">
                            <div class="col-md-6 col-lg-12">
                                <div class="card">
                                    <div class="row row-0">
                                        <div class="col-auto">
                                            <img src="./static/tracks/c976bfc96d5e44820e553a16a6097cd02a61fd2f.jpg" class="rounded-start" alt="Shape of You" width="80" height="80">
                                        </div>
                                        <div class="col">
                                            <div class="card-body">
                                                Shape of You
                                                <div class="text-secondary">
                                                    Ed Sheeran
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-12">
                                <div class="card">
                                    <div class="row row-0">
                                        <div class="col-auto">
                                            <img src="./static/tracks/c9a8350feee77e9345eec4155cddc96694803d1a.jpg" class="rounded-start" alt="Alone" width="80" height="80">
                                        </div>
                                        <div class="col">
                                            <div class="card-body">
                                                Alone
                                                <div class="text-secondary">
                                                    Alan Walker
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-12">
                                <div class="card">
                                    <div class="row row-0">
                                        <div class="col-auto">
                                            <img src="./static/tracks/fe4ee21d30450829e5b172e806b3c1e14ca1e5f3.jpg" class="rounded-start" alt="Langrennsfar" width="80" height="80">
                                        </div>
                                        <div class="col">
                                            <div class="card-body">
                                                Langrennsfar
                                                <div class="text-secondary">
                                                    Ylvis
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-12">
                                <div class="card">
                                    <div class="row row-0">
                                        <div class="col-auto">
                                            <img src="./static/tracks/f4e96086f44c4dff1758b1fc1338cd88c1b5ce9c.jpg" class="rounded-start" alt="Skibidi - Romantic Edition" width="80"
                                                height="80">
                                        </div>
                                        <div class="col">
                                            <div class="card-body">
                                                Skibidi - Romantic Edition
                                                <div class="text-secondary">
                                                    Little Big
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-12">
                                <div class="card">
                                    <div class="row row-0">
                                        <div class="col-auto">
                                            <img src="./static/tracks/73f4938130140174efb1cc0a82ececb277e40932.jpg" class="rounded-start" alt="Miracle" width="80" height="80">
                                        </div>
                                        <div class="col">
                                            <div class="card-body">
                                                Miracle
                                                <div class="text-secondary">
                                                    Caravan Palace
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-12">
                                <div class="card">
                                    <div class="row row-0">
                                        <div class="col-auto">
                                            <img src="./static/tracks/cfb2a532996512eff95c4b0d566d067384aaa441.jpg" class="rounded-start" alt="Different World (feat. CORSAK)" width="80"
                                                height="80">
                                        </div>
                                        <div class="col">
                                            <div class="card-body">
                                                Different World (feat. CORSAK)
                                                <div class="text-secondary">
                                                    Alan Walker,
                                                    K-391,
                                                    Sofia Carson,
                                                    CORSAK
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary">
                                    Checkout
                                </button>
                                <nav>
                                    <ul class="pagination">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M15 6l-6 6l6 6"></path>
                                                </svg>
                                                prev
                                            </a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item"></li>
                                        <a class="page-link" href="#">
                                            next
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M9 6l6 6l-6 6"></path>
                                            </svg>
                                        </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="d-flex">
                <ul class="pagination ms-auto">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M15 6l-6 6l6 6"></path>
                            </svg>
                            prev
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 6l6 6l-6 6"></path>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div> --}}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
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
            })

        });
    </script>
@endsection
