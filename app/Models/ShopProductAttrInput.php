<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopProductAttrInput extends Model

{
    public $timestamps = false;
    public $table      = SC_DB_PREFIX.'shop_product_attr_input';
    protected $guarded = [];
    //
}
