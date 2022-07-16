@extends('kopi.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
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
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> No</th>
                                    <th> Product name</th>
                                    <th> Payment Date </th>
                                    <th> Quantity </th>
                                    <th> Grind Size </th>
                                    <th> Notes </th>
                                    <th> Status </th>
                                    <th> Price </th>
                                    <th> Total Price </th>
                                    <th> No.Resi </th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                ?>

                                @forelse ($order as $orders)
                                    <tr>
                                        <td>{{ $no++ }} </td>
                                        <td> {{ $orders->products->implode('nama', ',') }} </td>
                                        <td> {{ $orders->payment->created_at }}
                                        <td> {{ $orders->jumlah }} </td>
                                        <td> {{ $orders->giling }} </td>
                                        <td> {{ $orders->pesan }} </td>
                                        <td> {{ $orders->status }} </td>
                                        <td>
                                            Rp.
                                            {{ number_format($orders->products->implode('total', ',')) }}
                                        </td>
                                        </td>
                                        <td>
                                            RP. {{ number_format($orders->jumlah_harga) }} </td>
                                        <td> {{ $orders->resi }} </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="12" align="center">
                                            <h4>No Transaction History </h4>
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
