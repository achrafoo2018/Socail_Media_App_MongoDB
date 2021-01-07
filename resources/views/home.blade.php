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
    <div class="row ml-3">
        @foreach ($posts as $post)
        @php
            $user = App\Models\User::where('_id', $post->created_by['id'])->first();
        @endphp
        @include('post.posts')
        @endforeach
    </div>
</div>
@endsection
