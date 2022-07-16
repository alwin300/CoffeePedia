@extends('kopi.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h3> Transaction History </h3>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4 mt-2">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> No</th>
                                    <th> Product Image </th>
                                    <th> Product Name</th>
                                    <th> Order Date </td>
                                    <th> Quantity </th>
                                    <th> Grind Size </th>
                                    <th> Notes </th>
                                    <th> Status </th>
                                    <th> Payment Proof</th>
                                    <th> No. Resi </th>
                                    <th> Price </th>
                                    <th> Total Price </th>
                                    <th colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                ?>

                                @forelse ($order as $orders)
                                    <tr>
                                        <td>{{ $no++ }} </td>
                                        <td><img src="{{ asset('/storage/' . $orders->products->implode('image', ',')) }}"
                                                width="150" /> </td>
                                        <td> {{ $orders->products->implode('nama', ',') }} </td>
                                        <td> {{ $orders->payment->created_at->format('d F y') }} </td>
                                        <td> {{ $orders->jumlah }} </td>
                                        <td> {{ $orders->giling }} </td>
                                        <td> {{ $orders->pesan }} </td>
                                        <td> {{ $orders->status }} </td>
                                        <td><img src="{{ asset('/storage/' . $orders->payment->image) }}"
                                                width="150" /> </td>
                                        <td> {{ $orders->resi }} </td>
                                        <td>
                                            Rp. {{ number_format(intval($orders->products->implode('total', ','))) }}
                                        </td>
                                        <td>Rp. {{ number_format($orders->jumlah_harga) }}</td>
                                        @if ($orders->status == 'Order Completed')
                                            <td><a button type="button" class="btn btn-dark"
                                                    href="etalase/{{ $orders->products->implode('id', ',') }}"><span
                                                        data-feather="shopping-bag"></span> Buy again</a> </td>
                                        @endif
                                        <form action="/history/{{ $orders->id }}" method="post">
                                            @if ($orders->status == 'Order is Being Delivered')
                                                <td><a href="/history/{{ $orders->id }} ?status=Order Delivered"
                                                        class="btn btn-dark"
                                                        onclick="return confirm('Are you sure this order is arrived?')"><span
                                                            data-feather="check"></span></a> </td>
                                            @endif
                                        </form>
                                        @if ($orders->status == 'Verification failed')
                                            <td><a button type="button" class="btn btn-dark"
                                                    href="{{ route('edit.payment', $orders->id) }}"><span
                                                        data-feather="upload"></span> Upload payment photo</a>
                                            </td>
                                        @endif

                                        @if ($orders->status == 'Order Delivered')
                                            <td><a button type="button" class="btn btn-dark"
                                                    href="review/{{ $orders->payment->id }}/{{ $orders->products->implode('id', ',') }}"><span
                                                        data-feather="star"></span> Review</a> </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" align="center">
                                            <h4>Transaction History Still Empty </h4>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
