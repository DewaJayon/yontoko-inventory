@extends('layouts.app')
@section('content')
    <x-page-header title="Invoice">
        <button type="button" class="btn btn-primary" onclick="printInvoice()">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
            </svg>
            Print Invoice
        </button>
        <a href="{{ route('order.index') }}" type="button" class="btn btn-success">
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
            <div class="card card-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p class="h3">Yontoko</p>
                            <address>
                                Jalan Raya Tusan<br>
                                Banjarangkan, Klungkung<br>
                                Bali, 8888<br>
                                dewajayon3@gmail.com
                            </address>
                        </div>
                        <div class="col-6 text-end">
                            <p class="h3">Client</p>
                            <address>
                                Street Address<br>
                                State, City<br>
                                Region, Postal Code<br>
                                ctr@example.com
                            </address>
                        </div>
                        <div class="col-12 my-5">
                            <h1>Invoice #{{ $order->code }}</h1>
                        </div>
                    </div>
                    <table class="table table-transparent table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 1%"></th>
                                <th>Product</th>
                                <th class="text-center" style="width: 1%">QTY</th>
                                <th class="text-end" style="width: 10%">Harga</th>
                                <th class="text-end" style="width: 10%">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems->orderItem as $orderItem)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <p class="strong mb-1">{{ $orderItem->product->name }}</p>
                                        <div class="text-secondary">{{ $orderItem->product->category->name }}</div>
                                    </td>
                                    <td class="text-center">
                                        {{ $orderItem->quantity }}
                                    </td>
                                    <td class="text-end">Rp. {{ number_format($orderItem->product->price) }}</td>
                                    <td class="text-end">Rp. {{ number_format($orderItem->total) }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="4" class="strong text-end">Subtotal</td>
                                <td class="text-end">Rp. {{ number_format($order->base_total) }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="strong text-end">Pajak</td>
                                <td class="text-end">11%</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="strong text-end">Pajak Total</td>
                                <td class="text-end">Rp. {{ number_format($order->tax_total) }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-weight-bold text-uppercase text-end">Total</td>
                                <td class="font-weight-bold text-end">Rp. {{ number_format($order->total) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="text-secondary text-center mt-5">Terima Kasih Telah Membeli di Yontoko</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function printInvoice() {
            window.print();
        }
    </script>
@endsection
