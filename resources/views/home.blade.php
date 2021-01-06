@extends('layouts.app')

@section('content')
<style>
</style>
<div class="container">
    <div class="row justify-content-center">
      <div class="col-4">
        @foreach ($posts as $post)
        <div class="card bg-light" style="border-radius: 10px">
            <div class="card-header text-center border-0">
              <div class=""><h3>{{$post->title}}</h3></div>
            </div>
            <div class="card-body text-center" style="padding-left:0;padding-right:0;padding-bottom:0;background-color:rgba(0,0,0,.03)">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                      <div class="text-left pl-2"><p>{{$post->content}}</p></div>
                      <img style="width: 100%"  src="{{asset('storage/' . $post->image)}}" height="400px" alt="">
            </div>
            <div class="card-footer">
                <div class="row text-center">
                  <div class="col">
                    <button class="btn btn-primary">Like</button>
                  </div>
                  <div class="col">
                    <button class="btn btn-warning">Comment</button>
                  </div>
                </div>
            </div>
        </div>
        <br><br>
        @endforeach
      </div>
    </div>
</div>
@endsection
