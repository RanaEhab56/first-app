<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Str;
use App\Jobs\ProcessPodcast;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    //
    public function index()
    {

        // $posts=Post::all();
        $posts=Post::paginate(5);
        ProcessPodcast::dispatch();
        
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

    public function store(StorePostRequest $request)
    {   
        if ($request->hasFile('fileUpload')) {
            $image=$request->file('fileUpload');
            $name = $image->getClientOriginalName();
            $imagePath = $request->file('fileUpload')->storeAs('public/images/',$name);
            Post::create([
                'title' =>  $request['title'],
                'description' =>  $request['description'],
                'user_id' => $request['user_id'],
                'slug' =>Str::slug($request->input('title'),'-'),
                'image'=>$name,
            ]);
        }
        

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

    public function update(UpdatePostRequest $request ,$postId)

    { 
        $post=Post::find($postId);
        $name = $post->image;
        // dd($name);

        if ($request->hasFile('fileUpload')) {

            if ($name != null) {
                File::delete(public_path( Storage::url($post->image)));
                
            }
            $image=$request->file('fileUpload');
            $name = $image->getClientOriginalName();
            $imagePath = $request->file('fileUpload')->storeAs('public/images/',$name);
        }

        Post::where('id',$postId)->update([
            'title' =>  $request['title'],
            'description' =>  $request['description'],
            'user_id' => $request['user_id'],
            'slug' =>Str::slug($request->input('title'),'-'),
            'image'=>$name,
        
        ]);
        
        return redirect()->route('posts.index');

    }

    public function destroy($postId){
        Post::where('id', $postId)->delete();
        return redirect()->route('posts.index')->with('danger', "post No.$postId deleted!");

    }
}
