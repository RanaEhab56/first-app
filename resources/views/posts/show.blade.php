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
@endsection
