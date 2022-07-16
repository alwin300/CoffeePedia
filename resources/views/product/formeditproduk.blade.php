@extends('kopi.master')
@section('title', 'Form Tambah Data Kopi')
@section('content')
    <div class="card">
        <div class="row">
            <div class="col-lg-10">
                <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data"
                    class="mb-3">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label> Product Name : </label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama', $product->nama) }}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Variant </label>
                        <input type="text" name="jenis" class="form-control @error('jenis') is-invalid @enderror"
                            value="{{ old('jenis', $product->jenis) }}">
                        @error('jenis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Origin </label>
                        <input type="text" name="asal" class="form-control @error('asal') is-invalid @enderror"
                            value="{{ old('asal', $product->asal) }}">
                        @error('asal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Stock : </label>
                        <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                            value="{{ old('stok', $product->stok) }}">
                        @error('stok')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Weight (gram) : </label>
                        <input type="number" name="berat" class="form-control @error('berat') is-invalid @enderror"
                            value="{{ old('berat', $product->berat) }}">
                        @error('berat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Price : </label>
                        <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                            value="{{ old('harga', $product->harga) }}">
                        @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Discount : </label>
                        <input type="number" name="diskon" class="form-control @error('diskon') is-invalid @enderror"
                            value="{{ old('diskon', $product->diskon) }}">
                        @error('diskon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Description : </label>
                        <input id="deskripsi" type="hidden" name="deskripsi"
                            value="{{ old('deskripsi', $product->deskripsi) }}">
                        <trix-editor input="deskripsi"></trix-editor>
                        @error('deskripsi')
                            <p class="text-danger"> {{ $message }} </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-label">Upload Image : </label>
                        <input type="hidden" name="image">
                        @if ($product->image)
                            <img src="{{ asset('/storage/' . $product->image) }}"
                                class="img-preview img-fluid mb-3 col-sm-2 d-block">
                        @else
                            <img class="img-preview img-fluid mb-3 col-sm-5">
                        @endif
                        <!-- <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" value="{{ old('image', $product->image) }}" onchange="previewImage(event)" > -->
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                            name="image" value="{{ old('image', $product->image) }}" onchange="previewImage(event)">
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
    </div>
@endsection
