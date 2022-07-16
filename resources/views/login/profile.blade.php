@extends('kopi.master')
@section('title', 'Form Tambah Data Kopi')
@section('content')
    @if (session()->has('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('danger') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-md-10 offset-1">
        <div class="card">
            <div class="card-body">
                <h4><span data-feather="user"></span> My Profile</h4>
                @if ($users->image != null)
                    <p style="text-align:center"><img src={{ asset('storage/' . $users->image) }} alt=""
                            width="128" height="128" class="rounded-circle me-2" /> </p>
                @else
                    <p style="text-align:center"><img
                            src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
                            alt="" width="128" height="128" class="rounded-circle me-2" /> </p>
                @endif
                <form action="/profile/{{ $users->id }}" method="post"enctype="multipart/form-data" class="mb-1">
                    @csrf
                    <div class="form-group row">
                        <label for="username" class="col-md-3 col-form-label text-md-right"> Username </label>:
                        <div class="col-md-6">
                            <input type="text" name="username"
                                class="form-control @error('username') is-invalid @enderror" id="username"
                                value="{{ $users->username }}">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-3 col-form-label text-md-right"> E-Mail </label>:
                        <div class="col-md-6">
                            <input type="email"name="email" class="form-control  @error('email') is-invalid @enderror"
                                id="email" value="{{ $users->email }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="notelpon" class="col-md-3 col-form-label text-md-right">No.Telephone</label>:
                        <div class="col-md-6">
                            <input type="number" name="notelpon"
                                class="form-control  @error('notelpon') is-invalid @enderror" id="notelpon"
                                value="{{ $users->notelpon }}">
                            @error('notelpon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-md-3 col-form-label text-md-right">Address</label>:
                        <div class="col-md-6">
                            <input type="text" name="alamat" class="form-control  @error('alamat') is-invalid @enderror"
                                id="alamat" value="{{ $users->alamat }}">
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    @if (auth()->user()->role == 'seller')
                        <div class="form-group row">
                            <label for="norek" class="col-md-3 col-form-label text-md-right">Bank account
                                number</label>:
                            <div class="col-md-6">
                                <input type="number" name="norek"
                                    class="form-control  @error('norek') is-invalid @enderror" id="norek"
                                    value="{{ $users->norek }}">
                                @error('norek')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    @endif
                    <div class="form-group row">
                        <label for="image" class="form-label">Upload Photo Profile</label>
                        <img class="img-preview img-fluid mb-3 col-sm-2 d-block">
                        <input class="form-control  @error('image') is-invalid @enderror" type="file"multiple
                            id="image" name="image" onchange="previewImage()" multiple>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class=" btn btn-lg btn-dark" type="submit">Save</button>
            </div>
            </form>
        </div>
    </div>
@endsection
