@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Post Form</div>

                <div class="card-body">
                    @if ($post)

                    <form action="{{route('post.update', $post->_id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Title:</label>
                            <input type="text" class="form-control" name="title" value="{{$post->title}}">
                        </div>
                        <div class="form-group">
                            <label for="">Content:</label>
                            <textarea type="text" class="form-control" name="content">{{$post->content}}</textarea>
                        </div>
                        <button class="btn btn-primary">Save</button>
                    </form>

                    @else

                    <form action="{{route('post.create')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Title:</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label for="">Content:</label>
                            <textarea type="text" class="form-control" name="content"></textarea>
                        </div>
                        <button class="btn btn-primary">Save</button>
                    </form>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
