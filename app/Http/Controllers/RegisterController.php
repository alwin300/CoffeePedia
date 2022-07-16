<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// if ($request->image !== null) {
		// 	$path =	$request->file('image')->store('post-images');
		// 	if ($path) {Storage::disk('public')->delete($product->image); }
		// 	$product['image'] = $path;
		// 	$product->save();
		// }
		// $product->update();
class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index',[
            'title' => 'Register'
        ]);
    }
    public function store(Request $request)
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

        return redirect('/login')->with('success', 'Registration Successful!');
    }
}
