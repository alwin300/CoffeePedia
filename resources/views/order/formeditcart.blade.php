@extends('kopi.master')
@section('content')
    <div class="container-fluid px-0">
        <div class="container">
            <div class="row>">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card p-3 border-white p-3 shadow mb-4" style="border-radius:10px">
                        <div class="card-body">
                            @foreach ($order->products as $product)
                                <form action="/cart/update/{{ $order->id }}/{{ $product->id }}" method="post"
                                    class="mb-3">
                                    @csrf
                                    <h3> Checkout </h3>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="m-2"> Product Name </label>
                                                    <input type="text" name="nama" class="form-control m-2"
                                                        value="{{ $product->nama }}"readonly>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="m-2">Price</label>
                                                    <input type="text" name="harga" class="form-control m-2"
                                                        value="{{ $product->harga }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="m-2"> Stock </label>
                                                    <input type="text" name="stok" class="form-control m-2"
                                                        value="{{ $product->stok }}"readonly>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="m-2">Quantity</label>
                                                    <input type="text" name="jumlah" class="form-control m-2"
                                                        value="{{ $order->jumlah }}">
                                                    <div role="alert">
                                                        @if (session()->has('error'))
                                                            <div class="alert alert-danger alert-dismissible fade show"
                                                                role="alert">
                                                                {{ session('error') }}
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="alert" aria-label="Close"></button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="m-2">Notes</label>
                                                        <input type="text" name="pesan" class="form-control m-2"
                                                            value="{{ $order->pesan }}">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="m-2">Grind Size</label>
                                                        <select class="form-select m-2" name="giling" id="giling">
                                                            <option
                                                                value="Kasar"{{ old('giling', $order->giling) == 'Kasar' ? 'selected' : '' }}>
                                                                Kasar (Coarse)</option>
                                                            <option value="Sedang"
                                                                {{ old('giling', $order->giling) == 'Sedang' ? 'selected' : '' }}>
                                                                Sedang (Medium)</option>
                                                            <option value="Halus"
                                                                {{ old('giling', $order->giling) == 'Halus' ? 'selected' : '' }}>
                                                                Halus (Fine)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="oldJumlah" value="{{ $order->jumlah }}">
                            @endforeach <br>
                            <button class="btn btn-dark">Submit</button>
                        </div>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>
@endsection
