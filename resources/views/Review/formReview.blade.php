@extends('kopi.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h3 text align="center"> Add a Review </h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        @foreach ($payment as $payments)
                                            <form action="/reviews/{{ $payments->id }}/{{ $product->id }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="stars">
                                                    <input class="star star-5" id="star-5" type="radio" value="5"
                                                        name="star" />
                                                    <label class="star star-5" for="star-5"></label>
                                                    <input class="star star-4" id="star-4" type="radio" value="4"
                                                        name="star" />
                                                    <label class="star star-4" for="star-4"></label>
                                                    <input class="star star-3" id="star-3" type="radio" value="3"
                                                        name="star" />
                                                    <label class="star star-3" for="star-3"></label>
                                                    <input class="star star-2" id="star-2" type="radio" value="2"
                                                        name="star" />
                                                    <label class="star star-2" for="star-2"></label>
                                                    <input class="star star-1" id="star-1" type="radio" value="1"
                                                        name="star" />
                                                    <label class="star star-1" for="star-1"></label>
                                                </div>
                                                <div>
                                                    <label> Review : </label>
                                                    <textarea name="review" id="review" class="form-control @error('review') is-invalid @enderror"
                                                        value="{{ old('review') }}"></textarea>
                                                    @error('review')
                                                        <p class="text-danger"> {{ $message }} </p>
                                                    @enderror
                                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="image" class="form-label">Image :</label>
                                        <img class="img-preview img-fluid mb-2 col-sm-2 d-block">
                                        <input class="form-control @error('image') is-invalid @enderror"
                                            type="file"multiple id="image" name="image" onchange="previewImage()"
                                            multiple>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <button class=" btn btn-lg btn-dark" type="submit">Submit</button>
                    </div>
                @endsection
