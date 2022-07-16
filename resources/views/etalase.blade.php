@extends('kopi.master')
@section('content')
    <br>
    <div class="row row col-lg-12 mt-1">
        <h2 align="center"> List Product </h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="/etalase">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search.." name="search"
                        value="{{ request('search') }}"> &nbsp;
                    <button class="btn btn-dark" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-6 g-3">
        @foreach ($dataproduk as $p)
            <a href="etalase/{{ $p->id }}"class="button">
                <div class="col mx-1 ">
                    <div class="card shadow " style="height: 32rem;">
                        <img src="{{ asset('storage/' . $p->image) }}" class="rounded" style="height: 16rem;">
                        <div class="card-body">
                            <h5 class="card-title text-dark "> {{ $p->nama }} </h5>
                            <p class="card-text text-dark"> <span data-feather="coffee"></span> {{ $p->jenis }}</p>
                            @if (empty($p->diskon))
                                <h5 class="card-text text-dark">Rp. {{ number_format($p->harga, 0, ',', '.') }} </h5>
                            @else
                                <h5 class="card-text text-dark">Rp. {{ number_format($p->total, 0, ',', '.') }} </h5>
                                <div class="card text-white bg-danger col-lg-2" style="max-width: 2rem;">
                                    {{ $p->diskon }}%</div>
                                <s class="card-text text-dark">Rp. {{ number_format($p->harga, 0, ',', '.') }} </s>
                            @endif
                        </div>
                        <div class="card-footer border-0">
                            @if ($p->user->image != null)
                                <p class="rounded-circle me-2 text-dark"> <img
                                        src={{ asset('storage/' . $p->user->image) }} alt="" width="32"
                                        height="32" class="rounded-circle me-2">{{ $p->user->username }}</p>
                            @else
                                <p class="rounded-circle me-2 text-dark"> <img
                                        src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
                                        alt="" width="32" height="32"
                                        class="rounded-circle me-2">{{ $p->user->username }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
