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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-packages">
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
