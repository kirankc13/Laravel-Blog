<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\User\Rules\ValidationOldPassword;

class ProfileController extends Controller
{
    public $base_view;
    public $model;

    public function __construct(User $user)
    {
        $this->model = $user;
        $this->base_view = 'user::profile';
    }
    public function MyProfile()
    {
        $activities = Activity::where('causer_id',auth()->user()->id)->orderBy('id','desc')->take(10)->get();
        return view($this->base_view.'.my_profile',compact('activities'));
    }

    public function UpdateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.auth()->user()->id
        ]);
        if($request->hasfile('image')){
            $path = $this->UploadFile('users',$request->file('image'));
        }else{
            $path = auth()->user()->image;
        }
        User::find(auth()->user()->id)->update(['name'=> $request->name,'about' => $request->about,'image' =>  $path,'display_name' => $request->display_name,'username'=>$request->username]);
        return redirect()->back()->with('success','Information Updated Successfully!');
    }

    public function ChangePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new ValidationOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        $user = User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect()->back()->with('success','Password Changed Successfully!');
    }
}
