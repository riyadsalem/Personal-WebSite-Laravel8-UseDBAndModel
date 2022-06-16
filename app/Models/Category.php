<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    // الفكرة وهي انه لا يتم حذف بشكل كامل من ال DB بل يتم وضع متغير وهو deleted_at ويشير لتاريخ الحذف
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_name',
    ];

   
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
        // user_id >> in categories table
        // id >> in users table 
    }
    
    
}
