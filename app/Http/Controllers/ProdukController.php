<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller{
	public function tampilproduk(Request $request)
	{
		$produk = Product::where('user_id', auth()->user()->id)->paginate(5);
        // $produk['produk'] = Product::
        // where('user_id','=',Auth::user()->id)
        //     ->Paginate(5);
        return view('kopi.tampilproduk', [
			'produk' => $produk
		]);
    }
	public function tampilformproduk()
	{
		$users = User::where('id', Auth::user()->id)->first();

		if(empty($users->notelpon))
		{
			return redirect('/profile')->with('danger', 'Lengkapi Identitas terlebih dahulu!');
		}
		if(empty($users->alamat))
		{
			return redirect('/profile')->with('danger', 'Lengkapi Identitas terlebih dahulu!');
		}
		return view("kopi.formtambahproduk");
	}
	
	public function insertproduk(Request $request)
    {
		$rules = Product::where('user_id', Auth::user()->id)->first();
    $rules = 
        [
        'nama' => 'required|string',
        'jenis' => 'required|string',
		'harga' => 'required|numeric',
		'stok' => 'required|numeric',
		'berat' => 'required|numeric',
		'deskripsi' => 'required|text',
		'diskon' => 'numeric|between:1,100',
		'image' => 'required|image|file',
        ];

        if ($request->file('image')) {
				$validatedData['image'] = $request ->file('image')->store('post-images');
		}

	{
		//codinginsert
		DB::table('products') -> insert ([
			'user_id' =>Auth::user()->id,
			'username' =>Auth::user()->username,
			'nama' => $request->nama,
			'jenis' => $request->jenis,
			'harga' => $request->harga,
			'stok' => $request->stok,
			'berat' => $request->berat,
			'deskripsi' => $request->deskripsi,
			'diskon' => $request->diskon,
			'total' => $request->harga - ($request->harga * $request->diskon/100),
			'image' => $validatedData['image']
		]);
	}
	return redirect('/tampilproduk')->with ('success','Data baru telah tersimpan!');
}
public function tampilformeditproduk(Product $product)
{
	// dd($product);

	return view("kopi.formeditproduk",['product' => $product]);
}
	
	public function updateproduk(Request $request, $id)
    {
		$produk = Product::where('id', $id);
      $rules = $request->validate
		([
		'nama' => 'required|string',
		'jenis' => 'required|string',
		'harga' => 'required|string',
		'stok' => 'required|numeric',
		'berat' => 'required|numeric',
		'deskripsi' => 'required|string',
		'diskon' => 'numeric|between:1,100|nullable',
		'image' => 'nullable|image|file',
		]);
		$validatedData = $request->validate([
			'image' => 'required',
		]);
	if ($request->file('image')) 
		{
			if ($request->oldImage) {
				Storage::delete($request->oldImage);
			}
		$validatedData['image'] = $request ->file('image')->store('post-images');
}
		
		$produk->update([
			'nama' => $request->nama,
			'jenis' => $request->jenis,
			'harga' => $request->harga,
			'stok' => $request->stok,
			'berat' => $request->berat,
			'deskripsi' => $request->deskripsi,
			'diskon' => $request->diskon,
			'total' => $request->harga - ($request->harga * $request->diskon/100),
		]);

        return redirect('/tampilproduk')->with ('success','Data berhasil di edit!');
    }
	
	public function deleteproduk($idhapus)
	{
		$produk = Product::where('id', $idhapus)->first();
			if ($produk->image) {
				unlink(public_path('storage').'/'.$produk->image);
			}
			$produk = Product::where('id', $idhapus)->delete();
					// redirect ke tampil data
					return redirect('/tampilproduk')->with ('success','Data telah dihapus!');
	}
	public function viewproduk ($idview)
	{
		$varproduk = DB::table('products')->where('id',$idview)->get();
		return view("kopi.viewproduk",['dataproduk' => $varproduk]);
	}

		public function etalase(Request $request)
	{	$varproduk = new Product();

		if($request->has('search'))
		{
			$varproduk=Product::where('nama','LIKE', '%'.$request->search.'%')
			->orWhere('jenis','LIKE', '%'.$request->search.'%')
			->orWhere('username','LIKE', '%'.$request->search.'%')->paginate(100); 
		}
		else{
		$varproduk= Product::paginate(100);
		}

	return view("kopi.etalase",['dataproduk' => $varproduk]);
	}
	
		public function view (Product $produk)
	{
		return view("kopi.view",['dataproduk' => $produk]);
	}

	// public function orderbaru()
	// {
	// 		$product =  Order::with('products')->where('id', Auth::user()->id)->where('status', 'Verifikasi Berhasil')->get();
	// 		return view ('kopi.orderbaru',
	// 		[
	// 		'product' => $product
	// 		]
	// 		);
	// }
		public function orderbaru()
		{
		$produk = Order::with('products')->whereHas('products.user', function($q) {
			return $q->where('id','=', Auth::id());
			})
			->where('status', 'Verifikasi Berhasil')
			->orWhere('status', 'Pesanan Sedang Diantar')->get();
					return view ('kopi.orderbaru',
					[
					'produk' => $produk
					]
					);
			}

	public function orderbaruresi($id)
	{
		$order = Order::where('id',$id)->with('payment')->get();
            return view ('kopi.orderbaruresi',['order'=> $order]);
	}

	public function updateResi (Request $request, $id)
	{
		$validatedData = $request->validate([
			'resi' => 'required',
			'status' => 'required'

		]);
		$validatedData = Order::where('id', $id)
		->update ($validatedData);
	
		return redirect('/orderbaru')->with('success', 'No. Resi Berhasil di input');
	}
}

 