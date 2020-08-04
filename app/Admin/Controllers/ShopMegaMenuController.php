<?php

namespace App\Admin\Controllers;
use App\Http\Controllers\Controller;
use App\Models\ShopMegaMenu;
use Illuminate\Support\Facades\Validator;

class ShopMegaMenuController extends Controller
{
    public function index()
    {

        $data = [
            'title' => trans('menu.admin.list'),
            'sub_title' => '',
            'icon' => 'fa fa-indent',
            'menu' => [],
            'treeMenu' => (new ShopMegaMenu())->getTree(),
            'url_action' => route('admin_mega_menu.create'),
            'url_delete_item' => route('admin_mega_menu.delete'),
            'title_form' => '<i class="fa fa-floppy-o" aria-hidden="true"></i> ' . trans('menu.admin.create'),
        ];
        return view('admin.screen.list-mega-menu')
            ->with($data);
    }

    public function postCreate()
    {
      return  $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataInsert = [
            'title' => $data['title'],
            'parent_id' => $data['parent_id'],
            'url' => $data['url'],
            'icon' => $data['icon'],
            'sort' => $data['sort'],
            'block' => $data['block'],
        ];

        $menu = ShopMegaMenu::createMenu($dataInsert);

        return redirect()->route('admin_mega_menu.index')->with('success', trans('menu.admin.create_success'));

    }

    public function edit($id)
    {
        $menu = ShopMegaMenu::find($id);
        if ($menu === null) {
            return 'no data';
        }
        $data = [
            'title' => trans('menu.admin.list'),
            'sub_title' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'menu' => $menu,
            'treeMenu' => (new ShopMegaMenu)->getTree(),
            'url_action' => route('admin_mega_menu.edit', ['id' => $menu['id']]),
            'title_form' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> ' . trans('menu.admin.edit'),
        ];
        $data['url_delete_item'] = route('admin_mega_menu.delete');
        return view('admin.screen.list-mega-menu')
            ->with($data);
    }

    public function postEdit($id)
    {
        $menu = ShopMegaMenu::find($id);
        $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
//Edit

        $dataUpdate = [
            'title' => $data['title'],
            'parent_id' => $data['parent_id'],
            'url' => $data['url'],
            'icon' => $data['icon'],
            'sort' => $data['sort'],
            'block' => $data['block'],
        ];

        ShopMegaMenu::updateInfo($dataUpdate, $id);
        $permissions = $data['permissions'] ?? [];

//
        return redirect()->route('admin_mega_menu.index')->with('success', trans('menu.admin.edit_success'));

    }


    public function deleteList()
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $id = request('id');
            $check = ShopMegaMenu::where('parent_id', $id)->count();
            if ($check) {
                return response()->json(['error' => 1, 'msg' => trans('menu.admin.error_have_child')]);
            } else {
                ShopMegaMenu::destroy($id);
            }
            return response()->json(['error' => 0, 'msg' => '']);
        }
    }


    public function updateSort()
    {
        $data = request('menu') ?? [];
        $reSort = json_decode($data, true);
        $newTree = [];
        foreach ($reSort as $key => $level_1) {
            $newTree[$level_1['id']] = [
                'parent_id' => 0,
                'sort' => ++$key,
            ];
            if (!empty($level_1['children'])) {
                $list_level_2 = $level_1['children'];
                foreach ($list_level_2 as $key => $level_2) {
                    $newTree[$level_2['id']] = [
                        'parent_id' => $level_1['id'],
                        'sort' => ++$key,
                    ];
                    if (!empty($level_2['children'])) {
                        $list_level_3 = $level_2['children'];
                        foreach ($list_level_3 as $key => $level_3) {
                            $newTree[$level_3['id']] = [
                                'parent_id' => $level_2['id'],
                                'sort' => ++$key,
                            ];
                        }
                    }
                }
            }
        }
        $response = (new ShopMegaMenu)->reSort($newTree);
        return $response;
    }
}
