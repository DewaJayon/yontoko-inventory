<div class="card-header">
    <h3 class="card-title">Cart</h3>
    <div class="card-actions">
        @if ($carts->cartItem->count() > 0)
            <button class="btn card-action p-0 m-0 border-0 show-confirm" onclick="clearCart()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-trash">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="4" y1="7" x2="20" y2="7" />
                    <line x1="10" y1="11" x2="10" y2="17" />
                    <line x1="14" y1="11" x2="14" y2="17" />
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                </svg>
            </button>
        @endif
    </div>
</div>

<div class="row row-cards p-3">

    @forelse ($carts->cartItem as $cart)
        <div class="col-md-6 col-lg-12">
            <div class="card">
                <div class="row row-0">
                    <div class="col-auto">
                        <img src="{{ asset('storage/' . $cart->product->image) }}" class="rounded-start" alt="{{ $cart->product->name }}" width="80" height="80">
                    </div>
                    <div class="col">
                        <div class="card-body">
                            {{ $cart->product->name }}
                            <div class="row">
                                <div class="col-6">

                                    <div class="text-secondary">
                                        {{ number_format($cart->product->price) }}

                                    </div>
                                </div>
                                <div class="col-6">

                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle border plus-button" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-square-rounded-plus">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                                                    <path d="M15 12h-6" />
                                                    <path d="M12 9v6" />
                                                </svg>
                                            </button>
                                        </div>
                                        <input type="number" class="form-control form-control-sm text-center rounded-pill" value="{{ $cart->quantity }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle border" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-square-rounded-plus">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                                                    <path d="M15 12h-6" />
                                                    <path d="M12 9v6" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-center text-secondary">
                <h1 class="text-center">
                    Keranjang Kosong
                </h1>
            </div>
        </div>
    @endforelse

    @if ($carts->cartItem->count() > 0)
        <div>
            Total Rp. {{ number_format($carts->total) }}
        </div>
    @endif

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
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M15 6l-6 6l6 6"></path>
                        </svg>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item"></li>
                <a class="page-link" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9 6l6 6l-6 6"></path>
                    </svg>
                </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
