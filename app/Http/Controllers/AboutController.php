<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\HomeAbout;
use Illuminate\Support\Carbon;
use App\Models\Multipic;




class AboutController extends Controller
{


    public function HomeAbout(){

        $homeabout = HomeAbout::latest()->get();
        return view('admin.home.index',compact('homeabout'));
    }

    public function AddAbout(){
        return view('admin.home.create');
    }

    public function StoreAbout(Request $request){


        HomeAbout::insert([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'long_dis' => $request->long_dis,
            'created_at' => Carbon::now(),

        ]);

        return Redirect()->route('home.about')->with('success','Home About Inserted Successsfully');

    }

    public function EditAbout($id){
        $homeabout = HomeAbout::find($id);
        return view('admin.home.edit',compact('homeabout'));
    }



    public function UpdateAbout(Request $request, $id){
        
     $update = HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'long_dis' => $request->long_dis,

        ]);

        return Redirect()->route('home.about')->with('success','Home About Updated Successsfully');
    }


    public function DeleteAbout($id){

      $delete = HomeAbout::find($id)->Delete();
        return Redirect()->back()->with('success','Home About Deleted Successsfully');


    }

    public function Portfolio(){
        $portfolio = Multipic::all();
        return view('pages.portfolio',compact('portfolio'));
    }



}
