@extends('kopi.master')
@section('title', 'Kopi Bubuk')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h2 align="center"> Verification Order </h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th align="center">ID Order</th>
                                    <th align="center">Username Buyer</th>
                                    <th align="center">Order Date</th>
                                    <th align="center">Status</th>
                                    <th align="center">Quantity</th>
                                    <th align="center">Total Price</th>
                                    <th align="center">Grind Size</th>
                                    <th align="center">Payment Proof</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->order->id }}</td>
                                        <td>{{ $payment->namalengkap }}</td>
                                        <td>{{ $payment->created_at->format('d F y') }}</td>
                                        <td>{{ $payment->order->status }}</td>
                                        <td>{{ $payment->order->jumlah }}</td>
                                        <td>Rp. {{ number_format($payment->total) }}</td>
                                        <td>{{ $payment->order->giling }}</td>
                                        <td> <img src="{{ asset('storage/' . $payment->image) }}" width="150"
                                                height="200"></td>
                                        <form action="/verifikasiorder/{{ $payment->id }}" method="post">
                                            @csrf
                                            @if ($payment->order->status == 'Verification Process')
                                                <td><a href="/verifikasiorder/{{ $payment->order->id }}?status=Verified"
                                                        class="btn btn-dark"
                                                        onclick="return confirm('Are you sure this order will be verified?')"><span
                                                            data-feather="check"></span></a> </td>
                                                <td><a href="/verifikasiorder/{{ $payment->order->id }}?status=Verification failed"
                                                        class="btn btn-dark"
                                                        onclick="return confirm('Are you sure this order will be failed the verification?')"><span
                                                            data-feather="x"></span></a> </td>
                                            @endif
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
