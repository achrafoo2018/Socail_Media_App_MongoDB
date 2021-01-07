@extends('layouts.app')

@section('content')
<style>
    .btn {
  display: inline-block;
  position: relative;

  text-decoration: none;
}
/*
 * Counter button style
 */
.btn-counter { margin-right: 39px;}
.btn-counter:after,
.btn-counter:hover:after { text-shadow: none; }
.btn-counter:after {
    height:30px;
    width:40px;
  border-radius: 3px;
  border: 1px solid #d3d3d3;
  background-color: #eee;
  padding: 0 8px;
  color: #777;
  content: attr(data-count);
  left: 100%;
  margin-left: 8px;
  margin-right: -13px;
  position: absolute;
  top: 4px;
}
.btn-counter:before {
  transform: rotate(45deg);
  filter: progid:DXImageTransform.Microsoft.Matrix(M11=0.7071067811865476, M12=-0.7071067811865475, M21=0.7071067811865475, M22=0.7071067811865476, sizingMethod='auto expand');

  background-color: #eee;
  border: 1px solid #d3d3d3;
  border-right: 0;
  border-top: 0;
  content: '';
  position: absolute;
  right: -12px;
  top: 16px;
  height: 6px;
  width: 6px;
  z-index: 1;
  zoom: 1;
}
/*
 * Custom styles
 */
    
</style>
<div class="container">
    <div class="row">
        @foreach ($posts as $post)
        @php
            $user = App\Models\User::where('_id', $post->created_by['id'])->first();
        @endphp
        <div class="card mr-5 mb-5" style="width: 20rem;">
            <div class="mt-2 col-12">
                    <img src="{{asset('storage/'.$user->image)}}" style="width:50px; height:50px; border-radius:50%;position:relative;bottom:15px;right:4px;" alt="profile picture">
                <span class="mt-1" style="display: inline-block;width:55%">
                    <b>{{$user->name}}</b><br>
                    <small class="form-text text-muted" style="display: inline-block">
                        {{$post->created_at->toDateString()}}
                    </small>
                </span>
                @if($user->_id == \Auth::user()->_id)
                    <div class="dropdown float-right mt-2">

                        <i class="fa fa-ellipsis-h fa-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
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
              <div>
                <a href="{{ route('like', $post->_id) }}?route=home" title="Like" class="btn btn-counter btn-{{in_array(\Auth::user()->_id, $post->likes) ? "primary":"outline-primary"}}" data-count="{{sizeof($post->likes)}}"><i class="fa fa-thumbs-up mr-2"></i><span style="font-family: Arial, Helvetica, sans-serif">Like</span></a>
              </div>

            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
