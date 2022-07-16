@extends('kopi.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h3> Shopping List </h3>
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
                            @if (session()->has('danger'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('danger') }}
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
                                    <th> Product Name</th>
                                    <th> Quantity </th>
                                    <th> Grind Size </th>
                                    <th> Notes </th>
                                    <th> Status </th>
                                    <th> Weight (g) </th>
                                    <th> Price </th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                ?>

                                @forelse ($pesanan_details as $pesanan_detail)
                                    <tr>
                                        <td>{{ $no++ }} </td>
                                        <td> {{ $pesanan_detail->products->implode('nama', ',') }} </td>
                                        <td> {{ $pesanan_detail->jumlah }} </td>
                                        <td> {{ $pesanan_detail->giling }} </td>
                                        <td> {{ $pesanan_detail->pesan }} </td>
                                        <td> {{ $pesanan_detail->status }} </td>
                                        <td> {{ $pesanan_detail->berat }} </td>
                                        @if (empty($pesanan_detail->products->implode('diskon', ',')))
                                            <td>
                                                Rp.
                                                {{ number_format(intval($pesanan_detail->products->implode('harga', ','))) }}
                                            </td>
                                        @else
                                            <td>
                                                Rp. {{ number_format($pesanan_detail->products->implode('total', ',')) }}
                                            </td>
                                        @endif
                                        <td class="d-flex">
                                            <a button type="button" class="btn btn-dark"
                                                href="/cart/edit/{{ $pesanan_detail->id }}"><span
                                                    data-feather="edit"></a>
                                            &emsp;
                                            <form action="/cart/ {{ $pesanan_detail->id }}" method="post">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-dark"
                                                    onclick="return confirm('Yakin ingin menghapus pesanan?')"><span
                                                        data-feather="trash"></span> </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" align="right"> <strong>Total Price </strong></td>
                                        <td> <strong>Rp. {{ number_format($pesanan_detail->jumlah_harga) }} </strong>
                                        </td>
                                        <td>
                                            <a button type="button" class="btn btn-dark"
                                                href="/checkout/{{ $pesanan_detail->id }} "><span
                                                    data-feather="upload"></span> Upload payment photo</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" align="center">
                                            <h4>Shopping List is still empty!! </h4>
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
