<?php

namespace App\Admin\Controllers;
use App\Http\Controllers\Controller;
use App\Models\ShopGuarantee;
use Illuminate\Http\Request;
use Validator;
class ShopGuaranteeController extends Controller
{
    public function index()
    {

        $data = [
            'title' => trans('guarantee.admin.list'),
            'subTitle' => '',
            'icon' => 'fa fa-indent',
            'urlDeleteItem' => route('admin_guarantee.delete'),
            'removeList' => 0, // 1 - Enable function delete list item
            'buttonRefresh' => 0, // 1 - Enable button refresh
            'buttonSort' => 1, // 1 - Enable button sort
            'css' => '',
            'js' => '',
        ];
        //Process add content
        $data['menuRight'] = sc_config_group('menuRight', \Request::route()->getName());
        $data['menuLeft'] = sc_config_group('menuLeft', \Request::route()->getName());
        $data['topMenuRight'] = sc_config_group('topMenuRight', \Request::route()->getName());
        $data['topMenuLeft'] = sc_config_group('topMenuLeft', \Request::route()->getName());
        $data['blockBottom'] = sc_config_group('blockBottom', \Request::route()->getName());

        $listTh = [
            'id' => trans('guarantee.id'),
            'name' => trans('guarantee.name'),
            'action' => trans('guarantee.admin.action'),
        ];

        $sort_order = request('sort_order') ?? 'id_desc';
        $keyword = request('keyword') ?? '';
        $arrSort = [
            'id__desc' => trans('guarantee.admin.sort_order.id_desc'),
            'id__asc' => trans('guarantee.admin.sort_order.id_asc'),
            'name__desc' => trans('guarantee.admin.sort_order.name_desc'),
            'name__asc' => trans('guarantee.admin.sort_order.name_asc'),
        ];
        $obj = new ShopGuarantee();
        if ($keyword) {
            $obj = $obj->whereRaw('(code = "' . $keyword . '" OR title like "%' . $keyword . '%" )');
        }

        if ($sort_order && array_key_exists($sort_order, $arrSort)) {
            $field = explode('__', $sort_order)[0];
            $sort_field = explode('__', $sort_order)[1];
            $obj = $obj->orderBy($field, $sort_field);

        } else {
            $obj = $obj->orderBy('id', 'desc');
        }
        $dataTmp = $obj->paginate(20);

        $dataTr = [];
        foreach ($dataTmp as $key => $row) {
            $dataTr[] = [
                'id' => $row['id'],
                'name' => $row['title'],
                'action' => '
                    <a href="' . route('admin_guarantee.edit', ['id' => $row['id']]) . '"><span title="' . trans('guarantee.admin.edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;

                  <span  onclick="deleteItem(' . $row['id'] . ');"  title="' . trans('guarantee.admin.delete') . '" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>
                  ',
            ];
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['resultItems'] = trans('guarantee.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);

//menuRight
        $data['menuRight'][] = '<a href="' . route('admin_guarantee.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                           <i class="fa fa-plus" title="' . trans('guarantee.admin.add_new') . '"></i>
                           </a>';
//=menuRight

//menuSort
        $optionSort = '';
        foreach ($arrSort as $key => $status) {
            $optionSort .= '<option  ' . (($sort_order == $key) ? "selected" : "") . ' value="' . $key . '">' . $status . '</option>';
        }

        $data['urlSort'] = route('admin_guarantee.index');
        $data['optionSort'] = $optionSort;
//=menuSort

//menuSearch
        $data['topMenuRight'][] = '
                <form action="' . route('admin_guarantee.index') . '" id="button_search">
                   <div onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" title="Refresh">
                              <i class="fa  fa-search"></i>
                           </a>
                   </div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control" placeholder="' . trans('guarantee.admin.search_place') . '" value="' . $keyword . '">
                         </div>
                   </div>
                </form>';
//=menuSearch

        return view('admin.screen.list')
            ->with($data);
    }

    /**
     * Form create new
     * @return [type] [description]
     */
    public function create()
    {
        $data = [
            'title' => trans('guarantee.admin.add_new_title'),
            'subTitle' => '',
            'title_description' => trans('guarantee.admin.add_new_des'),
            'icon' => 'fa fa-plus',
            'language' => [],
            'url_action' => route('admin_guarantee.create'),
        ];
        return view('admin.screen.guarantee')
            ->with($data);
    }

    /**
     * Post create
     * @return [type] [description]
     */
    public function postCreate()
    {
        $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'title' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataInsert = [
            'title' => $data['title'],
        ];
        ShopGuarantee::create($dataInsert);

        return redirect()->route('admin_guarantee.index')->with('success', trans('guarantee.admin.create_success'));

    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $guaranntee = ShopGuarantee::find($id);
        if ($guaranntee === null) {
            return 'no data';
        }
        $data = [
            'title' => trans('guarantee.admin.edit'),
            'subTitle' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'guaranntee' => $guaranntee,
            'url_action' => route('admin_guarantee.edit', ['id' => $guaranntee['id']]),
        ];
        return view('admin.screen.guarantee')
            ->with($data);
    }

    /**
     * update
     */
    public function postEdit($id)
    {
        $guaranntee = ShopGuarantee::find($id);
        $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'title' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
//Edit

        $dataUpdate = [
            'title' => $data['title'],
        ];

        $guaranntee->update($dataUpdate);

//
        return redirect()->route('admin_guarantee.index')->with('success', trans('guarantee.admin.edit_success'));

    }

    /*
    Delete list item
    Need mothod destroy to boot deleting in model
     */
    public function deleteList()
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');
            $arrID = explode(',', $ids);
            ShopGuarantee::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => '']);
        }
    }
}
