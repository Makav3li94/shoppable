<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShopProductAttrInput;
use App\Models\ShopProductGroupTypeAttr;
use App\Models\ShopProductType;
use App\Models\ShopProductTypeAttr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use Validator;

class ShopProductTypeAttrController extends Controller
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
            'sub_title' => '',
            'icon' => 'fa fa-indent',
            'menu_left' => '',
            'menu_right' => '',
            'menu_sort' => '',
            'script_sort' => '',
            'menu_search' => '',
            'script_search' => '',
            'listTh' => '',
            'dataTr' => '',
            'pagination' => '',
            'result_items' => '',
            'url_delete_item' => '',
        ];

        $listTh = [
            'id' => trans('attribute_group.id'),
            'name' => trans('attribute_group.name'),
            'type' => trans('attribute_group.type'),
            'action' => trans('attribute_group.admin.action'),
        ];

        $obj = new ShopProductTypeAttr;
        $obj = $obj->orderBy('id', 'desc');
        $dataTmp = $obj->paginate(20);

        $dataTr = [];
        foreach ($dataTmp as $key => $row) {
            $dataTr[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'type' => $row['type'],
                'action' => '
                    <a href="' . route('admin_product_type_attrs.edit', ['id' => $row['id']]) . '"><span title="' . trans('attribute_group.admin.edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;

                  <span onclick="deleteItem(' . $row['id'] . ');"  title="' . trans('attribute_group.admin.delete') . '" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>
                  ',
            ];
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['result_items'] = trans('attribute_group.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);

//menu_left
        $data['menu_left'] = '<div class="pull-left">
                      <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs"> ' . trans('attribute_group.admin.refresh') . '</span></a> &nbsp;
                      </div>';
//=menu_left

//menu_right
        $data['menu_right'] = '<div class="btn-group pull-right" style="margin-right: 10px">
                           <a href="' . route('admin_product_type_attrs.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                           <i class="fa fa-plus"></i><span class="hidden-xs">' . trans('attribute_group.admin.add_new') . '</span>
                           </a>
                        </div>';
//=menu_right

        $data['url_delete_item'] = route('admin_product_type_attrs.delete');

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
            'page' => 'create',
            'sub_title' => '',
            'title_description' => trans('attribute_group.admin.add_new_des'),
            'icon' => 'fa fa-plus',
            'obj' => $obj,
            'product_types' => ShopProductType::getList(),
            'group_types' => ShopProductGroupTypeAttr::getList(),
            'url_action' => route('admin_product_type_attrs.create'),
        ];
        return view('admin.screen.product_type_attrs')
            ->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate()
    {

        $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'type_id' => 'required',
            'group_id' => 'required',
            'input_type' => 'required',
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
        !empty($data['searchable']) == '1' ? $search = '1': $search = '0';
        !empty($data['required']) == '1' ? $required = '1': $required = '0';
        $dataInsert = [
            'type_id' => $data['type_id'],
            'group_id' => $data['group_id'],
            'name' => $data['name'],
            'input_type' => $data['input_type'],
            'searchable' => $search,
            'required' => $required,
        ];
        $id = ShopProductTypeAttr::insertGetId($dataInsert);
        if ($data['input_type'] == 'select') {
            foreach (request()->input_type_value as $input_type_value) {
                ShopProductAttrInput::create([
                    'attr_id' => $id,
                    'input' => $input_type_value,
                ]);
            }
        }
        return redirect('shop_admin/product_type/edit/' . $data['type_id'])->with('success', trans('attribute_group.admin.create_success'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ShopProductTypeAttr $shopProductTypeAttr
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obj = ShopProductTypeAttr::where('attr_id',$id)->first();
        $attrGroup = $obj->groupAttr->name;
        if ($obj === null) {
            return 'no data';
        }
        $htmlProductAtrribute = '<tr><td><br><input type="text" name="attribute[attribute_group][]" value="attribute_value" class="form-control input-sm" placeholder="' . trans('product.admin.add_attribute_place') . '" /></td><td><br><span title="Remove" class="btn btn-flat btn-sm btn-danger removeAttribute"><i class="fa fa-times"></i></span></td></tr>';
        $data = [
            'title' => trans('attribute_group.admin.edit'),
            'page' => 'edit',
            'sub_title' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'obj' => $obj,
            'attrGroup' => $attrGroup,
            'htmlProductAtrribute' => $htmlProductAtrribute,
            'product_types' => ShopProductType::getList(),
            'url_action' => route('admin_product_type_attrs.edit', ['id' => $obj['id']]),
        ];
        return view('admin.screen.product_type_attrs')
            ->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ShopProductTypeAttr $shopProductTypeAttr
     * @return \Illuminate\Http\Response
     */
    public function postEdit($id)
    {

        $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'type_id' => 'required',
            'group_id' => 'required',
            'name' => 'required',
            'input_type' => 'required',
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
        !empty($data['searchable']) == '1' ? $search = '1': $search = '0';
        !empty($data['required']) == '1' ? $required = '1': $required = '0';

        $dataUpdate = [
            'type_id' => $data['type_id'],
            'group_id' => $data['group_id'],
            'name' => $data['name'],
            'input_type' => $data['input_type'],
            'searchable' => $search,
            'required' => $required,
        ];

        if ($data['input_type'] == 'select') {

            $attr_inputs = ShopProductAttrInput::where('attr_id', $id)->delete();
//            $attr_inputs = ShopProductAttrInput::whereIn('id', request()->input_attr_id)->get();
//            if ($attr_inputs) {
//                foreach ($attr_inputs as $attr_input)
//                    $attr_input->delete();
//                }
//            $input_type_values = array_combine(request()->input_attr_id, array_filter(request()->input_type_value));
//            if (request()->input_type_value != 'null') {
//                foreach ($input_type_values as $key => $input_type_value) {
//                    $attr_input = ShopProductAttrInput::where([['id', $key], ['attr_id', $id]])->first();
//                    $attr_input->update([
//                        'input' => $input_type_value,
//                    ]);
//                }
//            }

            if ($data['input_type'] == 'select') {
                foreach (array_filter(request()->input_type_value) as $input_type_value) {
                    ShopProductAttrInput::create([
                        'attr_id' => $id,
                        'input' => $input_type_value,
                    ]);
                }
            }
        }

        $obj = ShopProductTypeAttr::where('id',$id)->update($dataUpdate);
//        DB::enableQueryLog();
//        $obj->update($dataUpdate);
//        dd(DB::getQueryLog());

//
        return redirect('shop_admin/product_type/edit/' . $data['type_id'])->with('success', trans('attribute_group.admin.edit_success'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ShopProductTypeAttr $shopProductTypeAttr
     * @return \Illuminate\Http\Response
     */
    public function deleteList()
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');
            $arrID = explode(',', $ids);
            ShopProductTypeAttr::where('attr_id',$arrID)->delete($arrID);
            return response()->json(['error' => 0, 'msg' => '']);
        }
    }


    public function getGroupAjax()
    {
        $typeId = request()->type_id;
        return ShopProductGroupTypeAttr::getListID($typeId);
    }

    public function getAttrAjax()
    {
        $attrId = request()->attr_id;
        return ShopProductTypeAttr::where('id',$attrId)->first();
    }


}
