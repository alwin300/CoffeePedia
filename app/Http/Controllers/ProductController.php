<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
 
    public function index()
    {
        $produk = Product::where('user_id', auth()->user()->id)->paginate(5);
        return view('product.tampilproduk', [
			'produk' => $produk
		]);
    }

  
    public function create()
    {
        return view("product.formtambahproduk");
    }

    public function store(StoreProductRequest $request)
    {
        $product = $request->all();
        if(isset($request->image)){
            $path = $request->file('image')->store('post-images');
            $product['image'] = $path;
        }
        $product = Product::create($product);
        $product->save();

        return redirect()->route('product.index')->with ('success','Product has been saved!');
    }

    
    public function show(Product $product)
    {
        // dd($product);
        return view("product.viewproduk",['product' => $product]);
    }

    public function edit(Product $product)
    {

        return view("product.formeditproduk",['product' => $product]);
    }

  
    public function update(UpdateProductRequest $request, Product $product)
    {
        
        $request->all();

        if($request->image !== null){
            $path = $request->file('image')->store('product');
            if ($path) { Storage::disk('public')->delete($product->image); }
            $product['image'] = $path;
            $product->save();
        } 

        $product->nama = $request->nama;
        $product->jenis = $request->jenis;
        $product->asal = $request->asal;
        $product->harga = $request->harga;
        $product->stok = $request->stok;
        $product->berat = $request->berat;
        $product->deskripsi = $request->deskripsi;
        $product->diskon = $request->diskon;
        $product->total = $request->harga - ($request->harga * $request->diskon/100);
        $product->save();
        return redirect()->route('product.index')->with ('success','Product has been updated!');
    }

   
    public function delete(Product $product)
    {
        Storage::delete($product->image);
        $product->delete();
        return redirect()->route('product.index')->with ('success','Product has been deleted!');
    }
    public function newOrder()
    {
    $produk = Order::with('products')->whereHas('products.user', function($q) {
        return $q->where('id','=', Auth::id());
        })
        ->where('status', 'Verified')
        ->orWhere('status', 'Order is Being Delivered')->get();
                return view ('order.orderbaru',
                [
                'produk' => $produk
                ]
                );
        }
    public function addResi($id)
	{
		$order = Order::where('id',$id)->with('payment')->get();
            return view ('order.orderbaruresi',['order'=> $order]);
	}

	public function updateresi (Request $request, $id)
	{
		$validatedData = $request->validate([
			'resi' => 'required',
			'status' => 'required'

		]);
		$validatedData = Order::where('id', $id)
		->update ($validatedData);
	
		return redirect('/orderbaru')->with('success', 'No. Resi successfully added!');
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

	return view("etalase",['dataproduk' => $varproduk]);
	}
	
		public function view (Product $produk)
	{
        $star = Review::with('product')->where('product_id', $produk->id)->get();
        
        $star_sum = Review::with('product')->where('product_id', $produk->id)->sum('star');
        if ($star->count() > 0)
        {
        $star_value = $star_sum/$star->count();
        }
        else
        {
            $star_value = 0;
        }
		return view("order.view",['dataproduk' => $produk, 'star' => $star, 'star_value' => $star_value]);
	}
    public function review (Product $produk)
    {
        $star = Review::with('product')->where ('product_id', $produk->id)->get();

        return view("review.reviewProduct", ['dataproduk' => $produk, 'star => $star']);
    }
}
