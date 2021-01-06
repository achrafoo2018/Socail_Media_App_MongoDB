@extends('layouts.app')

@section('content')
<style>
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Created By</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Action</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                
                          <tr>
                            <td>{{$post->_id}}</td>
                            <td>{{$post->title}}</td>
                            <td><div style="width: 250px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{{$post->content}}</div></td>
                            <td>{{$post->created_by}}</td>
                            <td>{{$post->created_at}}</td>
                            <td>{{$post->updated_at}}</td>
                            <td>
                                <a href="{{route('post.form',$post->_id)}}" class="btn btn-warning btn-sm">Update</a>
                            </td>
                            <td>
                              <a href="{{route('post.delete', $post->_id)}}" onclick="return confirm('Are you sure you want to delete this post?');" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                          </tr>

                          @endforeach
                        </tbody>
                      </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
