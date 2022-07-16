<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coffeepedia</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <link rel="stylesheet" href="/css/style.css">
    <script type="text/javascript" src="/js/trix.js"></script>
    <style>
        [data-trix-button-group="file-tools"] {
            display: none !important;
        }
    </style>
</head>

<body style="background-color:#E5E3E3;">


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="navbar-brand" href="/etalase">
                            <img src="{{ asset('storage/logo/coffeepedia.png') }}"alt="" width="180"
                                class="d-inline-block align-text-center"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="etalase"> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="coffeeinfo">CoffeeInfo </a>
                    </li>
                    @if (auth()->user()->role == 'seller')
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('product.index') }}">List Product </a>
                        </li>
                    @endif
                    @if (auth()->user()->role == 'buyer')
                        <li class="nav-item">
                            <a class="nav-link active" href="history">Transaction History </a>
                        </li>
                    @endif
                    @if (auth()->user()->role == 'seller')
                        <li class="nav-item">
                            <a class="nav-link active" href="historyseller">Transaction History </a>
                        </li>
                    @endif
                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                        @if (auth()->user()->role == 'buyer')
                            <li class="nav-item">
                                @php
                                    $pesanan_utama = \App\Models\Order::where('user_id', Auth::id())
                                        ->where('status', 'Not Paid')
                                        ->count();
                                @endphp
                                <a class="nav-link active" href="cart"> <span data-feather="shopping-bag"> </span>
                                    <span
                                        class="translate-middle badge rounded-pill bg-danger">{{ $pesanan_utama }}</span>
                                    </span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->role == 'seller')
                            @php
                                $new_order = \App\Models\Order::with('products')
                                    ->whereHas('products.user', function ($q) {
                                        return $q->where('id', '=', Auth::id());
                                    })
                                    ->where('status', 'Verified')
                                    ->get();
                            @endphp
                            <a class="nav-link active" href="orderbaru"><span data-feather="clipboard"></span>
                                <span
                                    class="translate-middle badge rounded-pill bg-danger">{{ $new_order->count() }}</span>
                            </a>
                            </li>
                        @endif
                        @if (auth()->user()->role == 'admin')
                            @php
                                $verification = \App\Models\Order::where('status', 'Verification Process')->count();
                            @endphp
                            <li class="nav-item">
                                <a class="nav-link active" href="verifikasiorder"><span data-feather="check-square"></span>
                            </li>
                            <span class="translate-middle badge rounded-pill bg-danger">{{ $verification }}</span>
                            </a>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Welcome back, {{ auth()->user()->username }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/profile"> <span data-feather="user"> </span> My
                                        Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                @if (auth()->user()->role == 'buyer')
                                    <li><a class="dropdown-item" href="/wishlist"> <span data-feather="heart"> </span>
                                            Wishlist</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                @endif
                                @if (auth()->user()->role == 'admin')
                                    <li><a class="dropdown-item" href="/user"> <span data-feather="users"> </span>
                                            Users</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                @endif
                                <li>
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item"> <span data-feather="log-out"> </span>
                                            Logout</a>
                                </li>
                                </form>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="/login" class="nav-link"><span data-feather="log-in"></span> Login </a>
                        </li>
                    @endauth
                </ul>

            </div>
        </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-12 px-md-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h1 class="h2"> </h1>
        </div>
        <div class="content">
            @yield('content')
        </div>
    </main>
    </div>

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>

    <script src="/js/dashboard.js"></script>
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
