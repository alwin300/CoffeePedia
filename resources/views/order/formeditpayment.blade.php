@extends('kopi.master')
@section('content')
    <div class="container-fluid px-0">
        <div class="container">
            <div class="row>">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card p-3 border-white p-3 shadow mb-4" style="border-radius:10px">
                        <div class="card-body">

                            <form action="/updatepayment/{{ $payment->id }}" method="post" enctype="multipart/form-data"
                                class="mb-3">
                                @csrf
                                <h3> Form Edit Payment </h3>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label> Full Name </label>
                                                <input type="text" name="namalengkap" class="form-control m-2"
                                                    value="{{ old('namalengkap', $payment->namalengkap) }}"readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>No. Telephone</label>
                                                <input type="text" name="notelp" class="form-control m-2"
                                                    value="{{ old('notelp', $payment->notelp) }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label> Province </label>
                                                <input type="text" name="nama_provinsi" class="form-control m-2 "
                                                    value="{{ old('nama_provinsi', $payment->nama_provinsi) }}"readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" name="kota" class="form-control m-2"
                                                    value="{{ old('nama_kota', $payment->nama_kota) }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label> Courier </label>
                                                <input type="text" name="kurir" class="form-control m-2 "
                                                    value="{{ old('kurir', $payment->kurir) }}"readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Service</label>
                                                <input type="text" name="layanan" class="form-control m-2"
                                                    value="{{ old('layanan', $payment->layanan) }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label> Address </label>
                                                <input type="text" name="address" class="form-control m-2 "
                                                    value="{{ old('alamat', $payment->alamat) }}"readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Ward</label>
                                                <input type="text" name="kelurahan" class="form-control m-2"
                                                    value="{{ old('kelurahan', $payment->kelurahan) }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label> District </label>
                                                <input type="text" name="kecamatan" class="form-control m-2 "
                                                    value="{{ old('kecamatan', $payment->kecamatan) }}"readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Postal Code</label>
                                                <input type="text" name="kodepos" class="form-control m-2"
                                                    value="{{ old('kodepos', $payment->kodepos) }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label> Total Price </label>
                                                <input type="text" name="total" class="form-control m-2 "
                                                    value=" Rp {{ number_format(intval(old('total', $payment->total))) }}"readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Upload Image : </label>
                                    <p> <strong> Bank BCA : 12345678 <BR> A/N : Coffeepedia </strong> </p>
                                    <h6>
                                        <p style="color:red"> <strong>Please pay according to the total price
                                                above!!</strong> </p>
                                    </h6>
                                    <input type="hidden" name="oldImage" value="{{ $payment->image }}">
                                    @if ($payment->image)
                                        <img src="{{ asset('storage/' . $payment->image) }}"
                                            class="img-preview img-fluid mb-3 col-sm-2 d-block">
                                    @else
                                        <img class="img-preview img-fluid mb-3 col-sm-5">
                                    @endif
                                    <input class="form-control @error('image') is-invalid @enderror" type="file"
                                        id="image" name="image" value="{{ old('image', $payment->image) }}"
                                        onchange="previewImage(event)" multiple>
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <button class="btn btn-dark">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
