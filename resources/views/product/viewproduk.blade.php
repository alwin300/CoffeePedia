@extends('kopi.master')
@section('content')
    <br>

    <div class="card">
        <div class="row no-gutters">
            <div class="col-md-9">
                <div class="card-body">
                    <h3 class="card-title">
                        &nbsp; {{ $product->nama }}</h3>
                    @if ($product->image)
                        <div style="max-height: 150px overflow:hidden;">
                            <img src="{{ asset('/storage/' . $product->image) }}" class="img-fluid">
                        </div>
                    @else
                        <img
                            src="https://www.istockphoto.com/photo/modern-living-room-interior-3d-render-gm1293762741-388044683?utm_source=unsplash&utm_medium=affiliate&utm_campaign=srp_photos_top&utm_content=https%3A%2F%2Funsplash.com%2Fs%2Fphotos%2Fapartment&utm_term=apartment%3A%3A%3A">
                    @endif
                    <h4 class="card-body">
                        Variant &emsp; &emsp;: {{ $product->jenis }} <br> <br>
                        Price &emsp; &nbsp;: Rp. {{ number_format($product->harga, 0, ',', '.') }} <br><br>
                        Description &nbsp;: {!! $product->deskripsi !!} <br><br>
                    </h4>
                </div>
            </div>
        </div>
    </div>
@endsection
