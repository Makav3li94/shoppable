<?php

namespace App;

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ShopProductAttributeValue extends Model
{
    public $timestamps = false;
    public $table      = SC_DB_PREFIX.'shop_product_attr_input_value';
    protected $guarded = [];
}
