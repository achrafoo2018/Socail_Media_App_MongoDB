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
<div class="card mr-4 mb-5" style="width: 21rem;">
    <div class="card-header">
            <img href="{{route('profile').'?_id='.$user->_id}}" src="{{asset('storage/'.$user->image)}}" style="width:50px; height:50px; border-radius:50%;position:relative;bottom:15px;right:4px;" alt="profile picture">
        <span class="mt-1" style="display: inline-block;width:55%">
            <a href="{{route('profile').'?_id='.$user->_id}}"><b>{{$user->name}}</b></a><br>
            <small class="form-text text-muted" style="display: inline-block">
                <a href="{{ route('comment', $post->_id) }}" class="text-muted">{{timeago($post->created_at)}}</a>
            </small>
        </span>
        @if($user->_id == \Auth::user()->_id)
            <div class="dropdown div_{{$post->_id}} float-right mt-2">
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
        <div class="d-inline position-relative" style="left:10px;">
            <a href="{{ route('comment', $post->_id) }}" class="btn btn-counter btn-warning" data-count="{{sizeof($post->comments)}}"><i class="fa fa-comments mr-2"></i><span style="font-family: Arial, Helvetica, sans-serif">Comment</span></a>
          </div>
          <div class="d-inline float-left position-relative" style="right:5px;">
            <a href="{{ route('like', $post->_id) }}?route={{\Route::current()->getName()}}" title="Like" id="btn-counter" class="like_button_{{$post->_id}} btn btn-{{in_array(\Auth::user()->_id, $post->likes) ? "primary":"outline-primary"}}" data-count="{{sizeof($post->likes)}}"><i class="fa fa-thumbs-up mr-2"></i><span style="font-family: Arial, Helvetica, sans-serif">Like</span></a>
          </div>
    </div>
</div>
<script>
    $('.like_button_{{$post->_id}}').click(function(e) {
        var url = "{{route('like', $post->_id)}}";
        var form = $('.div_{{$post->_id}}');
        $.ajax({
            type:'GET',
            url:url,
            success:function(response){
                console.log('success')
                if($('.like_button_{{$post->_id}}').hasClass('btn-outline-primary')){
                $('.like_button_{{$post->_id}}').addClass('btn-primary').removeClass('btn-outline-primary');
                $('.like_button_{{$post->_id}}').attr('data-count',response.likes)
                }
                else{
                $('.like_button_{{$post->_id}}').addClass('btn-outline-primary').removeClass('btn-primary');
                $('.like_button_{{$post->_id}}').attr('data-count',response.likes);
                }
                // .replace( /(?:^|\s)btn-outline-primary(?!\S)/g , 'btn-primary' )
            },
            error: function(response){
                console.log('error')
            }
        });
        e.preventDefault();

    });
    </script>
        @endforeach

