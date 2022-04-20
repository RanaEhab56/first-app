<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    //
    public function index()
    {

        // $posts=Post::all();
        $posts=Post::paginate(5);
        
        return view('posts.index',[
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        $users=User::all();

       return view('posts.create',[
           'users' => $users
        ]); 
     }

    public function store()
    {   
        // $data=$_POST;
        $data=request()->all();
        Post::create([
            'title'=> $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
        ]);
        return redirect()->route('posts.index');
       
    }

    public function show($postId)
    {
        $posts=Post::find($postId);
        // dd($posts);
        return view('posts.show', ['posts' => $posts]);
    }

    public function edit($postId)
    {
        $posts=Post::find($postId);
        $users=User::all();
        return view('posts.edit', ['posts' => $posts , 'users' => $users]);
    }

    public function update(Request $request, $postId)
    {   
        Post::where('id',$postId)->update($request->except(['_token','_method']));
        
        return redirect()->route('posts.index');

    }

    public function destroy($postId){
        Post::where('id', $postId)->delete();
        return redirect()->route('posts.index')->with('danger', "post No.$postId deleted!");

    }
}
