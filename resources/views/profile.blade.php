@extends('layouts.app')

@section('content')
<div class="container">
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
                <input type="submit" class="pull-right btn btn-primary" value="Submit">
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
          <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>

        </li>
        <li class="nav-item">
          <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        @if((isset($_GET['tab']) && $_GET['tab'] != 'settings') || !isset($_GET['tab']))
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @else
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @endif
            <div class="row mt-3" style="margin-left: 1px">
                @foreach ($posts as $post)
                @php
                    $user = App\Models\User::where('_id', $post->created_by["id"])->first();
                @endphp
                <div class="card mr-5 mb-5" style="width: 20rem;">
                    <div class="mt-2 col-md-12">
                        <img src="{{asset('storage/'.$user->image)}}" style="width:50px; height:50px; border-radius:50%;" alt="profile picture">
                        <b>{{$user->name}}</b>
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
                      <a class="btn btn-{{in_array(\Auth::user()->_id, $post->likes) ? "success":"primary"}}" href="{{ route('like', $post->_id) }}?route=profile"><span class="font-weight-bold mr-2">{{sizeof($post->likes)}} </span><i class="fa fa-thumbs-up"> Like</i> </a>

                    </div>
                </div>
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
                    <form method="POST">
                        @csrf
                        <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter your name" value="">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="col-md-5 card mt-3 ml-5">

                    <form>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
            </div>
        </div>
      </div>

</div>
@endsection
