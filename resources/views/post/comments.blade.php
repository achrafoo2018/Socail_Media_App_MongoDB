@extends('layouts.app')

@section('content')
@php
  function timeago($timestamp){
    $time_ago        = strtotime($timestamp);
    $current_time    = time();
    $time_difference = $current_time - $time_ago;
    $seconds         = $time_difference;

    $minutes = round($seconds / 60); // value 60 is seconds
    $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
    $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;
    $weeks   = round($seconds / 604800); // 7*24*60*60;
    $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
    $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60

    if ($seconds <= 60){

      return "Just Now";

    } else if ($minutes <= 60){

      if ($minutes == 1){

        return "one minute ago";

      } else {

        return "$minutes minutes ago";

      }

    } else if ($hours <= 24){

      if ($hours == 1){

        return "an hour ago";

      } else {

        return "$hours hrs ago";

      }

    } else if ($days <= 7){

      if ($days == 1){

        return "yesterday";

      } else {

        return "$days days ago";

      }

    } else if ($weeks <= 4.3){

      if ($weeks == 1){

        return "a week ago";

      } else {

        return "$weeks weeks ago";

      }

    } else if ($months <= 12){

      if ($months == 1){

        return "a month ago";

      } else {

        return "$months months ago";

      }

    } else {

      if ($years == 1){

        return "one year ago";

      } else {

        return "$years years ago";

      }
    }
  }
@endphp
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
                                <textarea class="form-control" name="content" id="" cols="15" rows="3" required @isset($c)autofocus @endisset>@if(@isset($c)){{$c['content']}}@endif</textarea>
                            </div>
                            <button class="btn btn-warning float-right"><i class="fa fa-comment"></i> <b>Comment</b></button>
                        </form>
                    </div>
                    <br>
                    <br>
                    @php
                        if(!$post->comments)
                            $post->comments = [];
                            function sortFunction( $a, $b ) {
                                return strtotime($b["created_at"]) - strtotime($a["created_at"]);
                            }
                            $comments = $post->comments;
                            usort($comments, "sortFunction");
                    @endphp
                    @foreach($comments as $comment)
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
                            {{timeago($comment['created_at'])}}
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
