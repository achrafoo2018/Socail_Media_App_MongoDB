@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Comment Section</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <img src="{{asset('storage/' . $post->image)}}" alt="" width="343" height="400" class="mb-2">
                        </div>
                        <div class="col">
                            <div class="" style="width:700px;">
                                <h3>{{$post->title}}</h3>
                                <p>{{$post->content}}</p>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="card-footer">
                    @for ($i=0; $i<sizeof($comments);$i++)                            
                            <div>
                                {{$comments[$i]['content']}}
                            </div>
                            <div>
                                {{$comments[$i]['user']['name']}}
                            </div>
                            @endfor

                    <div>
                        <form action="{{route('comment.create',$post->_id)}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" name="content" id="" cols="30" rows="5"></textarea>
                            </div>
                            <button class="btn btn-warning float-right">Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
