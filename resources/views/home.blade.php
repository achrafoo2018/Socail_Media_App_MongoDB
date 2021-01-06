@extends('layouts.app')

@section('content')
<style>
</style>
<div class="container">
    <div class="row">
        @foreach ($posts as $post)
        @php
            $user = App\Models\User::where('_id', $post->created_by)->first();
        @endphp
        <div class="card mr-5 mb-5" style="width: 20rem;">
            <div class="mt-2 col-md-12">
                <img src="{{asset('storage/'.$user->image)}}" style="width:50px; height:50px; border-radius:50%;" alt="profile picture">
                <b>{{$user->name}}</b>
                @if($user->_id == \Auth::user()->_id)
                    <div class="dropdown float-right mt-2">
                        <button class="btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        More
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{route('post.form',$post->_id)}}">Edit</a>
                        <a class="dropdown-item" href="{{route('post.delete', $post->_id)}}">Delete</a>
                        </div>
                    </div>
                @endif
            </div>
            <hr>
            <h5 class="card-title text-center">{{$post->title}}</h5>
            <img class="card-img-top" width="18rem" height="320rem" src="{{asset('storage/'.$post->image)}}" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">{{$post->content}}</p>
              <hr>
              <button class="btn btn-primary" onclick="event.preventDefault();
              document.getElementById('like-form').submit();"><i class="fa fa-thumbs-up"> Like</i> </button>
              <form id="like-form" action="{{ route('like', $post->_id) }}" method="POST" class="d-none">
                @csrf
            </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
