<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function showWishlist ()
    {
            $wishlist = Wishlist::with('product')->where('user_id', auth()->user()->id)->get();
            return view('login.wishlist', [
                'wishlist' => $wishlist
            ]);
    }

    public function addWishlist(Product $produk)
    {
        $wishlist = Wishlist::where('product_id', $produk->id)->where('user_id', Auth::id())->first();
        if(isset($wishlist)){
            return redirect('etalase/'.$produk->id)->with('error', 'Product wishlist already exist');
        }
        else {
        Wishlist::insert([
            'user_id' =>Auth::user()->id,
            'product_id' => $produk->id,
        ]);
    }
        return redirect('etalase/'. $produk->id)-> with ('success', 'Product has been added to wishlist');
    }
    public function deleteWishlist (Wishlist $wishlist)
	{
		$wishlist->delete();
		return redirect('/wishlist');
	}
}
