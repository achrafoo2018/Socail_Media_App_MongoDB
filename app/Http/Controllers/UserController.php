<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(){
    	return view('profile', array('user' => \Auth::user()) );
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
