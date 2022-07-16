@extends('kopi.master')
@section('content')
    <div class="container-fluid px-0">
        <div class="container">
            <div class="row>">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card p-3 border-white p-3 shadow mb-4" style="border-radius:10px">
                        <div class="card-body">
                            @foreach ($order as $orders)
                                <form action="/payment/{{ $orders->id }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <h3 class="text-center"> Checkout </h3>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-groups">
                                                    <input type="hidden" value="3" class="form-control"
                                                        name="province_origin">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-groups">
                                                    <input type="hidden" value="456" class="form-control"
                                                        id="city_origin" name="city_origin">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-groups">
                                                    <label> Full Name* </label>
                                                    <input type="text" name="fullname"
                                                        class="form-control @error('fullname') is-invalid @enderror"
                                                        value="{{ old('fullname', $orders->fullname) }}">
                                                    @error('fullname')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-groups">
                                                    <label>No. Telephone*</label>
                                                    <input type="text" name="telephone"
                                                        class="form-control @error('telephone') is-invalid @enderror"
                                                        value="{{ old('telephone', $orders->telephone) }}">
                                                    @error('telephone')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-groups">
                                                    <label for="provinsi">Province Destination*</label>
                                                    <select name="province_id" id="province_id"
                                                        class="form-control @error('province_id') is-invalid @enderror">
                                                        <option value="">Province Destination</option>
                                                        @error('province_id')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                        @foreach ($provinsi as $row)
                                                            <option value="{{ $row['province_id'] }}"
                                                                namaprovinsi="{{ $row['province'] }}">
                                                                {{ $row['province'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="form-groups">
                                                        <input type="hidden" class="form-control" id="nama_provinsi"
                                                            name="nama_provinsi"
                                                            placeholder="ini untuk menangkap nama provinsi ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-groups">
                                                    <label>City Destination*</label>
                                                    <select name="kota_id" id="kota_id"
                                                        class="form-control @error('kota_id') is-invalid @enderror">
                                                        <option value="">City Destination</option>
                                                        @error('kota_id')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-groups">
                                        <input type="hidden" class="form-control" id="nama_kota" name="nama_kota"
                                            placeholder="ini untuk menangkap nama kota">
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-groups">
                                                    <label>Couriers*
                                                    </label>
                                                    <select name="kurir" id="kurir"
                                                        class="form-control @error('kurir') is-invalid @enderror">
                                                        <option value="">Couriers</option>
                                                        <option value="jne">JNE</option>
                                                        <option value="tiki"> TIKI</option>
                                                        <option value="pos">POS INDONESIA</option>
                                                        @error('kurir')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-groups">
                                                    <label>Services*</label>
                                                    <select name="layanan" id="layanan"
                                                        class="form-control
                                                        @error('layanan') is-invalid @enderror">
                                                        <option value="">Services</option>
                                                        @error('layanan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-groups">
                                                    <label>Address*</label>
                                                    <input type="text" name="address" id="address"
                                                        class="form-control @error('address') is-invalid @enderror"
                                                        value="{{ old('address', $orders->address) }}"></textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-groups">
                                                    <label>Ward*</label>
                                                    <input type="text" name="ward"
                                                        class="form-control @error('ward') is-invalid @enderror"
                                                        value="{{ old('ward', $orders->ward) }}">
                                                    @error('ward')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-groups">
                                                    <label>Sub-District*</label>
                                                    <input type="text" name="district"
                                                        class="form-control @error('district') is-invalid @enderror"
                                                        value="{{ old('district', $orders->district) }}">
                                                    @error('district')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-groups">
                                                    <label>Postal Code*</label>
                                                    <input type="text" name="postalcode"
                                                        class="form-control @error('postalcode') is-invalid @enderror"
                                                        value="{{ old('postalcode', $orders->postalcode) }}">
                                                    @error('postalcode')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container mb-4">
            <div class="row>">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card border-white shadow" style="border-radius: 10px">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <H3> Shopping Summary </h3>
                                </div>
                            </div>
                            <input class="form-control" type="hidden" id="status" name="status"
                                value="Verification Process">
                            <input type="hidden" value="{{ $orders->berat }}" id="weight" name="weight">
                            <input type="hidden" value="{{ $orders->jumlah_harga }}" id="jumlah_harga"
                                name="jumlah_harga">
                            <p>Total Product Price : Rp {{ number_format($orders->jumlah_harga) }} </p>
                            <p>Shipping Cost&emsp;&emsp; : Rp <span id="ongkoskirim"></span></p>
                            <p>Total Price&emsp; &emsp; &emsp; : Rp <span id="total"></span></p>
                            <input type="hidden" class="form-control" value="" id="totalhidden"
                                name="totalhidden">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container mb-4">
            <div class="row>">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card border-white shadow" style="border-radius: 10px">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h3> Total Price </h3>
                                    <p> <strong> Bank BCA : 12345678 <BR> A/N : Coffeepedia </strong> </p>
                                    <p style="color:red"> <strong>please pay according to the total price above</strong>
                                    </p>
                                    <p> <strong>
                                            <label for="image" class="form-label">Upload Payment Slip :</label>
                                            <img class="img-preview img-fluid mb-3 col-sm-2 d-block">
                                            <input class="form-control @error('image') is-invalid @enderror"
                                                type="file"multiple id="image" name="image"
                                                onchange="previewImage()" multiple>
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </strong></p>
                                </div>
                            </div>
                            <button class=" btn btn-lg btn-dark" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            //ini ketika provinsi tujuan di klik maka akan eksekusi perintah yg kita mau
            //name select nama nya "provinve_id" kalian bisa sesuaikan dengan form select kalian
            $('select[name="province_id"]').on('change', function() {
                var namaprovinsiku = $("#province_id option:selected").attr("namaprovinsi");
                $("#nama_provinsi").val(namaprovinsiku);
                // kita buat variable provincedid untk menampung data id select province
                let provinceid = $(this).val();
                //kita cek jika id di dpatkan maka apa yg akan kita eksekusi
                if (provinceid) {
                    // jika di temukan id nya kita buat eksekusi ajax GET
                    jQuery.ajax({
                        // url yg di root yang kita buat tadi
                        url: "/kota/" + provinceid,
                        // aksion GET, karena kita mau mengambil data
                        type: 'GET', // type data json
                        dataType: 'json', // jika data berhasil di dapat maka kita mau apain nih
                        success: function(data) {
                            console.log(data);
                            $('select[name="kota_id"]').empty();
                            $('select[name="kota_id"]').append(
                                '<option value="">City Destination</option>');
                            $.each(data, function(key, value) {
                                $('select[name="kota_id"]').append('<option value="' +
                                    value.city_id + '" namakota="' + value.type +
                                    ' ' + value.city_name + '">' + value.type +
                                    ' ' + value.city_name + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="kota_id"]').empty();
                }
            });
            $('select[name="kota_id"]').on('change', function() {
                // membuat variable namakotaku untyk mendapatkan atribut nama kota
                var namakotaku = $("#kota_id option:selected").attr("namakota");
                // menampilkan hasil nama provinsi ke input id nama_provinsi
                $("#nama_kota").val(namakotaku);
            });
        });
        $('select[name="kurir"]').on('change', function() {
            let origin = $("input[name=city_origin]").val();
            let destination = $("select[name=kota_id]").val();
            let courier = $("select[name=kurir]").val();
            let weight = $("input[name=weight]").val();
            if (courier) {
                jQuery.ajax({
                    url: "/origin=" + origin + "&destination=" + destination + "&weight=" + weight +
                        "&courier=" + courier,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('select[name="layanan"]').empty();
                        $('select[name="layanan"]').append(
                            '<option value="">Services</option>');
                        $.each(data, function(key, value) {
                            $.each(value.costs, function(key1, value1) {
                                $.each(value1.cost, function(key2, value2) {
                                    $('select[name="layanan"]').append(
                                        '<option value="' + value1.service +
                                        '" harga_ongkir="' + value2.value +
                                        '" service="' + value1.service +
                                        '">' + value1.service + '-' + value1
                                        .description + '-' + value2.value +
                                        '</option>');
                                });
                            });
                        });
                    }
                });
            }
        });
        $('select[name="layanan"]').on('change', function() {
            let jumlah_harga = $("input[name=jumlah_harga]").val();
            var harga_ongkir = $("#layanan option:selected").attr("harga_ongkir");
            var service = $("#layanan option:selected").attr("service");
            console.log(service)
            $("#ongkoskirim").html(harga_ongkir);
            $("#service").val(service);
            var total_ongkir = $("#layanan option:selected").attr("harga_ongkir");
            $("#totalongkir").val(total_ongkir);
            let total = parseInt(jumlah_harga) + parseInt(harga_ongkir);
            $("#total").html(total);
        });

        $('select[name="layanan"]').on('change', function() {
            let jumlah_harga = $("input[name=jumlah_harga]").val();
            var harga_ongkir = $("#layanan option:selected").attr("harga_ongkir");
            var service = $("#layanan option:selected").attr("service");
            console.log(service)
            $("#ongkoskirim").html(harga_ongkir);
            $("#service").val(service);
            var total_ongkir = $("#layanan option:selected").attr("harga_ongkir");
            $("#totalongkir").val(total_ongkir);
            let totalhidden = parseInt(jumlah_harga) + parseInt(harga_ongkir);
            $("#totalhidden").val(totalhidden);
        });
    </script>
@endsection
