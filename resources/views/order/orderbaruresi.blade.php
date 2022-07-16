@extends('kopi.master')
@section('title', 'Form Tambah Data Kopi')
@section('content')
    <div class="container-fluid px-0">
        <div class="container">
            <div class="row>">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card p-3 border-white p-3 shadow mb-4" style="border-radius:10px">
                        <div class="card-body">
                            @foreach ($order as $orders)
                                <form action="/updateresi/{{ $orders->id }}" method="post">
                                    @csrf
                                    <h3> Order Details </h3>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label> Product Name </label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $orders->products->implode('nama', ',') }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label> Quantity </label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $orders->jumlah }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label> Grind Size </label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $orders->giling }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label> Notes </label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $orders->pesan }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label> Price </label>
                                                    <input type="text" name="harga" class="form-control"
                                                        value="Rp.{{ number_format($orders->products->implode('total', ',')) }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label> Total Price </label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="Rp.{{ number_format($orders->payment->total) }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h3> Shipment Details </h3>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label> Receiver Name </label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $orders->payment->namalengkap }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label> No.Telephone Receiver </label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $orders->payment->notelp }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label> Province </label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $orders->payment->nama_provinsi }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label> City </label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $orders->payment->nama_kota }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label> Address </label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $orders->payment->alamat }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label> Ward </label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $orders->payment->kelurahan }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label> Disctrict </label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $orders->payment->kecamatan }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label> Postal Code </label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $orders->payment->kodepos }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label> Courier </label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $orders->payment->kurir }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label> Service </label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $orders->payment->layanan }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label> No. Resi </label>
                                                    <input type="text" name="resi" class="form-control"
                                                        id="resi" value="{{ $orders->resi }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        <button class=" btn btn-lg btn-dark" type="submit">Submit</button>
                        <input class="form-control" type="hidden" id="status" name="status"
                            value="Order is Being Delivered">
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
