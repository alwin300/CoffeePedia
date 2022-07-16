@extends('kopi.master')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{ asset('storage/' . $dataproduk->image) }}" class="rounded mx-auto d-block"
                                    height="550px" width="100%" alt="">
                            </div>
                            <div class="col-md-6">
                                <h3> {{ $dataproduk->nama }} </h3>
                                <div class="row justify-content-center">
                                    <div class="col-md-6 mt-2">
                                        @if (session()->has('error'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session('error') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if (session()->has('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-review">
                                    <a href="/etalase/review/{{ $dataproduk->id }}"class="button-review">
                                        @php
                                        $star_number = number_format($star_value); @endphp
                                        <div class="star">
                                            @for ($i = 1; $i <= $star_number; $i++)
                                                <i class="fa fa-star checked"></i>
                                            @endfor
                                            @for ($j = $star_number + 1; $j <= 5; $j++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                            <span> {{ $star->count() }} Rating </span>
                                        </div>
                                    </a>
                                </div>
                                <form method="post" action="/order/{{ $dataproduk->id }}">
                                    @csrf
                                    <table class="table mt-2">
                                        <tbody>
                                            <tr>
                                                <td>Variant</td>
                                                <td>:</td>
                                                <td>{{ $dataproduk->jenis }}</td>
                                            </tr>
                                            <tr>
                                                <td>Origin</td>
                                                <td>:</td>
                                                <td>{{ $dataproduk->asal }}</td>
                                            </tr>
                                            <tr>
                                                <td>Description</td>
                                                <td>:</td>
                                                <td>{!! $dataproduk->deskripsi !!}</td>
                                            </tr>
                                            @if (empty($dataproduk->diskon))
                                                <tr>
                                                    <td>Price</td>
                                                    <td>:</td>
                                                    <td>Rp. {{ number_format($dataproduk->harga) }}</td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td>Price</td>
                                                    <td>:</td>
                                                    <td><s>Rp. {{ number_format($dataproduk->harga) }}</s> Rp.
                                                        {{ number_format($dataproduk->total) }}</td>
                                            @endif
                                            </tr>
                                            <tr>
                                                <td>Stock</td>
                                                <td>:</td>
                                                <td> {{ $dataproduk->stok }} </td>
                                            </tr>
                                            <tr>
                                                <td>Weight (g)</td>
                                                <td>:</td>
                                                <td> {{ $dataproduk->berat }} </td>
                                            </tr>
                                            <tr>
                                                <td>Grind Size</td>
                                                <td>:</td>
                                                <td>
                                                    <select class="form-select" name="giling" id="giling">
                                                        <option value="Kasar">Coarse (Kasar)</option>
                                                        <option value="Sedang">Medium (Sedang)</option>
                                                        <option value="Halus">Fine (Halus)</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Notes</td>
                                                <td>:</td>
                                                <td>

                                                    <input type="text" name="notes"
                                                        class="form-control @error('notes') is-invalid @enderror"value="{{ old('notes', $dataproduk->pesan) }}">
                                                    @error('notes')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Quantity</td>
                                                <td>:</td>
                                                <td>
                                                    <input type="number" name="quantity"
                                                        class="form-control
                                                        @error('quantity') is-invalid @enderror">
                                                    @error('quantity')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    <button type="submit" class="btn btn-dark mt-3"> <span
                                                            data-feather="shopping-cart"> </span> Add to Cart
                                                    </button>
                                </form>
                                <a button type="button" href="/wishlist/{{ $dataproduk->id }}"class="btn btn-dark mt-3">
                                    <span data-feather="heart"> </span>
                                    Add
                                    to Wishlist
                                </a>
                                </td>
                                </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
