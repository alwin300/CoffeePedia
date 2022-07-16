<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckOngkirController extends Controller
{
    public function get_province(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key:e681b30387de105eba048e10390edb4d"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            } else {
            //ini kita decode data nya terlebih dahulu
            $response=json_decode($response,true);
            //ini untuk mengambil data provinsi yang ada di dalam rajaongkir result
            $data_pengirim = $response['rajaongkir']['results'];
            return $data_pengirim;
            }
            }

    public function get_city($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=$id",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key:e681b30387de105eba048e10390edb4d"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            } else {
            $response=json_decode($response,true);
            $data_kota = $response['rajaongkir']['results'];
            return json_encode($data_kota);
            }
            }

    public function checkout($id){
        $order =  Order::with('products')->where('user_id', Auth::user()->id)->where('id', $id)->get(); 
        //memanggil function get_province
        $provinsi = $this->get_province();
        //mengarah kepada file checkout.blade.php yang ada di view
        return view('order.checkout', compact('order','provinsi'));
        }

        public function get_ongkir($origin, $destination, $weight, $courier){
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=$courier",
            CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key:e681b30387de105eba048e10390edb4d"
            ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
                } else {
                $response=json_decode($response,true);
                $data_ongkir = $response['rajaongkir']['results'];
                return json_encode($data_ongkir);
                }
            }

            public function payment (Request $request, $id){
                // $rules = Payment::where('user_id', Auth::user()->id)->first();
                $rules = $request->validate
                    ([
                    'fullname' => 'required|min:3|max:50|alpha_spaces',
                    'telephone' => 'required|numeric|digits_between:7,14',
                    'province_id' => 'required|string',
                    'nama_provinsi' => 'required|string',
                    'kota_id' => 'required|string',
                    'nama_kota' => 'required|string',
                    'kurir' => 'required|string',
                    'layanan' => 'required|string',
                    'address' => 'required|min:12|max:50',
                    'ward' => 'required|string|min:4|max:30',
                    'district' => 'required|string|min:4|max: 30',
                    'postalcode' => 'required|numeric|digits:5',
                    'image' => 'required|image',
                    ]);
                    $validatedData = $request->validate([
                        'image' => 'required|image',
                    ]);
                if ($request->file('image')) {
                    $validatedData['image'] = $request ->file('image')->store('payment');
            }
            {

                DB::table('payments') -> insert ([
                    'order_id' => $id,
                    'user_id' =>Auth::user()->id,
                    'namalengkap' =>$request->fullname,
                    'notelp' => $request->telephone,
                    'province_id' => $request->province_id,
                    'nama_provinsi' => $request->nama_provinsi,
                    'kota_id' => $request->kota_id,
                    'nama_kota' => $request->nama_kota,
                    'kurir' => $request->kurir,
                    'layanan' => $request->layanan,
                    'alamat' => $request->address,
                    'kelurahan' => $request->ward,
                    'kecamatan' => $request->district,
                    'kodepos' => $request->postalcode,
                    'total' => $request->totalhidden,
                    'image' => $validatedData['image']
                ]);
               
               
                $order = $request->validate([
                    'status' => 'required',
                ]);
                $order = Order::where('id', $id)
               
			    ->update ($order);
            }
            return redirect('/history')->with('success', 'Payment Verification on Process!');
        }

}