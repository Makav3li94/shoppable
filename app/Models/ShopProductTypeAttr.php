<?php

#app/Models/ShopProductAttribute.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\Model;

class ShopProductTypeAttr extends Model
{
    public $table      = SC_DB_PREFIX.'shop_product_type_attr';
    protected $guarded = [];

    public function productType(){
        return $this->belongsTo(ShopProductType::class);
    }

    public function groupAttr(){
        return $this->belongsTo(ShopProductGroupTypeAttr::class,'group_id','id');
    }

    public function productsAttrValues(){
        return $this->hasOne(ShopProductAttributeValue::class,'attr_id','id');
    }

}
