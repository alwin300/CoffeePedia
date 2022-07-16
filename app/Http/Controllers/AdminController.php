<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showUser(Request $request)
	{
		$user= DB::table('users')->get();
        return view('admin.tampiluser', [
			'user' => $user
		]);
    }
	public function addUser()
	{
		return view("admin.tambahuser");
	}

    public function storeUser (Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|min:4|max:30|unique:users',
            'email' => 'required|email:dns|max:255|unique:users',
            'password' => 'required|min:6|max:255',
            'role' => 'required'

        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        //$request->session()->flash('success', 'Registration Successful!');//

        return redirect('/user')->with('success', 'Add User Successful!');
    }
    public function verificationOrder()
	{
		// $order= Order::with('payment')->get();
        $payments = Payment::with('order')->latest()->get();

        
        return view('admin.verifikasiorder', [
			'payments' => $payments
		]);
       
    }
    public function verificationStatus ($id)
    {
         $order = DB::table('orders')
        ->where('id', $id)
        ->update(['status' => \request ('status')]);
            
            return redirect('/verifikasiorder');
        
    }
    // public function updateverifikasi (Request $request, $id)
    // {
    //     $rules = $request->validate
	// 	([
	// 	'status' => 'required',
    // ]);
    // $order = Order::where('id', $id)
    // ->update ($rules);

    // return redirect('/verifikasiorder');
    // }
}