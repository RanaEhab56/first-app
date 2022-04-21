<?php
use Carbon\Carbon;
?>
@extends('layouts.app')

@section('title')Show @endsection


@section('content')
<div class="card text-dark bg-info mb-3 my-5">
  <div class="card-header fw-bold">Post Info</div>
  
  <p class="card-text mx-5"><span class="fw-bolder">Title: </span>{{ $posts->title }} <br> 
  <span class="fw-bolder">Description: </span>{{ $posts->description }}</p>
</div>


<div class="card text-dark bg-light mb-3 my-5">
  <div class="card-header fw-bold">Post creator Info</div>
  <p class="card-text mx-5"><span class="fw-bolder">Name: </span>{{ $posts->user->name }} <br> 
  <span class="fw-bolder">Email: </span>{{ $posts->user->email }} <br>
  <span class="fw-bolder">Created At: </span>{{ Carbon::parse($posts->created_at )->format('l jS \\of F Y h:i:s A') }}</p></p>
</div>

<div class="card mt-3 w-75">
  <div class="card-header bg-secondary text-light">
Add acomment
  </div>
  <form action="{{route('comments.store')}}" method="POST" class="row col-10 offset-1 my-2 d-flex justify-content-center" >
       @csrf
    <div class="col-lg-9  col-sm-12">
      <input id="input-msg" class="form-control border border-success shadow-sm p-2 mb-1"
       type="text" 
       onfocus="this.placeholder = ''"
      onblur="this.placeholder ='Enter  your comment'"
      placeholder ='Enter your comment'
       aria-label="default input" autocomplete="off" 
       name="body"/>
    </div>
    <input type="hidden" name="post_id"  value="{{ $posts->id }}" />
    <input type="hidden" name="parent"  value="App\Models\Post" />
    <button type="submit" id="send-btn" class="btn btn-primary ms-2 col-lg-2 col-sm-8">
      <i class="fa-solid fa-paper-plane"></i>
       comment</button>
  </form>
</div>
@endsection
