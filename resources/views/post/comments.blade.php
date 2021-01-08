@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Comment Section</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <img src="{{asset('storage/' . $post->image)}}" alt="" width="243" height="300"
                                class="mb-2">
                        </div>
                        <div class="col">
                            <div class="" style="width:380px;">
                                <h3>{{$post->title}}</h3>
                                <p>{{$post->content}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div>
                        <form action="@if(@isset($c)){{route('comment.edit.content',['_id'=>$post->_id,'_cid'=>$c['_id']])}}@else{{route('comment.create',$post->_id)}}@endif" method="POST">
                            @csrf
                            <div class="form-group">       
                                <textarea class="form-control" name="content" id="" cols="15" rows="3" @isset($c)autofocus @endisset>@if(@isset($c)){{$c['content']}}@endif</textarea>
                            </div>
                            <button class="btn btn-warning float-right">Comment</button>
                        </form>
                    </div>
                    <br>
                    <br>
                    @php
                        if(!$post->comments)
                            $post->comments = [];
                    @endphp
                    @foreach($post->comments as $comment)
                    <hr>

                    @php
                    $image=$comment['user']['image']
                    @endphp
                    <div>
                    <img src="{{asset('storage/'.$image)}}"
                        style="width:50px; height:50px; border-radius:50%;position:relative;bottom:15px;right:4px;"
                        alt="profile picture">
                    <span class="mt-1" style="display:inline-block;width:55%">
                        <b>{{$comment['user']['name']}}</b><br>
                        <small class="form-text text-muted" style="display: inline-block">
                            {{$comment['created_at']}}
                        </small>
                    </span>
                    @if($comment['user']['_id'] == \Auth::user()->_id)
                    <div class="dropdown float-right mt-2">
                        <i class="fa fa-ellipsis-h fa-lg" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"></i>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('comment.edit',['_id'=>$post->_id,'_cid'=>$comment['_id']]) }}">Edit</a>
                            <a class="dropdown-item" href="{{route('comment.delete', ['_id'=>$post->_id,'_cid'=>$comment['_id']])}}">Delete</a>
                        </div>
                    </div>
                    @endif
                </div>
                {{$comment['content']}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
