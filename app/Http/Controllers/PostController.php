<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('posts')
            ->whereNotIn('id', [session('user')->id])
            ->orderBy('created_at', 'desc')
            ->get();
        // $posts = Post::where('user_id', session('user')->id)->get();
        return view('post', compact('users'));
        // return  $user;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'content' => 'required',
        ]);
        Post::create($validate);
        return redirect()->route('posts')->with('success', 'Post created successfully!');
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
        $post = Post::find($id);
        return view('edit_post', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $post = Post::find($id);
        $post->update($validate);
        return redirect()->route('mypost')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = Post::find($id);
        $id->delete();
        return redirect()->route('mypost')->with('success', 'Post deleted successfully!');
    }
}
