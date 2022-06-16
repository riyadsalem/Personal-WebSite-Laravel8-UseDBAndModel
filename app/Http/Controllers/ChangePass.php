<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;


class ChangePass extends Controller
{

    
  public function __construct(){
    $this->middleware('auth');
  }


    public function CPassword(){
        return view('admin.body.change_password');
    }

    public function UpdatePassword(Request $request){

        $validateData = $request->validate([
            'oldPassword' => 'required',
            'password' => 'required|confirmed' // الفكرة هنا من confirmed هي انو اخد كلمة المرور مؤكدة وتم مطابقتها 
        ]);


        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldPassword, $hashedPassword)){

            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success','Password Is Change Successfully');    

        }else{
            return redirect()->back()->with('error','Current Password Is Invalid');    

        }
    }


    public function PUpdate(){
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            if($user){
                return view('admin.body.update_profile',compact('user'));
            }
        }
    }

    public function UpdateProfile(Request $request){

        $user = User::find(Auth::user()->id);
        if($user){
            $user->name = $request['name'];
            $user->email = $request['email'];

            $user->save();
            return Redirect()->back()->with('success','User Preofile Is Updated Successfully');    
        }else{
            return redirect()->back();
        }


    }
}
