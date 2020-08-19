<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopGuarantee extends Model
{
    public $incrementing  = false;
    public $timestamps    = false;
    public $table = SC_DB_PREFIX.'shop_guarantees';
    protected $connection = SC_CONNECTION;
    protected $guarded    = [];
    private static $getList = null;
    public static function getList()
    {
        if (self::$getList == null) {
            self::$getList = self::get()->keyBy('id');
        }
        return self::$getList;
    }

    public function products()
    {
        return $this->hasMany(ShopProduct::class, 'guarantee_id', 'id');
    }


}
