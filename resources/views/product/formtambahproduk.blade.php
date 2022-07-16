@extends('kopi.master')
@section('title', 'Form Tambah Data Kopi')
@section('content')
    <div class="card">
        <div class="row">
            <div class="col-lg-10">
                <!-- <form action="/insertproduk" method="post" enctype="multipart/form-data" class="mb-3"> -->
                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data" class="mb-3">
                    @csrf
                    <div class="form-group">
                        <label> Product Name : </label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Variant : </label>
                        <input type="text" name="jenis" class="form-control @error('jenis') is-invalid @enderror"
                            value="{{ old('jenis') }}">
                        @error('jenis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Origin : </label>
                        <input type="text" name="asal" class="form-control @error('asal') is-invalid @enderror"
                            value="{{ old('asal') }}">
                        @error('asal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Stock : </label>
                        <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                            value="{{ old('stok') }}" placeholder="Pcs ">
                        @error('stok')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Weight (gram) : </label>
                        <input type="number" name="berat" class="form-control @error('berat') is-invalid @enderror"
                            value="{{ old('berat') }}" placeholder="gram ">
                        @error('berat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Price : </label>
                        <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                            value="{{ old('harga') }}" placeholder="Rp. ">
                        @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Discount : </label>
                        <input type="number" name="diskon" class="form-control @error('diskon') is-invalid @enderror"
                            value="{{ old('diskon') }}" placeholder="Percent (%) ">
                        @error('diskon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Description : </label>
                        <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
                        <trix-editor input="deskripsi"></trix-editor>
                        @error('deskripsi')
                            <p class="text-danger"> {{ $message }} </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-label">Upload Image :</label>
                        <img class="img-preview img-fluid mb-3 col-sm-2 d-block">
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                            name="image" onchange="previewImage()">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-dark">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
