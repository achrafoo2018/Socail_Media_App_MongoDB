<div class="card mr-4 mb-5" style="width: 21rem;">
    <div class="card-header">
            <img src="{{asset('storage/'.$user->image)}}" style="width:50px; height:50px; border-radius:50%;position:relative;bottom:15px;right:4px;" alt="profile picture">
        <span class="mt-1" style="display: inline-block;width:55%">
            <b>{{$user->name}}</b><br>
            <small class="form-text text-muted" style="display: inline-block">
                {{$post->created_at->toDateString()}}
            </small>
        </span>
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
    <hr class="mt-0">
    <h5 class="card-title text-center">{{$post->title}}</h5>
    <img class="card-img-top" width="18rem" height="320rem" src="{{asset('storage/'.$post->image)}}" alt="Card image cap">
    <div class="card-body">
      <p class="card-text">{{$post->content}}</p>
    </div>
    <div class="card-footer">
        <div class="d-inline position-relative" style="right:10px;">
            <a href="{{ route('comment', $post->_id) }}" class="btn btn-counter btn-warning"><i class="fa fa-comments mr-2"></i><span style="font-family: Arial, Helvetica, sans-serif">Comment</span></a>
          </div>
          <div class="d-inline float-right position-relative" style="left:5px;">
            <a href="{{ route('like', $post->_id) }}?route={{\Route::current()->getName()}}" title="Like" id="btn-counter" class="btn btn-{{in_array(\Auth::user()->_id, $post->likes) ? "primary":"outline-primary"}}" data-count="{{sizeof($post->likes)}}"><i class="fa fa-thumbs-up mr-2"></i><span style="font-family: Arial, Helvetica, sans-serif">Like</span></a>
          </div>
    </div>
</div>
