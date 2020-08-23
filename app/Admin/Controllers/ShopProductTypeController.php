<?php

namespace App\Admin\Controllers;
use App\Http\Controllers\Controller;
use App\Models\ShopProductAttrInput;
use App\Models\ShopProductGroupTypeAttr;
use App\Models\ShopProductType;
use Illuminate\Http\Request;
use Validator;
class ShopProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [
            'title' => trans('attribute_group.admin.list'),
            'icon' => 'fa fa-indent',
            'subTitle' => '',
            'urlDeleteItem' => '',
            'removeList' => 0, // 1 - Enable function delete list item
            'buttonRefresh' => 0, // 1 - Enable button refresh
            'buttonSort' => 1, // 1 - Enable button sort
            'css' => '',
            'js' => '',
        ];

        $listTh = [
            'id' => trans('attribute_group.id'),
            'name' => trans('attribute_group.name'),
            'type' => trans('attribute_group.type'),
            'action' => trans('attribute_group.admin.action'),
        ];

        $obj = new ShopProductType;
        $obj = $obj->orderBy('id', 'desc');
        $dataTmp = $obj->paginate(20);

        $dataTr = [];
        foreach ($dataTmp as $key => $row) {
            $dataTr[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'type' => $row['type'],
                'action' => '
                    <a href="' . route('admin_product_type.edit', ['id' => $row['id']]) . '"><span title="' . trans('attribute_group.admin.edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;

                  <span onclick="deleteItem(' . $row['id'] . ');"  title="' . trans('attribute_group.admin.delete') . '" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>
                  ',
            ];
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['resultItems'] = trans('attribute_group.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);

//menu_left
        $data['menuLeft'][] = '<div class="pull-left">
                      <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs"> ' . trans('attribute_group.admin.refresh') . '</span></a> &nbsp;
                      </div>';
//=menu_left

//menu_right
        $data['menuRight'][] = '<div class="btn-group pull-right" style="margin-right: 10px">
                           <a href="' . route('admin_product_type.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                           <i class="fa fa-plus"></i><span class="hidden-xs">' . trans('attribute_group.admin.add_new') . '</span>
                           </a>
                        </div>';
//=menu_right

        $data['urlDeleteItem'] = route('admin_product_type.delete');

        return view('admin.screen.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $obj = [];
        $data = [
            'title' => trans('attribute_group.admin.add_new_title'),
            'sub_title' => '',
            'title_description' => trans('attribute_group.admin.add_new_des'),
            'icon' => 'fa fa-plus',
            'obj' => $obj,

            'url_action' => route('admin_product_type.create'),
        ];

        return view('admin.screen.product_type')
            ->with($data);
    }

    public function postCreate()
    {
        $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'name' => 'required',
        ], [
            'name.required' => trans('validation.required'),
        ]);

        if ($validator->fails()) {
            // dd($validator->messages());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
//Create new order
        $dataInsert = [
            'name' => $data['name'],
        ];
        ShopProductType::create($dataInsert);
//
        return redirect()->route('admin_product_type.index')->with('success', trans('attribute_group.admin.create_success'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShopProductType  $shopProductType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $obj = ShopProductType::find($id);

        if ($obj === null) {
            return 'no data';
        }
        $groups = ShopProductGroupTypeAttr::select('id','type_id','name')->where('type_id',$id)->get();
        $data = [
            'title' => trans('attribute_group.admin.edit'),
            'sub_title' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'obj' => $obj,
            'groups' => $groups,
            'product_types'=>ShopProductType::getList(),
            'url_action' => route('admin_product_type.edit', ['id' => $obj['id']]),
        ];
        return view('admin.screen.product_type')
            ->with($data);
    }

    public function postEdit($id)
    {
        $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'name' => 'required',
        ], [
            'name.required' => trans('validation.required'),
        ]);

        if ($validator->fails()) {
            // dd($validator->messages());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
//Edit
        $dataUpdate = [
            'name' => $data['name'],
        ];
        $obj = ShopProductType::find($id);
        $obj->update($dataUpdate);
//
        return redirect()->route('admin_product_type.index')->with('success', trans('attribute_group.admin.edit_success'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShopProductType  $shopProductType
     * @return \Illuminate\Http\Response
     */
    public function deleteList()
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');
            $arrID = explode(',', $ids);
//            $a = ShopProductType::find($arrID);
//            $a->typeGroup->delete();
            ShopProductType::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => '']);
        }
    }
    public function getGroup(){
        $group = ShopProductGroupTypeAttr::find(request()->groupID);
        return $group ;
    }

    public function getInput(){
        return ShopProductAttrInput::where('attr_id',request()->attr_id)->get();
    }
}
