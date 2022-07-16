@extends('kopi.master')
@section('content')
    <br>
    @foreach ($datacoffeeinfo as $p)
        <div class="card">
            <div class="row no-gutters">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card-body">
                        <h3 class="card-title" style="text-align:center">
                            {{ $p->judul }}</h3>
                        @if ($p->image)
                            <div style="overflow:hidden; ">
                                <p style="text-align:center"><img src="{{ asset('storage/' . $p->image) }}"
                                        class="img-fluid "> </p>
                            </div>
                        @else
                            <img
                                src="https://www.istockphoto.com/photo/modern-living-room-interior-3d-render-gm1293762741-388044683?utm_source=unsplash&utm_medium=affiliate&utm_campaign=srp_photos_top&utm_content=https%3A%2F%2Funsplash.com%2Fs%2Fphotos%2Fapartment&utm_term=apartment%3A%3A%3A">
                        @endif
                        <h4 class="card-body">
                            <p style="text-align:center">{!! $p->deskripsi !!} </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
