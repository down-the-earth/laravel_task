<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;


class Usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Profile page
        $user = User::find($userId = session('user')->id);
        // return $user;
        return view('profile', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $req = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);




        $User = User::create($req);
        // dd($User);
        if ($User) {
            // return $User;
            return redirect()->route('login')->with('success', 'User registered successfully!');
        } else {
            // return $User;
            return redirect()->back()->with('error', 'Failed to register user. Please try again.');
        }
        // return redirect()->back()->with('success', 'User registered successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
