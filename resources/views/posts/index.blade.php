<?php
use Carbon\Carbon;
?>
@extends('layouts.app')

@section('title')Index @endsection

@section('content')
        <div class="text-center">
            <a href="{{ route('posts.create') }}" class="mt-4 btn btn-success">Create Post</a>
        </div>
        <table class="table mt-4">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
                <th scope="col">Slug</th>
                <th scope="col">image</th>
              </tr>
            </thead>
            <tbody>
            
            @foreach ( $posts as $post)
            
              <tr>
                <td>{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                @if($post->user)
                  <td>{{$post->user->name}}</td>
                @else
                  <td>Not Found</td>
                @endif
                {{-- <td>{{$post->user ? $post->user->name : 'Not Found'}}</td> --}}
                <td>{{ Carbon::parse($post->created_at)->toDayDateTImeString() }}</td>
                <td>
                    <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-info">View</a>
                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>
                    <form action ="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST" class="d-inline"> 
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Sure Want Delete?')">Delete</button>
                    </form> 
                </td>
                <td>{{ $post->slug }}</td>
                <td><img src="{{ asset('storage/images/'.$post->image) }}" style="width:50px;height:50px;"/></td>
              </tr>
              @endforeach

            </tbody>
          </table>
          <div>
          {{ $posts->links('pagination::bootstrap-4') }}
          </div>
      
     
@endsection