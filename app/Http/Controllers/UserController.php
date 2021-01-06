<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(){
    	return view('profile', array('user' => \Auth::user(), 'posts'=>Post::where("created_by", \Auth::user()->_id)->get()) );
    }
    public function update_avatar(Request $request){
        $user =  \Auth::user();
    	// Handle the user upload of avatar
    	if($request->hasFile('avatar')){
            $user->image = $request->avatar->store('upload', 'public');
    		$user->save();
    	}

    	return \redirect()->route('profile');

    }
}
