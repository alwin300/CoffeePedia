<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function addReview($id, $idproduct)
        {
            $payment =  Payment::where('user_id', Auth::user()->id)->where('id', $id)->get(); 
            $product = Product::where('id', $idproduct)->first();
            return view("review.formReview",['payment' => $payment, 'product' => $product]);
        }
    
        public function storeReview (Request $request, $id, $idproduct)
        {
            $payment = Payment::where('id', $id)->first();
            $payment->order()->update(['status'=>'Order Completed']);
            $rules = $request->validate
            ([
                'star' => 'required',
            'review' => 'required|min:3|max:250',
            'image' => 'nullable|image',
            ]);
            $validatedData = $request->validate([
                'image' => 'nullable|image',
            ]);
        if ($request->file('image')) {
            $validatedData['image'] = $request ->file('image')->store('reviews');
    }
    {

        DB::table('reviews') -> insert ([
            'payment_id' => $id,
            'user_id' =>Auth::user()->id,
            'product_id' => $idproduct,
            'star' => $request->star,
            'reviews' =>$request->review,
            'image' => $validatedData['image']
        ]);
    }
    return redirect('/history')->with('success', 'Review has posted');
}
        

    public function viewReview (Review $review)
	{
		return view("review.viewReview",['review' => $review]);
	}
}
