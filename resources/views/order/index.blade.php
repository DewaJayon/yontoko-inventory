@extends('layouts.app')
@section('content')
    <!-- Page body -->
    <x-alert />
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Order</h3>
                        </div>
                        <div class="table-responsive p-3">
                            <table id="dataTable" class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>Nama Pembeli</th>
                                        <th>Pembayaran</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Pajak Total (11%)</th>
                                        <th>Grand Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->customer_name == null ? '------' : $order->customer_name }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td>{{ $order->payment_status }}</td>
                                            <td>{{ number_format($order->base_total) }}</td>
                                            <td>{{ number_format($order->tax_total) }}</td>
                                            <td>{{ number_format($order->total) }}</td>
                                            <td>
                                                <div class="row g-2 align-items-start justify-content-start d-flex">

                                                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto">
                                                        <a href="{{ route('order.show', $order->code) }}" class="btn btn-twitter w-100 btn-icon show-button">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                            </svg>
                                                        </a>
                                                    </div>

                                                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto">
                                                        <form action="{{ route('order.destroy', $order->code) }}" method="POST">
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
@endsection
