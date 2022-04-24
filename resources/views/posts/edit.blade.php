@extends('layouts.app')

@section('title')Update @endsection


@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action=" {{ route('posts.update', ['post' => $posts->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="post_id"  value="{{ $posts->id }}" />

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">title</label>
                <input name="title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $posts->title }}">
            </div>

            
            <div class="mb-3">
               
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"> {{ $posts->description }}</textarea>
            </div>

            <div class="mb-3">
            <div>
            <label class="form-label" for="customFile @error('fileUpload') is-invalid @enderror">Upload File</label>
            <input type="file" name="fileUpload" class="form-control" id="customFile" />
            </div>
            @error('fileUpload')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
                <select name="user_id" class="form-control" >
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach

                </select>
            </div>
          <button type="submit" class="btn btn-success">Update</button>
        </form>
@endsection
