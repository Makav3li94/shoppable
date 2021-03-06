<?php
#app/Http/Admin/Controllers/ShopProductController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShopAttributeGroup;
use App\Models\ShopBrand;
use App\Models\ShopGuarantee;
use App\Models\ShopProductAttributeValue;
use App\Models\ShopProductAttrRelate;
use App\Models\ShopProductGroupTypeAttr;
use App\Models\ShopProductType;
use App\Models\ShopProductTypeAttr;
use App\Models\ShopTax;
use App\Models\ShopCategory;
use App\Models\ShopLanguage;
use App\Models\ShopWeight;
use App\Models\ShopLength;
use App\Models\ShopProduct;
use App\Models\ShopProductAttribute;
use App\Models\ShopProductBuild;
use App\Models\ShopProductDescription;
use App\Models\ShopProductGroup;
use App\Models\ShopProductImage;
use App\Models\ShopSupplier;
use Illuminate\Support\Facades\Request;
use Validator;

class ShopProductController extends Controller
{
    public $languages, $kinds, $virtuals, $attributeGroup, $listWeight, $listLength;

    public function __construct()
    {
        $this->languages = ShopLanguage::getList();
        $this->listWeight = ShopWeight::getList();
        $this->listLength = ShopLength::getList();
        $this->attributeGroup = ShopAttributeGroup::getList();
        $this->kinds = [
            SC_PRODUCT_SINGLE => trans('product.kinds.single'),
            SC_PRODUCT_BUILD => trans('product.kinds.build'),
            SC_PRODUCT_GROUP => trans('product.kinds.group'),
        ];
        $this->virtuals = [
            SC_VIRTUAL_PHYSICAL => trans('product.virtuals.physical'),
            SC_VIRTUAL_DOWNLOAD => trans('product.virtuals.download'),
            SC_VIRTUAL_ONLY_VIEW => trans('product.virtuals.only_view'),
            SC_VIRTUAL_SERVICE => trans('product.virtuals.service'),
        ];

    }

