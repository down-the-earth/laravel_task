<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Rules\Loginrule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            // 'email' => ['required', 'email', new Loginrule],
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);



        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $id = Auth::id();
            $user = User::find($id);
            session(['user' => $user]);

            // Check if the user's email is verified using the defined gate
            if (Gate::allows('verify-email')) {
                return redirect()->route('post.index')->with('success', 'Login successful!');
            } else {
                Auth::logout();
                Session::flush();
                return back()->withErrors(['email' => 'Please verify your email before logging in.']);
            }
            // return redirect()->route('post.index')->with('success', 'Login successful!');
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
        // $posts = Post::where('user_id', session('user')->id)->get();
        $posts = Post::paginate(1);

        if (request()->ajax()) {

            $data = Post::select('*');

            return Datatables::of($data)

                ->addIndexColumn()

                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                    return $btn;
                })

                ->rawColumns(['action'])

                ->make(true);
        }
        return view('my_post', compact('posts'));
    }
}
