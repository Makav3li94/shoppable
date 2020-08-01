<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShopAd;
use App\Models\ShopAdDescription;
use App\Models\ShopLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopAdController extends Controller
{
    public $languages;

    public function __construct()
    {
        $this->languages = ShopLanguage::getList();
    }

    public function index()
    {

        $data = [
            'title' => trans('ad.admin.list'),
            'subTitle' => '',
            'icon' => 'fa fa-indent',
            'removeList' => 0, // 1 - Enable function delete list item
            'buttonRefresh' => 0, // 1 - Enable button refresh
            'buttonSort' => 0, // 1 - Enable button sort
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
            'name' => trans('ad.name'),
            'link' => trans('ad.link'),
            'status' => trans('ad.status'),
        ];

        $sort_order = request('sort_order') ?? 'id_desc';
        $keyword = request('keyword') ?? '';
        $arrSort = [
            'id__desc' => trans('ad.admin.sort_order.id_desc'),
            'id__asc' => trans('ad.admin.sort_order.id_asc'),
        ];
        $obj = new ShopAd;


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
                'name' => $row['name'],
                'link' => $row['link'],
                'status' => $row['status'] ? '<span class="label label-success">ON</span>' : '<span class="label label-danger">OFF</span>',
                'action' => '<a href="' . route('admin_ad.edit', ['id' => $row['id']]) . '"><span title="' . trans('ad.admin.edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;',
            ];
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['resultItems'] = trans('ad.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);


//menuSort
        $optionSort = '';
        foreach ($arrSort as $key => $status) {
            $optionSort .= '<option  ' . (($sort_order == $key) ? "selected" : "") . ' value="' . $key . '">' . $status . '</option>';
        }

        $data['urlSort'] = route('admin_ad.index');
        $data['optionSort'] = $optionSort;
//=menuSort

//menuSearch
        $data['topMenuRight'][] = '
                <form action="' . route('admin_ad.index') . '" id="button_search">
                   <div onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" title="Refresh">
                              <i class="fa  fa-search"></i>
                           </a>
                   </div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control" placeholder="' . trans('ad.admin.search_place') . '" value="' . $keyword . '">
                         </div>
                   </div>
                </form>';
//=menuSearch

        return view('admin.screen.list')
            ->with($data);
    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $ad = ShopAd::find($id);
        if ($ad === null) {
            return 'no data';
        }
        $data = [
            'title' => trans('ad.admin.edit'),
            'subTitle' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'languages' => $this->languages,
            'ad' => $ad,
            'url_action' => route('admin_ad.edit', ['id' => $ad['id']]),
        ];
        return view('admin.screen.ad')
            ->with($data);
    }

    /**
     * update status
     */

    public function postEdit($id)
    {
        $data = request()->all();


        $validator = Validator::make($data, [
            'name' => 'required|string|max:200',
            'link' => 'nullable|string|max:255',
            'descriptions.*.body' => 'nullable|string',
            'descriptions.*.image' => 'nullable',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }
//Edit

        $dataUpdate = [
            'name' => $data['name'],
            'link' => $data['link'],
            'status' => empty($data['status']) ? 0 : 1,
        ];

        $obj = ShopAd::find($id);
        $obj->update($dataUpdate);
        $obj->descriptions()->delete();
        $dataDes = [];
        foreach ($data['descriptions'] as $code => $row) {
            $dataDes[] = [
                'ad_id' => $id,
                'lang' => $code,
                'image' => $row['image'],
                'body' => $row['body'],
            ];
        }
        ShopAdDescription::insert($dataDes);

//
        return redirect()->route('admin_ad.index')->with('success', trans('ad.admin.edit_success'));

    }

}
