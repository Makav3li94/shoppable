<?php

#app/Models/ShopProductAttribute.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\Model;

class ShopProductType extends Model
{
    public $table = SC_DB_PREFIX.'shop_product_type';
    protected $guarded = [];
    protected static $getList = null;

    public static function getList()
    {
        if (!self::$getList) {
            self::$getList = self::pluck('name', 'id')->all();
        }
        return self::$getList;
    }

    public function typeGroup()
    {
        return $this->hasMany(ShopProductGroupTypeAttr::class, 'type_id', 'id');
    }

    public function products(){
        return $this->belongsToMany(ShopProduct::class,SC_DB_PREFIX.'shop_product_type','id');
    }
}
