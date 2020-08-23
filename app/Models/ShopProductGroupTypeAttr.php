<?php

namespace App;

namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;

class ShopProductGroupTypeAttr extends Model
{
    public $table      = SC_DB_PREFIX.'shop_product_group_type_attr';
    protected $guarded = [];

    protected static $getList = null;

    public static function getList()
    {
        if (!self::$getList) {
            self::$getList = self::pluck('name', 'id')->all();
        }
        return self::$getList;
    }

    public static function getListID($id)
    {
        if (!self::$getList) {
            self::$getList = self::where('type_id',$id)->pluck('name', 'id')->all();
        }
        return self::$getList;
    }
//    public function type()
//    {
//        return $this->belongsToMany(ShopProductType::class, 'shop_product_type', 'id');
//    }
//
    public function productsAttr(){
        return $this->hasMany(ShopProductTypeAttr::class,'group_id','id');
    }


}
