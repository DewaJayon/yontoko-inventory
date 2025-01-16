<div class="modal modal-blur fade" id="modal-checkout" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <form action="{{ route('pos.order') }}" class="modal-content" method="POST">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Checkout</h5>
                    <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="row row-cards">
                                @foreach ($carts->cartItem as $item)
                                    <div class="col-md-6 col-lg-12">
                                        <div class="card">
                                            <div class="row row-0">
                                                <div class="col-auto">
                                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="rounded-start" alt="{{ $item->product->name }}" width="80" height="80">
                                                </div>
                                                <div class="col">
                                                    <div class="card-body">
                                                        {{ $item->product->name }}
                                                        <div class="text-secondary">
                                                            Rp.{{ number_format($item->product->price) }} x {{ $item->quantity }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Rincian</h3>
                                    </div>
                                    <div class="card-body">

                                        <div class="mb-3">
                                            Pajak : <span class="fw-bold">11%</span>
                                        </div>
                                        <div class="mb-3">
                                            Total Harga : <span class="fw-bold">Rp.{{ number_format($carts->total + $carts->calculateTax($carts->total)) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 fixed">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Pembeli</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label ">Nama</label>
                                        <div>
                                            <input type="text" class="form-control" name="customer_name" placeholder="Nama...">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label ">Email</label>
                                        <div>
                                            <input type="email" class="form-control" name="customer_email" placeholder="Email...">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label ">Handphone</label>
                                        <div>
                                            <input type="number" class="form-control" name="customer_phone" placeholder="Nomor Handphone...">
                                            <small class="form-hint">
                                                Semua yang diatas tidak wajib
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto close" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Checkout</button>
                </div>
            </div>
        </form>
    </div>
</div>
