@extends('kopi.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h3> New Order </h3>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4 mt-4">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> No</th>
                                    <th> Product Name</th>
                                    <th> Quantity </th>
                                    <th> Grind Size </th>
                                    <th> Notes </th>
                                    <th> Status </th>
                                    <th> Price </th>
                                    <th> Total Price </th>
                                    <th> No.Resi </th>
                                    <th colspan="2"></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                ?>

                                @forelse ($produk as $products)
                                    <tr>
                                        <td>{{ $no++ }} </td>
                                        <td> {{ $products->products->implode('nama', ',') }} </td>
                                        <td> {{ $products->jumlah }} </td>
                                        <td> {{ $products->giling }} </td>
                                        <td> {{ $products->pesan }} </td>
                                        <td> {{ $products->status }} </td>
                                        <td>
                                            Rp. {{ number_format($products->products->implode('total', ',')) }}
                                        </td>
                                        </td>
                                        <td>
                                            Rp. {{ number_format($products->jumlah_harga) }} </td>
                                        <td> {{ $products->resi }} </td>
                                        <td><a button type="button" class="btn btn-dark"
                                                href="/orderbaru/{{ $products->id }} "><span data-feather="edit"></span>
                                                Isi No.Resi</a></td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="8" align="center">
                                            <h4>No New Order </h4>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- @extends('kopi.master')
@section('content')
<div class="container">
	<div class="row">
        <div class = "col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3> New Order </h3>
                </div>
                @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> No</th>
                                <th> Nama Barang</th>
                                <th> Jumlah </th>
                                <th> Ukuran Gilingan </th>
                                <th> Pesan </th>
                                <th> Status </th>
                                <th> Harga </th>
                                <th> Total Harga </th>
                                <th colspan="2"></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;
                        ?>

                       @forelse ($product as $products) 
                            <tr>
                                <td>{{ $no++ }} </td>
                                <td> {{ $products->products->implode('nama', ',')}} </td>
                                <td> {{ $products->jumlah}} </td>
                                <td> {{ $products->giling}} </td>
                                 <td> {{ $products->pesan}} </td>
                                 <td> {{ $products->status}} </td>
                                <td>
                                    Rp.  {{ number_format($products->products->implode('harga', ',')) }} </td>
                                </td>
                                <td>
                                    RP. {{ number_format($products->jumlah_harga) }} 
                            </tr>
                            @empty
                            <tr>
                                <td colspan ="8" align="center"><h4>No New Order </h4> </td>
                            </tr>
                            @endforelse
                                
                        </tbody>
                    </table>
                </div>
	        </div>	
        </div>
    </div>	
</div>
@endsection --}}
