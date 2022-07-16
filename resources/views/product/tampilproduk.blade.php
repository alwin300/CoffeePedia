@extends('kopi.master')
@section('title', 'Kopi Bubuk')
@section('content')
    <div class="row row col-lg-12 mt-1">
        <h2 align="center"> List Product </h2>
    </div>
    <div class="row col-lg-2 mb-3 d-md-block">
        <br> <br>
        <!-- <a href="tambahdataproduk" class = "btn btn-outline-secondary"> <span data-feather="plus-square"></span> Add Product</a> -->
        <a href="{{ route('product.create') }}" class="btn btn-secondary"> <span data-feather="plus-square"></span>
            Add Product</a>
    </div>
    <div class="col-lg-6" role="alert">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <div class="row col-lg-9">
        <table class="table table-light shadow">
            <tr>
                <th align="center">Product Name</th>
                <th align="center">Variant</th>
                <th align="center"> Origin</th>
                <th align="center">Price</th>
                <th align="center"> Discount (%)</th>
                <th align="center"> Discounted Price</th>
                <th align="center"> Stock </th>
                <th colspan="3"></th>

            </tr>
            @if ($produk->count())
                @foreach ($produk as $rowproduk)
                    <tr>
                        <td>{{ $rowproduk->nama }}</td>
                        <td>{{ $rowproduk->jenis }}</td>
                        <td>{{ $rowproduk->asal }} </td>
                        <td>Rp. {{ number_format($rowproduk->harga, 0, ',', '.') }}</td>
                        <td>{{ $rowproduk->diskon }}</td>
                        <td>Rp. {{ number_format($rowproduk->total, 0, ',', '.') }}</td>
                        <td>{{ $rowproduk->stok }}</td>
                        <!-- <td><a button type = "button" class = "btn btn-dark" href="viewproduk/{{ $rowproduk->id }}"><span data-feather="eye"></span> </a></td> -->
                        <td><a button type="button" class="btn btn-dark"
                                href="{{ route('product.show', $rowproduk->id) }}"><span data-feather="eye"></span> </a>
                        </td>
                        <td><a button type="button" class="btn btn-dark"
                                href="{{ route('product.edit', $rowproduk->id) }}"><span data-feather="edit"></a></td>
                        <td><a button type="button" class="btn btn-dark"
                                onclick="return confirm('Yakin ingin menghapus data?')"
                                href="product/{{ $rowproduk->id }}/delete"><span data-feather="trash"> </span></a></td>

                    </tr>
                @endforeach
            @endif
        </table>
        <div mt-5>
            {{ $produk->links() }}
        </div>
    </div>
@endsection
