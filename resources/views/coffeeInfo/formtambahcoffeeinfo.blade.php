@extends('kopi.master')
@section('title', 'Form Tambah Data Apartemen')
@section('content')
    <div class="card">
        <div class="row">
            <div class="col-lg-10">
                <form action="/insertcoffeeinfo" method="post" enctype="multipart/form-data" class="mb-3">
                    @csrf
                    <div class="form-group">
                        <label> Tittle : </label>
                        <input type="text" name="judul" class="form-control m-2 @error('judul') is-invalid @enderror"
                            value="{{ old('judul') }}">
                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="m-2"> Description : </label>
                        <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
                        <trix-editor input="deskripsi"></trix-editor>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="image" class="form-label">Upload Image :</label>
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                        <input class="form-control @error('image') is-invalid @enderror" type="file"multiple
                            id="image" name="image" onchange="previewImage()" multiple>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-dark">Submit</button>
                    </div>
            </div>
        </div>
    @endsection
