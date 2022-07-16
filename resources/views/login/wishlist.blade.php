@extends('kopi.master')
@section('title', 'Form Tambah Data Kopi')
@section('content')
    <div class="row row col-lg-12 mt-1">
        <h2 align="center"><i class="feather-32" data-feather="heart"></i> Wishlist </h2>
    </div>
    <div class="row row-cols-1 row-cols-md-6 g-3">
        @foreach ($wishlist as $w)
            {{-- <a href="etalase/{{ $w->product->id }}"class="button"> --}}
            <div class="col mx-1 ">
                <div class="card shadow " style="height: 32rem;">
                    <img src="{{ asset('storage/' . $w->product->image) }}" class="rounded" style="height: 16rem;">
                    <div class="card-body">
                        <h5 class="card-title text-dark "> {{ $w->product->nama }} </h5>
                        <p class="card-text text-dark"> <span data-feather="coffee"></span>
                            {{ $w->product->jenis }}
                        </p>
                        @if (empty($w->product->diskon))
                            <h5 class="card-text text-dark">Rp.
                                {{ number_format($w->product->harga, 0, ',', '.') }}
                            </h5>
                        @else
                            <h5 class="card-text text-dark">Rp.
                                {{ number_format($w->product->total, 0, ',', '.') }}
                            </h5>
                            <div class="card text-white bg-danger col-lg-2" style="max-width: 2rem;">
                                {{ $w->product->diskon }}%</div>
                            <s class="card-text text-dark">Rp.
                                {{ number_format($w->product->harga, 0, ',', '.') }}
                            </s>
                        @endif
                        <a button type="button" class="btn btn-dark" href="etalase/{{ $w->product->id }}"><span
                                data-feather="shopping-cart"> </span> </a>
                        <form action="/wishlist/ {{ $w->id }}" method="post">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-dark"><span data-feather="trash"></span> </button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- </a> --}}
        @endforeach
    </div>
@endsection
