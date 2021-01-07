@extends('layouts.app')

@section('content')
<style>
    .btn {
  display: inline-block;
  position: relative;

  text-decoration: none;
}
/*
 * Comment button style
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
  left: 105%;
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
  right: -9px;
  top: 16px;
  height: 6px;
  width: 6px;
  z-index: 1;
  zoom: 1;
}
/*
 * Like Button
 */


 #btn-counter { margin-right: 39px;}
#btn-counter:after,
#btn-counter:hover:after { text-shadow: none; }
#btn-counter:after {
    height:30px;
    width:40px;
  border-radius: 3px;
  border: 1px solid #d3d3d3;
  background-color: #eee;
  padding: 0 8px;
  color: #777;
  content: attr(data-count);
  left: 108%;
  position: absolute;
  top: 4px;
}
#btn-counter:before {
  transform: rotate(45deg);
  filter: progid:DXImageTransform.Microsoft.Matrix(M11=0.7071067811865476, M12=-0.7071067811865475, M21=0.7071067811865475, M22=0.7071067811865476, sizingMethod='auto expand');

  background-color: #eee;
  border: 1px solid #d3d3d3;
  border-right: 0;
  border-top: 0;
  content: '';
  position: absolute;
  right: -9px;
  top: 16px;
  height: 6px;
  width: 6px;
  z-index: 1;
  zoom: 1;
}


</style>
<div class="container" style="margin:0 auto">
    <div class="row">
        <div class="col-md-6 col-md-offset-1">
            <img src="{{asset('storage/'.$user->image) }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
            <h2>{{ $user->name }}</h2>
            <form enctype="multipart/form-data" method="POST">
                <div class="custom-file col-md-6">
                    <input type="file" name="avatar" class="custom-file-input" id="validatedCustomFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Choose profile picture</label>
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                  </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="pull-right btn btn-primary" value="Submit" name="changeImage">
            </form>
            <h4 class="mt-3">{{sizeof($posts)}} Post{{sizeof($posts) == 1 ? "":"s"}}</h4>
            <script>
                $('#validatedCustomFile').on('change',function(){
                    //get the file name
                    var fileName = $(this).val();
                    var fileName = fileName.replace('C:\\fakepath\\', " ");
                    //replace the "Choose a file" label
                    $(this).next('.custom-file-label').html(fileName);
                })
            </script>
        </div>
    </div>
    <br>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-user-circle"></i> Profile</a>

        </li>
        <li class="nav-item">
          <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false"><i class="fa fa-cog"></i> Settings</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        @if((isset($_GET['tab']) && $_GET['tab'] != 'settings') || !isset($_GET['tab']))
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @else
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @endif
            <div class="row mt-3" style="margin-left: 1px">
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
                @foreach ($posts as $post)
                @php
                    $user = App\Models\User::where('_id', $post->created_by['id'])->first();
                @endphp
                @include('post.posts')
                @endforeach
            </div>

        </div>
        @if(isset($_GET['tab']) && $_GET['tab'] == 'settings')
            <div class="tab-pane fade show active" id="settings" role="tabpanel" aria-labelledby="settings-tab" aria-selected="true">
        @else
                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
        @endif
            <div class="row">
                <div class="col-md-5 card mt-3 ml-5">
                    @if(Session::has('error'))
                        <div class="alert alert-danger mt-2" role="alert">
                                {{Session::get('error')}}
                        </div>
                    @endif
                    @if(Session::has('success'))
                    <div class="alert alert-success mt-2" role="alert">
                            {{Session::get('success')}}
                    </div>
                    @endif
                    <form method="POST" class="mt-3">
                        @csrf
                        <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter your name" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{$user->email}}">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <input type="password" name="currentPassword" class="form-control col ml-3" id="password" aria-describedby="emailHelp" placeholder="Enter current password">
                            <button type="submit" class="btn btn-primary col-md-3 ml-2 mr-2" name="changeInformations">Submit</button>
                        </div>

                    </form>
                </div>
                <div class="col-md-5 card mt-3 ml-5">
                    @if(Session::has('error1'))
                        <div class="alert alert-danger mt-2" role="alert">
                                {{Session::get('error1')}}
                        </div>
                    @endif
                    @if(Session::has('success1'))
                    <div class="alert alert-success mt-2" role="alert">
                            {{Session::get('success1')}}
                    </div>
                    @endif
                    <form method="POST" class="mt-3">
                        @csrf
                        <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" class="form-control" id="new_password" aria-describedby="emailHelp" placeholder="Enter new password">
                        </div>
                        <div class="form-group" style="margin-bottom: 40px;">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="new_password_confirm" class="form-control" id="confirm_password" aria-describedby="emailHelp" placeholder="Re-type password">
                        </div>
                        <hr>
                        <div class="form-group row">
                            <input type="password" name="currentPassword" class="form-control col ml-3" id="currentPassword" aria-describedby="emailHelp" placeholder="Enter current password">
                            <button type="submit" class="btn btn-primary col-md-3 ml-2 mr-2" name="changePassword">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
      </div>

</div>
@endsection
