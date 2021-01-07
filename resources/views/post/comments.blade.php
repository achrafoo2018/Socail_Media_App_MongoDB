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
                            <div class="" style="width:600px;">
                                <h3>{{$post->title}}</h3>
                                <p>{{$post->content}}</p>
                            </div>
                        </div>
                    </div>                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
