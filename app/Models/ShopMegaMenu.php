<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopMegaMenu extends Model
{
    public $table = SC_DB_PREFIX . 'shop_mega_menus';
    public $timestamps = false;
    protected $guarded = [];
    private static $getList = null;

    public static function getList()
    {
        if (self::$getList == null) {
            self::$getList = self::orderBy('sort', 'asc')->orderBy('block', 'asc')->get()->groupBy('parent_id');
        }
        return self::$getList;
    }

    public function getTree($parent = 0, &$tree = null, $menus = null, &$st = '')
    {
        $menus = $menus ?? $this->getList();
        $tree = $tree ?? [];
        $lisMenu = $menus[$parent] ?? [];
        foreach ($lisMenu as $menu) {
            $tree[$menu->id] = $st . ' ' . sc_language_render($menu->title);
            if (!empty($menus[$menu->id])) {
                $st .= '--';
                $this->getTree($menu->id, $tree, $menus, $st);
                $st = '';
            }
        }

        return $tree;
    }

    public function reSort(array $data)
    {
        try {
            DB::connection('mysql')->beginTransaction();
            foreach ($data as $key => $menu) {
                $this->where('id', $key)->update($menu);
            }
            DB::connection('mysql')->commit();
            $return = ['error' => 0, 'msg' => ""];
        } catch (\Exception $e) {
            DB::connection('mysql')->rollBack();
            $return = ['error' => 1, 'msg' => $e->getMessage()];
        }
        return $return;
    }

    public static function updateInfo($arrFields, $id)
    {
        return self::where('id', $id)->update($arrFields);
    }

    public static function createMenu($dataInsert)
    {
        $dataUpdate = sc_clean($dataInsert, 'password');
        return self::create($dataUpdate);
    }
}
