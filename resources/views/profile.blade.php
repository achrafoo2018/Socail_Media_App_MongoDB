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
    <hr>
        <div class="row ml-3">
            @include('post.posts')
        </div>

</div>
@endsection
