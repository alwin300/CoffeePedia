@extends('kopi.master')
@section('title', 'Form Tambah Data Apartemen')
@section('content')

    <div class="row">
        <div class="col-lg-10">
            @foreach ($datacoffeeinfo as $p)
                <form action="/updatecoffeeinfo/{{ $p->id }}" method="post" enctype="multipart/form-data"
                    class="mb-3">
                    @csrf
                    <div class="form-group">
                        <label class="m-2"> Tittle : </label>
                        <input type="text" name="judul" class="form-control m-2 @error('judul') is-invalid @enderror"
                            value="{{ old('judul', $p->judul) }}">
                    </div>
                    <div class="form-group">
                        <label class="m-2"> Description : </label>
                        <input id="deskripsi" type="hidden" name="deskripsi"
                            value="{{ old('deskripsi', $p->deskripsi) }}">
                        <trix-editor input="deskripsi"></trix-editor>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Image : </label>
                        <input type="hidden" name="oldImage" value="{{ $p->image }}">
                        @if ($p->image)
                            <img src="{{ asset('storage/' . $p->image) }}"
                                class="img-preview img-fluid mb-3 col-sm-5 d-block">
                        @else
                            <img class="img-preview img-fluid mb-3 col-sm-5">
                        @endif
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                            name="image" value="{{ old('image', $p->image) }}" onchange="previewImage(event)" multiple>

                    </div>
                    <br>
                    {{ Form::submit('Submit', ['class' => 'btn btn-dark']) }}
                    {{ Form::close() }}
                    <br>
        </div>
    </div>
    @endforeach
@endsection
