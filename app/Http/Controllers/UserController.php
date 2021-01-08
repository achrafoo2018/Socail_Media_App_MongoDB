<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile(){
    	return view('profile', array('user' => \Auth::user(), 'posts'=>Post::where("created_by.id", \Auth::user()->_id)->orderByDesc("created_at")->get()) );
    }
    public function updateUser(Request $request){
        if($request->has("changeImage")){
            $user =  \Auth::user();
            // Handle the user upload of avatar
            if($request->hasFile('avatar')){
                $user->image = $request->avatar->store('uploads', 'public');
                $user->save();
            }

            return \redirect()->route('profile');
        }else if($request->has("changeInformations")){
            // $request->validate(["name" => "required",
            //     "email" => "required",
            //     "current_password" => "required"]);
            $user = \Auth::user();
            if(Hash::check($request->currentPassword, $user->password)){
                $user->name = $request->name;
                $user->email = $request->email;
                $user->save();
                $request->session()->flash("success", "Account updated Successfully");
                return redirect(route("profile")."?tab=settings");
            }else{
                $request->session()->flash("error", "Wrong password");
                return redirect(route("profile")."?tab=settings");
            }
        }else if($request->has("changePassword")){
            // $request->validate(["new_password" => "required|confirmed",
            //                     "current_password" => "required"]);
            $user = \Auth::user();
            if(Hash::check($request->currentPassword, $user->password)){
                $user->password = Hash::make($request->new_password);
                $user->save();
                $request->session()->flash("success1", "Account updated Successfully");
                return redirect(route("profile")."?tab=settings");
            }else{
                $request->session()->flash("error1", "Wrong password");
                return redirect(route("profile")."?tab=settings");
            }

        }
    }
}
