<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePaymentRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PesanController extends Controller
{
    public function order (Request $request,Product $produk)
	{
		if($request->quantity > $produk->stok)
		{
			return redirect('etalase/'.$produk->id)->with('error', 'Quantity cannot be more than stock');
		}

		$rules = $request->validate
		([
		'notes' => 'nullable|string|max:50',
		'quantity' => 'required|numeric|min:1',
		]);

		$value =  Order::with('products')->where('user_id', Auth::id())->where('status', 'Not Paid')->first();
		$value?->wherePivot('product_id',$produk->id);
		if ($value?->products->implode('id') != $produk->id) {
		$method =	Order::create([
				'user_id' => Auth::id(),
				'status' => 'Not Paid',
				'giling' => $request->giling,
		        'pesan' => $request->notes,
		        'jumlah' =>  $request->quantity,
		        'jumlah_harga' => $produk->total * $request->quantity,
				'berat' => $produk->berat * $request->quantity,
	     ]);
	$method->products()->sync($produk);
	$method->save();	
	$produk->stok=$produk->stok - $request->quantity;
	$produk->update();
	} else {
		$produk->stok=$produk->stok - $request->quantity;
		$produk->update();
	$value->update([
		'giling' => $request->giling,
		'pesan' => $request->notes,
		'jumlah' => $value->jumlah + $request->quantity,
		'jumlah_harga' => $produk->total * $request->quantity + $value->jumlah_harga,
		'berat' => $produk->berat * $request->quantity + $value->berat,
			]);
		}

		return redirect ('/cart')->with ('success','Order has been added to cart');
	}
	
	public function cart ()
	{	
			$pesanan_details = Order::with('products')->where('user_id', Auth::id())->where('status', 'Not Paid')->get();
		return view ('order.cart',
			[
			'pesanan_details' => $pesanan_details
			]
			);

	}
	public function formEditCart($id)
{
	$order = Order::with('products')->where('id',$id)->first();
	// dd($order);
	return view("order.formeditcart",['order' => $order]);
}

	public function editCart(Request $request,$order_id,$product_id) {
	$order = Order::find($order_id);
	$produk = Product::find($product_id);
	if($request->jumlah > $produk->stok)
		{
			return redirect('cart/edit/'.$order->id)->with('error', 'Quantity cannot be more than stock');
		}
      $rules = $request->validate
		([
		'pesan' => 'nullable|string|max:50',
		'jumlah' => 'numeric|min:1|required',
		'giling' => 'required|string',
		]);
		$order->update([
			'pesan' => $request->pesan,
			'jumlah' => $request->jumlah,
			'giling' => $request->giling,
			'jumlah_harga' => $produk->total * $request->jumlah,
			'berat' => $produk->berat * $request->jumlah,
		]);
		$produk->update([
			'stok' => ($produk->stok + $request->oldJumlah) - $request->jumlah,
		]);
        return redirect('/cart')->with ('success','Order has been edited!');
    }

	
	public function deleteOrder (Order $pesanan)
	{
		$stok = $pesanan->products->toQuery()->first();
		$stok->update([
			'stok' => $pesanan->jumlah + $stok->stok,
		]);
		$pesanan->products()->detach();
		$pesanan->delete();
		return redirect('/cart')->with ('danger','Order has been deleted from cart');
	}

	public function history()
	{
		$order =  Order::with('products','payment')->where('user_id', Auth::user()->id)->where('status', 'Verification Process')
		->orWhere('status','Verified')
		->orWhere('status', 'Verification failed')
		->orWhere('status', 'Order Delivered')
		->orWhere('status', 'Order Completed')
		->orWhere('status', 'Order is Being Delivered')->latest()
		->get();
		// dd($order);
		$payments = Payment::where('user_id', Auth::user()->id);
			return view ('order.history',
			[
			'order' => $order,
			'payments' => $payments,

			]
			);
	}

	public function historyStatus ($id)
    {
         $order = DB::table('orders')
        ->where('id', $id)
        ->update(['status' => \request ('status')]);
            
            return redirect('/history');
        
    }

	public function editPayment ($id)
	{
			$payment = DB::table('payments')->where('order_id',$id)->first();
			// dd($payment);
			return view("order.formeditpayment",['payment' => $payment]);
	}
	public function updatePayment(UpdatePaymentRequest $request, $id)
    {
		$payment = Payment::where('id', $id)->first();
		$payment->order()->update(['status'=>'Verification Process']);
		$request->all();
		if($request->image !== null){
            $path = $request->file('image')->store('payment');
            if ($path) { Storage::disk('public')->delete($payment->image); }
            $payment['image'] = $path;
		
            $payment->save();
		}
			$payment->update();
			
	
        return redirect('/history')->with ('success','Payment has been edited!');
    }

	public function historyseller(Request $request)
	{


		$order =  Order::with('products','payment')->where('user_id', Auth::user()->id)->where('status', 'Order Delivered')
		->orWhere('status', 'Order is Being Delivered')
		->orWhere('status', 'Order Completed')->latest()
		->get();

		$fromdate = $request->fromdate;
		$todate = $request->todate;

		$report = Payment::whereBetween('created_at', [$fromdate, $todate])->get();
		
			return view ('order.historyseller',
			[
			'order' => $order,
			'report' => $report
			]
			);
			
	}

	// public function reportSeller(Request $request)
	// {
	// 	$fromdate = $request->fromdate;
	// 	$todate = $request->todate;

	// 	$report = DB::select("SELECT * FROM payments WHERE created_at BETWEEN '$fromdate 00:00:00' AND'$todate 23:59:59' ");

	// 	return view('order.historyseller', [
	// 		'report' => $report
	// 	]);
	// }
}

// dd($pesanan_baru);
		// $data = Order::fisrtOrCreate(['user_id'=> $pesanan_baru->user_id],$pesanan_baru);
		// dd($pesanan_baru);updateExistingPivot
		// $pesanan_baru->products()->updateOrCreate([
		// 		'user_id' => Auth::user()->id,
		// 	],[
		// 'tanggal' => Carbon::now(),
		// 'status' => 0,
		// 'giling' => $request->giling,
		// 'pesan' => $request->pesan,
		// 'jumlah' => $pesanan_baru->jumlah + $request->jumlah_pesan,
		// 'jumlah_harga' => $produk->harga * $request->jumlah_pesan + $pesanan_baru->jumlah_harga,
		// ])->save();
		// // $pesanan_baru->save();	
		
		// // $produk->order()->sync($pesanan_baru);
		// $pesanan_baru->products()->sync($produk);
		// $pesanan_baru->save();	
