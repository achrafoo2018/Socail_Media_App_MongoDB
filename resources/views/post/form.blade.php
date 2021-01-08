@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if ($post && $post->created_by['id'] == \Auth::user()->_id)
                        Edit Post
                    @else
                        New Post
                    @endif
                </div>

                <div class="card-body">
                    @if ($post && $post->created_by['id'] == \Auth::user()->_id)

                    <form action="{{route('post.update', $post->_id)}}" method="POST" enctype="multipart/form-data">
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
                        <div class="form-group">
                            <img src="{{asset('storage/' . $post->image)}}" alt="" height="250" class="mb-2">
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="validatedCustomFile">
                                <label class="custom-file-label" for="validatedCustomFile">Choose image...</label>
                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                            </div>                        </div>
                        <button class="btn btn-success btn-block" style="font-size: 108%;"><i class="fa fa-save"></i> Save</button>
                    </form>

                    @else

                    <form action="{{route('post.create')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Title:</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label for="">Content:</label>
                            <textarea type="text" class="form-control" name="content"></textarea>
                        </div>
                        <div class="form-group mt-4">
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="validatedCustomFile" required>
                                <label class="custom-file-label" for="validatedCustomFile">Choose image...</label>
                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                            </div>                        </div>
                        <button class="btn btn-primary btn-block mt-4"> POST</button>
                    </form>

                    @endif
                </div>
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
    </div>
</div>
@endsection
