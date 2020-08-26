<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class ShopProductAttrRelate extends Model
{
    public $timestamps = false;
    public $table      = SC_DB_PREFIX.'shop_product_attr_relate';
    protected $guarded = [];
}
