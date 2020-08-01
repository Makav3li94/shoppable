<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ModelTrait;

class ShopAd extends Model
{
    use ModelTrait;
    public $table = 'pa_shop_ads';
    protected $guarded = [];

    public function descriptions()
    {
        return $this->hasMany(ShopAdDescription::class, 'ad_id', 'id');
    }


    public function getDetail( $status = 1)
    {
        $tableDescription = (new ShopAd())->getTable();
       return $ads = $this
            ->leftJoin($tableDescription, $tableDescription . '.ad_id', $this->getTable() . '.id')
            ->where($tableDescription . '.lang', app()->getLocale());
    }
}
