<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{
    public function index()
    {
        return view ('login.index', [
            'title' => 'login'
        ]);
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);     
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/etalase');
        }

        return back()->with('loginError', 'Login Failed!');
    }  

    public function logout ()
    {
        Auth::logout();
     
        request()->session()->invalidate();
     
        request()->session()->regenerateToken();
     
        return redirect('/login');
    }

    public function profile()
    {

            $users = User::where('id', Auth::user()->id)->first();
            return view ('login.profile', compact('users'));

    }

    public function update(Request $request, $id)
    {
        $users = User::where('id', Auth::user()->id)->first();
        $rules= $request->validate
        ([
            'username' => 'min:4|max:30|unique:users,username,' . $users->id,
            'email' => 'email:dns|max:255|unique:users,email,' . $users->id,
            'notelpon' => 'nullable|min:11|max:14|unique:users,notelpon,' . $users->id,
            'alamat' => 'max:255',
            'image' => 'image|file',
            'norek' => 'nullable|numeric|digits_between:8,25',
        ]);
        if ($request->file('image')) {
			if ($request->oldImage) {
				Storage::delete($request->oldImage);
			}
		}
		
			if ($request-> file('image')) {
				$rules ['image'] = $request->file('image')->store('post-images');
			}
            $profile = user::where('id', $id)
        ->update ($rules);

        return redirect('/profile');
    }
}
