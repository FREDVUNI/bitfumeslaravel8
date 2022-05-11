<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function profile(){
        request()->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);
        $file = request()->file("image");
        $image = md5(microtime()).".".$file->getClientOriginalExtension();
        $file->move(public_path('/profile'),$image);
        $user = User::Findorfail(1);

        $path = public_path("profile/");
        if($user->avatar != "" || $user->avatar != NULL):
            $old = $path.$user->avatar;
            unlink($old);
        endif;

        $data = ['avatar' => $image];
        //dd($data);
        $user->update($data);
        return redirect('/home')->with('status','image has been updated.');   
    }
}
