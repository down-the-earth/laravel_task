<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $id = Auth::id();
            $user = User::find($id);
            session(['user' => $user]);

            return redirect()->route('posts')->with('success', 'Login successful!');
        } else {
            return back()->withErrors(['email' => 'Invalid email or password.']);
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login')->with('success', 'Logout successful!');
    }

    public function mypost()
    {
        $posts = Post::where('user_id', session('user')->id)->get();
        return view('my_post', compact('posts'));
    }
}