    public function index()
    {
        $data = [
            'title' => trans('product.admin.list'),
            'subTitle' => '',
            'icon' => 'fa fa-indent',
            'urlDeleteItem' => route('admin_product.delete'),
            'removeList' => 1, // Enable function delete list item
            'buttonRefresh' => 1, // 1 - Enable button refresh
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
            'id' => trans('product.id'),
            'image' => trans('product.image'),
            'sku' => trans('product.sku'),
            'name' => trans('product.name'),
            'category' => trans('product.category'),
        ];
        if(sc_config('product_cost')){
            $listTh['cost'] = trans('product.cost');
        }
        if(sc_config('product_price')){
            $listTh['price'] = trans('product.price');
        }
        if(sc_config('product_kind')){
            $listTh['kind'] = trans('product.kind');
        }
        if(sc_config('product_virtual')){
            $listTh['virtual'] = trans('product.virtual');
        }
        $listTh['status'] = trans('product.status');
        $listTh['action'] = trans('product.admin.action');

        $keyword = request('keyword') ?? '';

        $sort_order = request('sort_order') ?? 'id_desc';

        $arrSort = [
            'id__desc' => trans('product.admin.sort_order.id_desc'),
            'id__asc' => trans('product.admin.sort_order.id_asc'),
            'name__desc' => trans('product.admin.sort_order.name_desc'),
            'name__asc' => trans('product.admin.sort_order.name_asc'),
        ];


        $tableDescription = (new ShopProductDescription)->getTable();
        $tableProduct = (new ShopProduct)->getTable();

        $obj = (new ShopProduct)
            ->leftJoin($tableDescription, $tableDescription . '.product_id', $tableProduct . '.id')
            ->where($tableDescription . '.lang', sc_get_locale());

        if ($keyword) {
            $obj = $obj->where(function ($sql) use($tableDescription, $tableProduct, $keyword){
                $sql->where($tableDescription . '.name', 'like', '%' . $keyword . '%')
                ->orWhere($tableDescription . '.keyword', 'like', '%' . $keyword . '%')
                ->orWhere($tableDescription . '.description', 'like', '%' . $keyword . '%')
                ->orWhere($tableProduct . '.sku', 'like', '%' . $keyword . '%');
            });
        }

        if ($sort_order && array_key_exists($sort_order, $arrSort)) {
            $field = explode('__', $sort_order)[0];
            $sort_field = explode('__', $sort_order)[1];
            $obj = $obj->sort($field, $sort_field);
        } else {
            $obj = $obj->sort('id', 'desc');
        }
        $dataTmp = $obj->paginate(20);

        $dataTr = [];
        foreach ($dataTmp as $key => $row) {
            $kind = $this->kinds[$row['kind']] ?? $row['kind'];
            if ($row['kind'] == SC_PRODUCT_BUILD) {
                $kind = '<span class="label label-success">' . $kind . '</span>';
            } elseif ($row['kind'] == SC_PRODUCT_GROUP) {
                $kind = '<span class="label label-danger">' . $kind . '</span>';
            }
            $arrName = [];
            foreach ($row->categories as $category) {
                
                $arrName[] = $category->descriptions()->where('lang', sc_get_locale())->first()->title;
            }
            $dataMap = [
                'id' => $row['id'],
                'image' => sc_image_render($row->getThumb(), '50px', '50px', $row['name']),
                'sku' => $row['sku'],
                'name' => $row['name'],
                'category' => implode(';<br>', $arrName),
                
            ];
            if(sc_config('product_cost')){
                $dataMap['cost'] = $row['cost'];
            }
            if(sc_config('product_price')){
                $dataMap['price'] = $row['price'];
            }
            if(sc_config('product_kind')){
                $dataMap['kind'] = $kind;
            }
            if(sc_config('product_virtual')){
                $dataMap['virtual'] = $this->virtuals[$row['virtual']] ?? $row['virtual'];
            }
            $dataMap['status'] = $row['status'] ? '<span class="label label-success">ON</span>' : '<span class="label label-danger">OFF</span>';
            $dataMap['action'] = '
            <a href="' . route('admin_product.edit', ['id' => $row['id']]) . '">
            <span title="' . trans('product.admin.edit') . '" type="button" class="btn btn-flat btn-primary">
            <i class="fa fa-edit"></i>
            </span>
            </a>&nbsp;

            <span onclick="deleteItem(' . $row['id'] . ');"  title="' . trans('admin.delete') . '" class="btn btn-flat btn-danger">
            <i class="fa fa-trash"></i>
            </span>';
            $dataTr[] = $dataMap;
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['resultItems'] = trans('product.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);

//menuRight
        $data['menuRight'][] = '<a href="' . route('admin_product.create') . '" class="btn btn-success btn-flat" title="New" id="button_create_new">
        <i class="fa fa-plus" title="'.trans('admin.add_new').'"></i>
        </a>';
//=menuRight

//menuSort        
        $optionSort = '';
        foreach ($arrSort as $key => $status) {
            $optionSort .= '<option  ' . (($sort_order == $key) ? "selected" : "") . ' value="' . $key . '">' . $status . '</option>';
        }
        $data['optionSort'] = $optionSort;
        $data['urlSort'] = route('admin_product.index');
//=menuSort

//topMenuRight
        $data['topMenuRight'][] ='
                <form action="' . route('admin_product.index') . '" id="button_search">
                   <div onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" title="Refresh">
                              <i class="fa  fa-search"></i>
                              
                           </a>
                   </div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control" placeholder="' . trans('product.admin.search_place') . '" value="' . $keyword . '">
                         </div>
                   </div>
                </form>';
//=topMenuRight

        return view('admin.screen.list')
            ->with($data);
    }

/**
 * Form create new order in admin
 * @return [type] [description]
 */
    public function create()
    {

        $listProductSingle = (new ShopProduct)->getProductSingle()->getData(['keyBy' => 'id'])->toArray();

        // html select product group
        $htmlSelectGroup = '<div class="select-product">';
        $htmlSelectGroup .= '<table width="100%"><tr><td width="80%"><select class="form-control productInGroup select2" data-placeholder="' . trans('product.admin.select_product_in_group') . '" style="width: 100%;" name="productInGroup[]" >';
        $htmlSelectGroup .= '';
        foreach ($listProductSingle as $k => $v) {
            $htmlSelectGroup .= '<option value="' . $k . '">' . $v['name'] . '</option>';
        }
        $htmlSelectGroup .= '</select></td><td><span title="Remove" class="btn btn-flat btn-danger removeproductInGroup"><i class="fa fa-times"></i></span></td></tr></table>';
        $htmlSelectGroup .= '</div>';
        //End select product group

        // html select product build
        $htmlSelectBuild = '<div class="select-product">';
        $htmlSelectBuild .= '<table width="100%"><tr><td width="70%"><select class="form-control productInGroup select2" data-placeholder="' . trans('product.admin.select_product_in_build') . '" style="width: 100%;" name="productBuild[]" >';
        $htmlSelectBuild .= '';
        foreach ($listProductSingle as $k => $v) {
            $htmlSelectBuild .= '<option value="' . $k . '">' . $v['name'] . '</option>';
        }
        $htmlSelectBuild .= '</select></td><td style="width:100px"><input class="form-control"  type="number" name="productBuildQty[]" value="1" min=1></td><td><span title="Remove" class="btn btn-flat btn-danger removeproductBuild"><i class="fa fa-times"></i></span></td></tr></table>';
        $htmlSelectBuild .= '</div>';
        //end select product build

        // html select attribute
        $htmlProductAtrribute = '<tr><td><br><input type="text" name="attribute[attribute_group][name][]" value="attribute_value" class="form-control input-sm" placeholder="' . trans('product.admin.add_attribute_place') . '" /></td><td><br><input type="number" name="attribute[attribute_group][add_price][]" value="add_price_value" class="form-control input-sm" placeholder="' . trans('product.admin.add_price_place') . '"></td><td><br><span title="Remove" class="btn btn-flat btn-sm btn-danger removeAttribute"><i class="fa fa-times"></i></span></td></tr>';
        //end select attribute

        // html add more images
        $htmlMoreImage = '<div class="input-group"><input type="text" id="id_sub_image" name="sub_image[]" value="image_value" class="form-control input-sm sub_image" placeholder=""  /><span class="input-group-btn"><a data-input="id_sub_image" data-preview="preview_sub_image" data-type="product" class="btn btn-sm btn-primary lfm"><i class="fa fa-picture-o"></i> Choose</a></span></div><div id="preview_sub_image" class="img_holder"></div>';
        //end add more images

        $data = [
            'title' => trans('product.admin.add_new_title'),
            'subTitle' => '',
            'title_description' => trans('product.admin.add_new_des'),
            'icon' => 'fa fa-plus',
            'languages' => $this->languages,
            'categories' => (new ShopCategory)->getTreeCategories(),
            'categoriesCheck' => (new ShopCategory)->getTreeCategoriesChildParent(),
            'brands' => (new ShopBrand)->getList(),
            'suppliers' => (new ShopSupplier)->getList(),
            'guarantees' => (new ShopGuarantee())->getList(),
            'taxs' => (new ShopTax)->getList(),
            'virtuals' => $this->virtuals,
            'kinds' => $this->kinds,
            'product_types' => ShopProductType::getList(),
            'attributeGroup' => $this->attributeGroup,
            'htmlSelectGroup' => $htmlSelectGroup,
            'htmlSelectBuild' => $htmlSelectBuild,
            'listProductSingle' => $listProductSingle,
            'htmlProductAtrribute' => $htmlProductAtrribute,
            'htmlMoreImage' => $htmlMoreImage,
            'listWeight' => $this->listWeight,
            'listLength' => $this->listLength, 
        ];

        return view('admin.screen.product_add')
            ->with($data);
    }

/**
 * Post create new order in admin
 * @return [type] [description]
 */

    public function postCreate()
    {
        
        $data = request()->all();
        $langFirst = array_key_first(sc_language_all()->toArray()); //get first code language active
        $data['alias'] = !empty($data['alias'])?$data['alias']:$data['descriptions'][$langFirst]['name'];
        $data['alias'] = sc_word_format_url($data['alias']);
        $data['alias'] = sc_word_limit($data['alias'], 100);

        switch ($data['kind']) {
            case SC_PRODUCT_SINGLE: // product single
                $arrValidation = [
                    'kind' => 'required',
                    'sort' => 'numeric|min:0',
                    'minimum' => 'numeric|min:0',
                    'weight_class' => 'nullable|string|max:100',
                    'length_class' => 'nullable|string|max:100',
                    'weight' => 'nullable|numeric|min:0',
                    'height' => 'nullable|numeric|min:0',
                    'length' => 'nullable|numeric|min:0',
                    'width' => 'nullable|numeric|min:0',
                    'descriptions.*.name' => 'required|string|max:100',
                    'descriptions.*.keyword' => 'nullable|string|max:100',
                    'descriptions.*.description' => 'nullable|string|max:100',
                    'descriptions.*.content' => 'required|string',
                    'cat_manager' => 'required',
                    'sku' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:"'.ShopProduct::class.'",sku',
                    'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:"'.ShopProduct::class.'",alias|string|max:100',
                ];
                $arrMsg = [
                    'descriptions.*.name.required' => trans('validation.required', ['attribute' => trans('product.name')]),
                    'descriptions.*.content.required' => trans('validation.required', ['attribute' => trans('product.content')]),
                    'category.required' => trans('validation.required', ['attribute' => trans('product.category')]),
                    'sku.regex' => trans('product.sku_validate'),
                    'alias.regex' => trans('product.alias_validate'),
                ];
                break;

            case SC_PRODUCT_BUILD: //product build
                $arrValidation = [
                    'kind' => 'required',
                    'sort' => 'numeric|min:0',
                    'minimum' => 'numeric|min:0',
                    'weight_class' => 'nullable|string|max:100',
                    'length_class' => 'nullable|string|max:100',
                    'weight' => 'nullable|numeric|min:0',
                    'height' => 'nullable|numeric|min:0',
                    'length' => 'nullable|numeric|min:0',
                    'width' => 'nullable|numeric|min:0',
                    'descriptions.*.name' => 'required|string|max:100',
                    'descriptions.*.keyword' => 'nullable|string|max:100',
                    'descriptions.*.description' => 'nullable|string|max:100',
                    'cat_manager' => 'required',
                    'sku' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:"'.ShopProduct::class.'",sku',
                    'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:"'.ShopProduct::class.'",alias|string|max:100',
                    'productBuild' => 'required',
                    'productBuildQty' => 'required',

                ];
                $arrMsg = [
                    'descriptions.*.name.required' => trans('validation.required', ['attribute' => trans('product.name')]),
                    'category.required' => trans('validation.required', ['attribute' => trans('product.category')]),
                    'sku.regex' => trans('product.sku_validate'),
                    'alias.regex' => trans('product.alias_validate'),
                ];
                break;

            case SC_PRODUCT_GROUP: //product group
                $arrValidation = [
                    'kind' => 'required',
                    'productInGroup' => 'required',
                    'sku' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:"'.ShopProduct::class.'",sku',
                    'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:"'.ShopProduct::class.'",alias|string|max:100',
                    'sort' => 'numeric|min:0',
                    'minimum' => 'numeric|min:0',
                    'descriptions.*.name' => 'required|string|max:200',
                    'descriptions.*.keyword' => 'nullable|string|max:200',
                    'descriptions.*.description' => 'nullable|string|max:300',
                ];
                $arrMsg = [
                    'descriptions.*.name.required' => trans('validation.required', ['attribute' => trans('product.name')]),
                    'sku.regex' => trans('product.sku_validate'),
                    'alias.regex' => trans('product.alias_validate'),
                ];
                break;

            default:
                $arrValidation = [
                    'kind' => 'required',
                ];
                break;
        }

        $validator = Validator::make($data, $arrValidation, $arrMsg ?? []);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }

        $category = $data['cat_manager'] ?? [];
        $attribute = $data['attribute'] ?? [];
        $descriptions = $data['descriptions'];
        $productInGroup = $data['productInGroup'] ?? [];
        $productBuild = $data['productBuild'] ?? [];
        $productBuildQty = $data['productBuildQty'] ?? [];
        $subImages = $data['sub_image'] ?? [];
        $supplier_id = $data['supplier_id']?? [];
        $guarantee_id = $data['guarantee_id']?? 0;
        $dataInsert = [
            'brand_id' => $data['brand_id']??0,
            'guarantee_id' => $guarantee_id,
            'supplier_id' => implode(',', $supplier_id ),
            'price' => $data['price']??0,
            'sku' => $data['sku'],
            'cost' => $data['cost']??0,
            'stock' => $data['stock']??0,
            'weight_class' => $data['weight_class'] ?? '',
            'length_class' => $data['length_class'] ?? '',
            'weight' => $data['weight'] ?? 0,
            'height' => $data['height'] ?? 0,
            'length' => $data['length'] ?? 0,
            'width' => $data['width'] ?? 0,
            'kind' => $data['kind']??SC_PRODUCT_SINGLE,
            'type_id' => $data['product_type']??0,
            'alias' => $data['alias'],
            'virtual' => $data['virtual'] ?? SC_VIRTUAL_PHYSICAL,
            'date_available' => !empty($data['date_available']) ? $data['date_available'] : null,
            'image' => $data['image']??'',
            'tax_id' => $data['tax_id']??0,
            'status' => (!empty($data['status']) ? 1 : 0),
            'sort' => (int) $data['sort'],
            'minimum' => (int) $data['minimum'],
        ];
        //insert product
        $product = ShopProduct::create($dataInsert);


        if (isset(request()->attr_text)) {
            foreach (request()->attr_text as $group_id => $attr_group) {
                foreach ($attr_group as $attr_id => $attr_attr) {
                    if (is_array($attr_attr)) {

                        foreach ($attr_attr as $keey => $related_prodcut)
                            ShopProductAttrRelate::create([
                                'type_id' => request()->product_type,
                                'product_id' => $product->id,
                                'attr_id' => $attr_id,
                                'related_product_id' => $related_prodcut,
                            ]);

                    } else {
                        ShopProductAttributeValue::create([
                            'type_id' => request()->product_type,
                            'group_id' => $group_id,
                            'attr_id' => $attr_id,
                            'product_id' => $product->id,
                            'content_value' => $attr_attr,
                            'status' => 1,
                        ]);
                    }
                }
            }
        }


        if (isset(request()->attr_text_enumeration)) {
            foreach (request()->attr_text_enumeration as $group_id => $attr_group) {
                foreach ($attr_group as $attr_id => $attr_attr) {
                    foreach ($attr_attr as $attr_att) {
                        ShopProductAttributeValue::create([
                            'type_id' => request()->product_type,
                            'group_id' => $group_id,
                            'attr_id' => $attr_id,
                            'product_id' => $id,
                            'content_value' => $attr_att,
                            'status' => 1,
                        ]);
                    }
                }
            }
        }

        //Promoton price
        if (isset($data['price_promotion']) && in_array($data['kind'], [SC_PRODUCT_SINGLE, SC_PRODUCT_BUILD])) {
            $arrPromotion['price_promotion'] = $data['price_promotion'];
            $arrPromotion['date_start'] = $data['price_promotion_start'] ? $data['price_promotion_start'] : null;
            $arrPromotion['date_end'] = $data['price_promotion_end'] ? $data['price_promotion_end'] : null;
            $arrPromotion['start_time'] = $data['start_time'] ? $data['start_time'] : null;
            $arrPromotion['end_time'] = $data['end_time'] ? $data['end_time'] : null;
            $arrPromotion['is_amazing'] = isset($data['is_amazing']) ? 1 : 0 ;
            $product->promotionPrice()->create($arrPromotion);
        }

        //Insert category
        if ($category && in_array($data['kind'], [SC_PRODUCT_SINGLE, SC_PRODUCT_BUILD])) {
            $category = explode(',', $category);
            $product->categories()->attach($category);
        }
        //Insert group
        if ($productInGroup && $data['kind'] == SC_PRODUCT_GROUP) {
            $arrDataGroup = [];
            foreach ($productInGroup as $pID) {
                if ((int) $pID) {
                    $arrDataGroup[$pID] = new ShopProductGroup(['product_id' => $pID]);
                }
            }
            $product->groups()->saveMany($arrDataGroup);
        }

        //Insert Build
        if ($productBuild && $data['kind'] == SC_PRODUCT_BUILD) {
            $arrDataBuild = [];
            foreach ($productBuild as $key => $pID) {
                if ((int) $pID) {
                    $arrDataBuild[$pID] = new ShopProductBuild(['product_id' => $pID, 'quantity' => $productBuildQty[$key]]);
                }
            }
            $product->builds()->saveMany($arrDataBuild);
        }

        //Insert attribute
        if ($attribute && $data['kind'] == SC_PRODUCT_SINGLE) {
            $arrDataAtt = [];
            foreach ($attribute as $group => $rowGroup) {
                if (count($rowGroup)) {
                    foreach ($rowGroup['name'] as $key => $nameAtt) {
                        if ($nameAtt) {
                            $arrDataAtt[] = new ShopProductAttribute(['name' => $nameAtt, 'add_price' => $rowGroup['add_price'][$key],  'attribute_group_id' => $group]);
                        }
                    }
                }

            }
            $product->attributes()->saveMany($arrDataAtt);
        }

        //Insert description
        $dataDes = [];
        $languages = $this->languages;
        foreach ($languages as $code => $value) {
            $dataDes[] = [
                'product_id' => $product->id,
                'lang' => $code,
                'name' => $descriptions[$code]['name'],
                'keyword' => $descriptions[$code]['keyword'],
                'description' => $descriptions[$code]['description'],
                'content' => $descriptions[$code]['content'] ?? '',
            ];
        }

        ShopProductDescription::insert($dataDes);

        //Insert sub mages
        if ($subImages && in_array($data['kind'], [SC_PRODUCT_SINGLE, SC_PRODUCT_BUILD])) {
            $arrSubImages = [];
            foreach ($subImages as $key => $image) {
                if ($image) {
                    $arrSubImages[] = new ShopProductImage(['image' => $image]);
                }
            }
            $product->images()->saveMany($arrSubImages);
        }

        return redirect()->route('admin_product.index')->with('success', trans('product.admin.create_success'));

    }

/**
 * Form edit
 */
    public function edit($id)
    {
        $product = ShopProduct::find($id);

        if ($product === null) {
            return 'no data';
        }

        $listProductSingle = (new ShopProduct)->getProductSingle()->getData(['keyBy' => 'id'])->toArray();

        // html select product group
        $htmlSelectGroup = '<div class="select-product">';
        $htmlSelectGroup .= '<table width="100%"><tr><td width="80%"><select class="form-control productInGroup select2" data-placeholder="' . trans('product.admin.select_product_in_group') . '" style="width: 100%;" name="productInGroup[]" >';
        $htmlSelectGroup .= '';
        foreach ($listProductSingle as $k => $v) {
            $htmlSelectGroup .= '<option value="' . $k . '">' . $v['name'] . '</option>';
        }
        $htmlSelectGroup .= '</select></td><td><span title="Remove" class="btn btn-flat btn-danger removeproductInGroup"><i class="fa fa-times"></i></span></td></tr></table>';
        $htmlSelectGroup .= '</div>';
        //End select product group

        // html select product build
        $htmlSelectBuild = '<div class="select-product">';
        $htmlSelectBuild .= '<table width="100%"><tr><td width="70%"><select class="form-control productInGroup select2" data-placeholder="' . trans('product.admin.select_product_in_build') . '" style="width: 100%;" name="productBuild[]" >';
        $htmlSelectBuild .= '';
        foreach ($listProductSingle as $k => $v) {
            $htmlSelectBuild .= '<option value="' . $k . '">' . $v['name'] . '</option>';
        }
        $htmlSelectBuild .= '</select></td><td style="width:100px"><input class="form-control"  type="number" name="productBuildQty[]" value="1" min=1></td><td><span title="Remove" class="btn btn-flat btn-danger removeproductBuild"><i class="fa fa-times"></i></span></td></tr></table>';
        $htmlSelectBuild .= '</div>';
        //end select product build

        // html select attribute
        $htmlProductAtrribute = '<tr><td><br><input type="text" name="attribute[attribute_group][name][]" value="attribute_value" class="form-control input-sm" placeholder="' . trans('product.admin.add_attribute_place') . '" /></td><td><br><input type="number" name="attribute[attribute_group][add_price][]" value="add_price_value" class="form-control input-sm" placeholder="' . trans('product.admin.add_price_place') . '"></td><td><br><span title="Remove" class="btn btn-flat btn-sm btn-danger removeAttribute"><i class="fa fa-times"></i></span></td></tr>';
        //end select attribute

        $data = [
            'title' => trans('product.admin.edit'),
            'subTitle' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'languages' => $this->languages,
            'product' => $product,
            'categories' => (new ShopCategory)->getTreeCategories(),
            'brands' => (new ShopBrand)->getList(),
            'guarantees' => (new ShopGuarantee)->getList(),
            'suppliers' => (new ShopSupplier)->getList(),
            'taxs' => (new ShopTax)->getList(),
            'virtuals' => $this->virtuals,
            'kinds' => $this->kinds,
            'product_types' => ShopProductType::getList(),
            'attributeGroup' => $this->attributeGroup,
            'htmlSelectGroup' => $htmlSelectGroup,
            'categoriesCheck' => (new ShopCategory)->getTreeCategoriesChildParent(),
            'htmlSelectBuild' => $htmlSelectBuild,
            'listProductSingle' => $listProductSingle,
            'htmlProductAtrribute' => $htmlProductAtrribute,
            'listWeight' => $this->listWeight,
            'listLength' => $this->listLength,        ];
        return view('admin.screen.product_edit')
            ->with($data);
    }

/**
 * update status
 */
    public function postEdit($id)
    {

        $product = ShopProduct::find($id);
        $data = request()->all();
        $langFirst = array_key_first(sc_language_all()->toArray()); //get first code language active
        $data['alias'] = !empty($data['alias'])?$data['alias']:$data['descriptions'][$langFirst]['name'];
        $data['alias'] = sc_word_format_url($data['alias']);
        $data['alias'] = sc_word_limit($data['alias'], 100);

        switch ($product['kind']) {
            case SC_PRODUCT_SINGLE: // product single
                $arrValidation = [
                    'sort' => 'numeric|min:0',
                    'minimum' => 'numeric|min:0',
                    'weight_class' => 'nullable|string|max:100',
                    'length_class' => 'nullable|string|max:100',
                    'weight' => 'nullable|numeric|min:0',
                    'height' => 'nullable|numeric|min:0',
                    'length' => 'nullable|numeric|min:0',
                    'width' => 'nullable|numeric|min:0',
                    'descriptions.*.name' => 'required|string|max:200',
                    'descriptions.*.keyword' => 'nullable|string|max:200',
                    'descriptions.*.description' => 'nullable|string|max:300',
                    'descriptions.*.content' => 'required|string',
                    'cat_manager' => 'required',
//                    'sku' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:"'.ShopProduct::class.'",sku,' . $product->id . ',id',
                    'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:"'.ShopProduct::class.'",alias,' . $product->id . ',id|string|max:100',
                ];
                $arrMsg = [
                    'descriptions.*.name.required' => trans('validation.required', ['attribute' => trans('product.name')]),
                    'descriptions.*.content.required' => trans('validation.required', ['attribute' => trans('product.content')]),
                    'category.required' => trans('validation.required', ['attribute' => trans('product.category')]),
                    'sku.regex' => trans('product.sku_validate'),
                    'alias.regex' => trans('product.alias_validate'),
                ];
                break;
            case SC_PRODUCT_BUILD: //product build
                $arrValidation = [
                    'sort' => 'numeric|min:0',
                    'minimum' => 'numeric|min:0',
                    'weight_class' => 'nullable|string|max:100',
                    'length_class' => 'nullable|string|max:100',
                    'weight' => 'nullable|numeric|min:0',
                    'height' => 'nullable|numeric|min:0',
                    'length' => 'nullable|numeric|min:0',
                    'width' => 'nullable|numeric|min:0',
                    'descriptions.*.name' => 'required|string|max:200',
                    'descriptions.*.keyword' => 'nullable|string|max:200',
                    'descriptions.*.description' => 'nullable|string|max:300',
                    'cat_manager' => 'required',
                    'sku' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:"'.ShopProduct::class.'",sku,' . $product->id . ',id',
                    'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:"'.ShopProduct::class.'",alias,' . $product->id . ',id|string|max:100',
                    'productBuild' => 'required',
                    'productBuildQty' => 'required',
                ];
                $arrMsg = [
                    'descriptions.*.name.required' => trans('validation.required', ['attribute' => trans('product.name')]),
                    'category.required' => trans('validation.required', ['attribute' => trans('product.category')]),
                    'sku.regex' => trans('product.sku_validate'),
                    'alias.regex' => trans('product.alias_validate'),
                ];
                break;

            case SC_PRODUCT_GROUP: //product group
                $arrValidation = [
                    'sku' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:"'.ShopProduct::class.'",sku,' . $product->id . ',id',
                    'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:"'.ShopProduct::class.'",alias,' . $product->id . ',id|string|max:100',
                    'productInGroup' => 'required',
                    'sort' => 'numeric|min:0',
                    'minimum' => 'numeric|min:0',
                    'descriptions.*.name' => 'required|string|max:200',
                    'descriptions.*.keyword' => 'nullable|string|max:200',
                    'descriptions.*.description' => 'nullable|string|max:300',
                ];
                $arrMsg = [
                    'sku.regex' => trans('product.sku_validate'),
                    'alias.regex' => trans('product.alias_validate'),
                    'descriptions.*.name.required' => trans('validation.required', ['attribute' => trans('product.name')]),
                ];
                break;

            default:
                break;
        }

        $validator = Validator::make($data, $arrValidation, $arrMsg ?? []);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }
//Edit

        $category = $data['cat_manager'] ?? [];
        $attribute = $data['attribute'] ?? [];
        $productInGroup = $data['productInGroup'] ?? [];
        $productBuild = $data['productBuild'] ?? [];
        $productBuildQty = $data['productBuildQty'] ?? [];
        $subImages = $data['sub_image'] ?? [];
        $supplier_id = $data['supplier_id']?? [];
        $dataUpdate = [
            'image' => $data['image'] ?? '',
            'tax_id' => $data['tax_id'] ?? 0,
            'brand_id' => $data['brand_id'] ?? 0,
            'guarantee_id' => $data['guarantee_id'] ?? 0,
            'supplier_id' => implode(',', $supplier_id ),
            'price' => $data['price'] ?? 0,
            'cost' => $data['cost'] ?? 0,
            'stock' => $data['stock'] ?? 0,
            'weight_class' => $data['weight_class'] ?? '',
            'length_class' => $data['length_class'] ?? '',
            'weight' => $data['weight'] ?? 0,
            'height' => $data['height'] ?? 0,
            'length' => $data['length'] ?? 0,
            'type_id' => $data['product_type']??0,
            'width' => $data['width'] ?? 0,
            'virtual' => $data['virtual'] ?? SC_VIRTUAL_PHYSICAL,
            'date_available' => !empty($data['date_available']) ? $data['date_available'] : null,
            'sku' => $data['sku'],
            'alias' => $data['alias'],
            'status' => (!empty($data['status']) ? 1 : 0),
            'sort' => (int) $data['sort'],
            'minimum' => (int) $data['minimum'],
        ];

        $product->update($dataUpdate);

        //Atrr ssss

        if (isset(request()->attr_text)) {
            if (count(request()->attr_text) > 0) {
                ShopProductAttrRelate::where('product_id', $id)->delete();
                foreach (request()->attr_text as $group_id => $attr_group) {


                    foreach ($attr_group as $attr_id => $attr_attr) {
                        if (is_array($attr_attr)) {


                            foreach ($attr_attr as $keey => $related_prodcut) {
                                ShopProductAttrRelate::create([
                                    'type_id' => request()->product_type,
                                    'product_id' => $id,
                                    'attr_id' => $attr_id,
                                    'related_product_id' => $related_prodcut,
                                ]);

                            }
                        } else {
                            ShopProductAttributeValue::where('attr_id', $attr_id)->delete();
                            ShopProductAttributeValue::create([
                                'type_id' => request()->product_type,
                                'group_id' => $group_id,
                                'attr_id' => $attr_id,
                                'product_id' => $id,
                                'content_value' => $attr_attr,
                                'status' => 1,
                            ]);

                        }
                    }
                }
            }
        }

        if (isset(request()->attr_text_enumeration)) {
            foreach (request()->attr_text_enumeration as $group_id => $attr_group) {
                foreach ($attr_group as $attr_id => $attr_attr) {
                    if (count($attr_attr) > 0) {
//                        DB::enableQueryLog();
                        ShopProductAttributeValue::where([['product_id', $id], ['attr_id', $attr_id]])->delete();
//                        dd(DB::getQueryLog());
                        foreach ($attr_attr as $attr_att) {
                            ShopProductAttributeValue::create([
                                'type_id' => request()->product_type,
                                'group_id' => $group_id,
                                'attr_id' => $attr_id,
                                'product_id' => $id,
                                'content_value' => $attr_att,
                                'status' => 1,
                            ]);
                        }
                    }
                }
            }
        }
        //Promoton price
        $product->promotionPrice()->delete();
        if (isset($data['price_promotion']) && in_array($product['kind'], [SC_PRODUCT_SINGLE, SC_PRODUCT_BUILD])) {
            $arrPromotion['price_promotion'] = $data['price_promotion'];
            $arrPromotion['date_start'] = $data['price_promotion_start'] ? $data['price_promotion_start'] : null;
            $arrPromotion['date_end'] = $data['price_promotion_end'] ? $data['price_promotion_end'] : null;
            $arrPromotion['start_time'] = $data['start_time'] ? $data['start_time'] : null;
            $arrPromotion['end_time'] = $data['end_time'] ? $data['end_time'] : null;
            $arrPromotion['is_amazing'] = isset($data['is_amazing'])  ? 1 : 0 ;
            $product->promotionPrice()->create($arrPromotion);
        }

        $product->descriptions()->delete();
        $dataDes = [];
        foreach ($data['descriptions'] as $code => $row) {
            $dataDes[] = [
                'product_id' => $id,
                'lang' => $code,
                'name' => $row['name'],
                'keyword' => $row['keyword'],
                'description' => $row['description'],
                'content' => $row['content'] ?? '',
            ];
        }
        ShopProductDescription::insert($dataDes);

        //Update category
        if (in_array($product['kind'], [SC_PRODUCT_SINGLE, SC_PRODUCT_BUILD])) {
            $product->categories()->detach();
            $category = explode(',', $category);
            if (count($category)) {
                $product->categories()->attach($category);
            }
        }

        //Update group
        if ($product['kind'] == SC_PRODUCT_GROUP) {
            $product->groups()->delete();
            if (count($productInGroup)) {
                $arrDataGroup = [];
                foreach ($productInGroup as $pID) {
                    if ((int) $pID) {
                        $arrDataGroup[$pID] = new ShopProductGroup(['product_id' => $pID]);
                    }
                }
                $product->groups()->saveMany($arrDataGroup);
            }

        }

        //Update Build
        if ($product['kind'] == SC_PRODUCT_BUILD) {
            $product->builds()->delete();
            if (count($productBuild)) {
                $arrDataBuild = [];
                foreach ($productBuild as $key => $pID) {
                    if ((int) $pID) {
                        $arrDataBuild[$pID] = new ShopProductBuild(['product_id' => $pID, 'quantity' => $productBuildQty[$key]]);
                    }
                }
                $product->builds()->saveMany($arrDataBuild);
            }

        }

        //Update attribute
        if ($product['kind'] == SC_PRODUCT_SINGLE) {
            $product->attributes()->delete();
            if (count($attribute)) {
                $arrDataAtt = [];
                foreach ($attribute as $group => $rowGroup) {
                    if (count($rowGroup)) {
                        foreach ($rowGroup['name'] as $key => $nameAtt) {
                            if ($nameAtt) {
                                $arrDataAtt[] = new ShopProductAttribute(['name' => $nameAtt, 'add_price' => $rowGroup['add_price'][$key], 'attribute_group_id' => $group]);
                            }
                        }
                    }

                }
                $product->attributes()->saveMany($arrDataAtt);
            }

        }

        //Update sub mages
        if ($subImages && in_array($product['kind'], [SC_PRODUCT_SINGLE, SC_PRODUCT_BUILD])) {
            $product->images()->delete();
            $arrSubImages = [];
            foreach ($subImages as $key => $image) {
                if ($image) {
                    $arrSubImages[] = new ShopProductImage(['image' => $image]);
                }
            }
            $product->images()->saveMany($arrSubImages);
        }

//
        return redirect()->route('admin_product.index')->with('success', trans('product.admin.edit_success'));

    }

/*
Delete list Item
Need mothod destroy to boot deleting in model
 */
    public function deleteList()
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');
            $arrID = explode(',', $ids);
            $arrCantDelete = [];
            foreach ($arrID as $key => $id) {
                if (ShopProductBuild::where('product_id', $id)->first() || ShopProductGroup::where('product_id', $id)->first()) {
                    $arrCantDelete[] = $id;}
            }
            if (count($arrCantDelete)) {
                return response()->json(['error' => 1, 'msg' => trans('product.admin.cant_remove_child') . ': ' . json_encode($arrCantDelete)]);
            } else {
                ShopProduct::destroy($arrID);
                return response()->json(['error' => 0, 'msg' => '']);
            }

        }
    }




    public function getProductTypes()
    {
        $product_type = request()->product_type;
        if (request()->has('product_id')) {
            $product_id = request()->product_id;
        }
        $data = [];

        $type_groups = ShopProductGroupTypeAttr::select('id', 'type_id', 'name')->Where('type_id', $product_type)->get();

        foreach ($type_groups as $key => $type_group) {
            $type_groups[$key]->attrs = ShopProductTypeAttr::select('id', 'type_id', 'input_type', 'searchable', 'required', 'group_id', 'name')
                ->Where('group_id', $type_group->id)
                ->get();

            $clause = [];

            foreach ($type_groups[$key]->attrs as $k => $type_groups_attr) {
                $clause = [];
                $clause[] = ['attr_id', $type_groups_attr->id];

                if (empty($product_id) == false) {
                    $clause[] = ['product_id', $product_id];
                }
//        DB::enableQueryLog();
                $value = ShopProductAttributeValue::where($clause)->pluck('content_value');
//                        dd(DB::getQueryLog());
                if (empty($product_id) == false) {
                    $type_groups[$key]->attrs[$k]->value = $value;
                }

            }
        }

        return $type_groups;
    }

    function getAttrInput()
    {
        return ShopProductAttrInput::where('attr_id', request()->attr_id)->get();
    }

    function getProductRealte()
    {
        if (isset(request()->attr_type_related) && request()->attr_type_related != 'all') {

            return DB::table('shop_product')
                ->leftJoin('shop_product_description', 'shop_product.id', '=', 'shop_product_description.product_id')
                ->where('shop_product.type_id', '=', request()->attr_type_related)
                ->pluck('name', 'id');
        } else {

            return DB::table('shop_product')
                ->leftJoin('shop_product_description', 'shop_product.id', '=', 'shop_product_description.product_id')
                ->pluck('name', 'id');

        }
    }

    function getRelatedProducts()
    {
//        DB::enableQueryLog();
        $result = DB::table('shop_product_attr_relate')
            ->leftJoin('shop_product', 'shop_product_attr_relate.product_id', '=', 'shop_product.id')
            ->leftJoin('shop_product_description', 'shop_product_attr_relate.related_product_id', '=', 'shop_product_description.product_id')
            ->where([
                ['shop_product_attr_relate.product_id', '=', request()->product_id],
                ['shop_product_attr_relate.attr_id', '=', request()->attr_id]
            ])
            ->pluck('name', 'related_product_id');
//            ->pluck('name', 'related_product_id');
//        dd(DB::getQueryLog());
        return $result;
    }


    public function getFirstChildCat()
    {
        return DB::table('shop_category')
            ->leftJoin('shop_category_description', 'shop_category.id', '=', 'shop_category_description.category_id')
            ->where('parent', \request()->cat_id)
            ->pluck('name', 'id');
    }

    public function getProductTypeAttr()
    {
        return DB::select(
            "select *, GROUP_CONCAT(DISTINCT  pa_shop_product_attr_input_value .content_value ) AS contents from `pa_shop_product_attr_input_value` 
            left join `shop_type_attr`  on `pa_shop_type_attr`.`attr_id` = `pa_shop_product_attr_input_value`.`attr_id` 
            where  `pa_shop_product_attr_input_value`.`type_id` = " . request()->type_id . " AND pa_shop_type_attr.searchable = 1 GROUP BY shop_type_attr.name"
        );

    }


}
