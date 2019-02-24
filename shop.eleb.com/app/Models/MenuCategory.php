<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $fillable=['name','type_accumulation','shop_id','description','is_selected'];
    //
    public function shopUser(){   //shop.shop_category_id ===shopCategory.id
        return $this->belongsTo(ShopUser::class,'shop_id');
    }
}
