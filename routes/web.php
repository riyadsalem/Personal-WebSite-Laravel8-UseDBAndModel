<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BrandController;
use App\Models\Brand;
use App\Http\Controllers\HomeController;
use App\Models\Slider;
use App\Http\Controllers\AboutController;
use App\Models\Multipic;
use App\Http\Controllers\ChangePass;










/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   // return view('welcome'); // old 
   $brands = DB::table('brands')->get();
   $abouts = DB::table('home_abouts')->first(); // لازم احط first والسبب انو انا معملتش عندي foreach loop فبدي قمية واحدة تروح وتظهر 
   $images = Multipic::all();

   return view('home',compact('brands','abouts','images'));

});

Route::get('about' , function(){
    //  echo "This is About Page";
      return view('about');
  }); //->middleware('check');
  // http://localhost/laravel8/basic/public/about?check=25 >>> view about page 
  
  /*
  Route::get('/home' , function(){
        echo "This is Home Page";
    });
    */
    
  /*
  Route::get('/contact', function(){
    //  echo "This is Contact Page";
        return view('contact');
  });
  */
  // Route::get('/contact','ContactController@index'); // in larave 6&7
  Route::get('/contact', [ContactController::class, 'index'])->name('con');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

 //   $users = User::all();
// $users = DB::table('users')->get(); 
 // return view('dashboard',compact('users'));
 return view('admin.index');


})->name('dashboard');


// Category Controller
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');
Route::get('category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('category/update/{id}', [CategoryController::class, 'Update']);
Route::get('softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('pdelete/category/{id}', [CategoryController::class, 'Pdelete']);



// For Btrand Route
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);

// Multi Image Route
Route::get('/multi/image', [BrandController::class, 'Multpic'])->name('multi.image');
Route::post('/Multi/add', [BrandController::class, 'StoreImage'])->name('store.image');


// Email Verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


// New Admin Dashboard (Auth)
Route::get('user/logout', [BrandController::class, 'Logout'])->name('user.logout');


/*
// تمت تجربة route جديد ليدل على هذه الصفحة بدلا من ال route الافتراضي وهو login 
Route::get('/logininin', function () {
  return view('auth.login');
})->name('loginininii');
*/

// Admin All Route
// Home Slider
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');

// Home About
Route::get('/home/About', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/About', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/About', [AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}', [AboutController::class, 'EditAbout']);
Route::post('/update/homeabout/{id}', [AboutController::class, 'UpdateAbout']);
Route::get('/about/delete/{id}', [AboutController::class, 'DeleteAbout']);


// Home Portofolio >>>>> // Multi Image Route

// Portfolio Page Route
Route::get('/portfolio', [AboutController::class, 'Portfolio'])->name('portfolio');



// Admin Contact Page Route
Route::get('/admin/contact', [ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('/admin/add/contact', [ContactController::class, 'AdminAddContact'])->name('add.contact');
Route::post('/admin/store/contact', [ContactController::class, 'AdminStoreContact'])->name('store.contact');
Route::get('/admin/message', [ContactController::class, 'AdminMessage'])->name('admin.message');
Route::get('/message/delete/{id}', [ContactController::class, 'DeleteMessage']);


// Home Contact Page Route
Route::get('Home/Contact', [ContactController::class, 'HomeContact'])->name('contact');
Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');


// Change Password and user Protfile Route 
Route::get('user/password', [ChangePass::class, 'CPassword'])->name('change.password');
Route::post('/password/update', [ChangePass::class, 'UpdatePassword'])->name('password.update');


// User Profile
Route::get('user/profile', [ChangePass::class, 'PUpdate'])->name('profile.update');
Route::post('/user/profile/update', [ChangePass::class, 'UpdateProfile'])->name('update.user.profile');


























