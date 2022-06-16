<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;
use Image;
use App\Models\Multipic;
use Illuminate\Support\Facades\Auth;


class BrandController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
      }

    public function AllBrand(){
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index',compact('brands'));
    }



    public function StoreBrand(Request $request){
        $validateData = $request -> validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png'
        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_name.min' => 'Brand Longer then 4 Characters',
        ]);

     
        $brand_image = $request->file('brand_image');
     /*
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $name_gen = hexdec(uniqid());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/brand/';
        $brand_image->move($up_location,$img_name);
        $last_img = $up_location.$img_name;
     */


     $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
     Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

      $last_img = 'image/brand/'.$name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(

            'message' => 'Brand Inserted Successsfully',
            'alert-type' => 'success',
        );

       // return Redirect()->back()->with('success','Brand Inserted Successsfully');
       return Redirect()->back()->with($notification);




    }


    public function Edit($id){

        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }





    public function Update(Request $request, $id){
        $validateData = $request -> validate([
            'brand_name' => 'required|min:4',
        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_name.min' => 'Brand Longer then 4 Characters',
        ]);


        $old_image = $request -> old_image;
        $brand_image = $request->file('brand_image');


        // الفكرة الان لو انا ما عدلت الصورة اذا حيشيل الصورة القديمة وحتنشال الصورة وحيديني erorr
        if($brand_image){

            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $name_gen = hexdec(uniqid());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/brand/';
            $brand_image->move($up_location,$img_name);
            $last_img = $up_location.$img_name;
    
    
            unlink($old_image);
            Brand::find($id) -> update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now()
            ]);
    
            $notification = array(

                'message' => 'Brand Updated Successsfully',
                'alert-type' => 'info',
            );

            return Redirect()->back()->with($notification);

          //  return Redirect()->back()->with('success','Brand Updated Successsfully');


        }else{
            Brand::find($id) -> update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);

            $notification = array(

                'message' => '(Brand Name Updated) ! Successsfully',
                'alert-type' => 'warning',
            );

            return Redirect()->back()->with($notification);

       //     return Redirect()->back()->with('success','Brand Updated Successsfully');

        }


    }

    public function Delete($id){

       $old_image = Brand::find($id)->brand_image;
        unlink($old_image);
        
       Brand::find($id)->delete();

       $notification = array(
        'message' => 'Brand Deleted Successsfully',
        'alert-type' => 'error',
       );

      return Redirect()->back()->with($notification);

      //  return Redirect()->back()->with('success','Brand Deleted Successsfully');
    }




    ////////// This is for Multi Image All Methods

    public function Multpic(){
        $images = Multipic::all();
        return view('admin.multipic.index',compact('images'));
    }


    public function StoreImage(Request $request){


        $image = $request -> file('image');

     
    foreach($image as $multi_img){ // السبب انو عندي مجموعة صور وكل صورة بدو يتعامل معها لحال ويرجعها 

     $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
     Image::make($multi_img)->resize(300,300)->save('image/multi/'.$name_gen);

      $last_img = 'image/multi/'.$name_gen;

      Multipic::insert([
            'image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

    } // end of the foreach 
        return Redirect()->back()->with('success','Image Inserted Successsfully');

    }



    // New Admin Dashboard

    public function Logout(){
        Auth::logout();
        return Redirect()->route('login')->with('Success','User Logout');
    }



}
