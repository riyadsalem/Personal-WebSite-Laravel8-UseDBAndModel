<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{


  public function __construct(){
    $this->middleware('auth');
  }



    public function AllCat(){
       // $categories = Category::all();
     //  $categories = Category::latest()->get(); // برتبهم 
    // $categories =  DB::table('categories')->latest()->get();
      $categories = Category::latest()->paginate(5);
    /*
    $categories =  DB::table('categories')
    ->join('users','categories.user_id','users.id') // بدي اضم ال users table بناء على id,user_id 
    ->select('categories.*','users.name')
    ->latest()->paginate(5);
    */
    $trachCat = Category::onlyTrashed()->latest()->paginate(3);


        return view('admin.category.index',compact('categories','trachCat'));

    }

    public function AddCat(Request $request){
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
            //'body' => 'required',
        ],
        [
            // old message >> The category name field is required.
            'category_name.required' => 'Please Inpout Category Name',
            'category_name.max' => 'Category Less Then 255Chars',

        ]);



// one way 
        Category::insert([
            'category_name' => $request -> category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);



/*
// هي الطريقة الافضل 
// tow way >> بيظهر بيها ال apdate_at
$category = new Category;
$category->category_name = $request -> category_name;
$category->user_id = Auth::user()->id;
$category -> save();
*/

/*
// third way by query Builder
$data = array();
$data['category_name'] = $request -> category_name;
$data['user_id'] = Auth::user()->id;
$data['created_at'] = Carbon::now();
DB::table('categories')->insert($data);
*/

    return Redirect() -> back() -> with('success','Category Inserted Successfull');
              
    }



  public function Edit($id){
    $categories = Category::find($id);
 // $categories = DB::table('categories') -> where('id',$id) -> first();
    return view('admin.category.edit',compact('categories'));
   }


  public function Update(Request $request ,$id){
      
      $update = Category::find($id) -> update([
          // لحالو بعبي حقل ال update_at
        'category_name' => $request -> category_name,
        'user_id' => Auth::user()->id
      ]);
      

      /*
      $data = array();
      $data['category_name'] = $request -> category_name;
      $data['user_id'] = Auth::user()->id;
      DB::table('categories')->where('id',$id)->update($data);
      */

    return Redirect() -> route('all.category') -> with('success','Category Updated Successfull');
  }

  public function SoftDelete($id){

    $delete = Category::find($id)->delete();
    return Redirect() -> back() -> with('success','Category Soft Delete Successfull');

  }

  public function Restore($id){
    $delete = Category::withTrashed()->find($id)->restore();
    return Redirect() -> back() -> with('success','Category Restore Successfull');
  }

  public function Pdelete($id){
    $delete = Category::onlyTrashed()->find($id)->forceDelete();
    return Redirect() -> back() -> with('success','Category Permanently Deleted');
  }


}
