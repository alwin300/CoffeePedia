@extends('kopi.master')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12 mb-5">
                <div class="card shadow">
                    <div class="card-header">
                        @php
                            $review = \App\Models\Review::where('product_id', $dataproduk->id)->count();
                        @endphp
                        <h3 style="padding-left: 20px; padding-top: 10px;">Review ({{ $review }})
                        </h3>
                    </div>
                    <div class="col-4">
                        <div class="form-review">
                            <img src="{{ asset('storage/' . $dataproduk->image) }}"alt="" width="124"
                                height="124" class="rounded mx-auto">&emsp;
                            {{ $dataproduk->nama }}
                        </div>
                    </div>
                    @foreach ($dataproduk->reviews as $review)
                        <div class="mb-3 mt-3">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-review">
                                        @if ($review->user->image != null)
                                            <img src="{{ asset('storage/' . $review->user->image) }}"alt=""
                                                width="48" height="48" class="rounded-circle me-2">
                                        @else
                                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
                                                alt="" width="48" height="48" class="rounded-circle me-2" />
                                        @endif
                                        {{ $review->user->username }}
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="star">
                                        @for ($i = 1; $i <= $review->star; $i++)
                                            <i class="fa fa-star checked"></i>
                                        @endfor
                                    </div>
                                    {{ $review->reviews }}
                                </div>
                                <div class="col-4 mb-2">
                                    @if ($review->image)
                                        {
                                        <img src="{{ asset('storage/' . $review->image) }}" class="rounded" width="200"
                                            height="200">
                                        }
                                    @else
                                    @endif
                                </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
