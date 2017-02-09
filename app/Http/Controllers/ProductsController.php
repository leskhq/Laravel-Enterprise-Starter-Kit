<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository as Product;
use App\Repositories\SupplierRepository as Supplier;
use App\Repositories\PerfumeRepository as Perfume;
use App\Repositories\Criteria\Product\ProductWhereCategoryLike;
use App\Repositories\Criteria\Product\ProductWhereNameLike;
use App\Repositories\Criteria\Product\ProductOrderByColumn;
use App\Repositories\Criteria\Product\ProductsByNamesAscending;
use App\Repositories\Criteria\Product\PerfumeWhereNameLike;
use App\Repositories\Criteria\Product\ProductsWithSuppliers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;

class ProductsController extends Controller
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * @var Supplier
     */
    protected $supplier;

    /**
     * @var Perfume
     */
    protected $perfume;

    /**
     * @param Product $product
     * @param Supplier $supplier
     * @param Perfume $perfume
     */
    public function __construct(Product $product, Supplier $supplier, Perfume $perfume)
    {
        $this->product  = $product;
        $this->supplier = $supplier;
        $this->perfume  = $perfume;
    }

    static function routes() {
        \Route::group(['prefix' => 'products'], function () {
            \Route::post( '/',                      'ProductsController@store')         ->name('admin.products.store');
            \Route::get(  '/create',                'ProductsController@create')        ->name('admin.products.create');
            \Route::get(  '/search',                'ProductsController@search')        ->name('admin.products.search');
            \Route::get(  '/getInfo',               'ProductsController@getInfo')       ->name('admin.products.get-info');
            \Route::get(  '/aromaSearch',           'ProductsController@aromaSearch')   ->name('admin.products.aroma-search');
            \Route::patch('/{proId}',               'ProductsController@update')        ->name('admin.products.update');
            \Route::get(  '{slug}',                 'ProductsController@indexCategory') ->name('admin.products.index-category');
            \Route::get(  '/{proId}/cat',           'ProductsController@index')         ->name('admin.products.index');
            \Route::get(  '/{proId}/edit',          'ProductsController@edit')          ->name('admin.products.edit');
            \Route::get(  '/{proId}/delete',        'ProductsController@destroy')       ->name('admin.products.delete');
            \Route::get(  '/{proId}/confirm-delete','ProductsController@getModalDelete')->name('admin.products.confirm-delete');
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $sortBy           = $request->input('sortBy');
        $orderBy          = $request->input('orderBy');
        $page_title       = trans('admin/products/general.page.index.title');
        $page_description = trans('admin/products/general.page.index.description');

        if ($sortBy && $orderBy) {
            $products = $this->product->pushCriteria(new ProductWhereCategoryLike($id))->pushCriteria(new ProductOrderByColumn($sortBy, $orderBy))->all();
        } else {
            $products = $this->product->pushCriteria(new ProductWhereCategoryLike($id))->pushCriteria(new ProductsByNamesAscending)->all();
        }


        return view('admin.products.index', compact('page_title', 'page_description', 'products', 'id', 'sortBy', 'orderBy'));
    }

    public function indexCategory($slug) {
        $node = \App\Models\Category::where('slug', $slug)->first();
        $parent = $node->parent()->first();
        $products = \App\Models\Product::where('category_id', $node->id)->get();
        return view('admin.products.test-index', compact('parent', 'products', 'slug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perfumes = [];

        foreach ($this->perfume->all() as $p) {
            $perfumes[$p->id] = $p->name;
        }

        $page_title       = trans('admin/products/general.page.create.title');
        $page_description = trans('admin/products/general.page.create.description');

        return view('admin.products.create', compact('page_title', 'page_description', 'perfumes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token']);

        dd($data);

        $this->product->create($data);

        Flash::success( trans('admin/products/general.status.created') );

        return redirect()->route('admin.products.index-category', 'detergent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product          = $this->product->pushCriteria(new ProductsWithSuppliers())->find($id);
        $perfumes         = [];
        $page_title       = trans('admin/products/general.page.edit.title');
        $page_description = trans('admin/products/general.page.edit.description', ['full_name' => $product->name]);

        foreach ($this->perfume->all() as $p) {
            $perfumes[$p->id] = $p->name;
        }

        return view('admin.products.edit', compact('page_title', 'page_description', 'product', 'perfumes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method', 'supplier']);

        $this->product->update($data, $id);

        $slug = \App\Models\Category::find($data['category_id'])->slug;

        Flash::success( trans('admin/products/general.status.updated') );

        return redirect()->route('admin.products.index-category', $slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->product->delete($id);

        Flash::success( trans('admin/products/general.status.deleted') );

        return redirect()->route('admin.products.index-category', 'detergent');
    }

    /**
     * Delete Confirm
     *
     * @param   int   $id
     * @return  View
     */
    public function getModalDelete($id)
    {
        $error       = null;
        
        $product     = $this->product->find($id);
        
        $modal_title = trans('admin/products/dialog.delete-confirm.title');
        $modal_route = route('admin.products.delete', array('id' => $product->id));
        $modal_body  = trans('admin/products/dialog.delete-confirm.body', ['id' => $product->id, 'full_name' => $product->name]);

        return view('modal_confirmation', compact('error', 'modal_route', 'modal_title', 'modal_body'));

    }

    public function getInfo(Request $request)
    {
        $return_arr = null;
        
        $term       = $request->input('term');
        
        $products   = $this->product->pushCriteria(new ProductWhereNameLike($term))->all();

        foreach ($products as $p) {
            $id   = $p->id;
            $name = $p->name;

            $entry_arr    = [ 'id' => $id, 'value' => $name];
            $return_arr[] = $entry_arr;
        }

        return $return_arr;
    }

    public function search(Request $request) {
        $return_arr = null;

        $query      = $request->input('term');

        $products   = $this->product->pushCriteria(new ProductWhereNameLike($query))->all();

        foreach ($products as $product) {
            $id              = $product->id;
            $name            = $product->name;
            $price           = $product->price;
            $agenresmi_price = $product->agenresmi_price;
            $agenlepas_price = $product->agenlepas_price;
            $weight          = $product->weight;

            $entry_arr = [
                'id'              => $id,
                'value'           => $name,
                'price'           => $price,
                'agenresmi_price' => $agenresmi_price,
                'agenlepas_price' => $agenlepas_price,
                'weight'          => $weight
            ];
            $return_arr[] = $entry_arr;
        }

        return response()->json($return_arr);
    }

    public function aromaSearch(Request $request) {
        $return_arr = null;

        $query      = $request->input('term');

        // $perfumes   = $this->perfume->pushCriteria(new PerfumeWhereNameLike($query))->all();
        $perfumes   = \App\Models\Product::where('category_id', 'like', 10)
                ->where('name', 'like', '%'.$query.'%')
                ->orderBy('name', 'desc')
                ->take(10)
                ->get();

        foreach ($perfumes as $perfume) {
            $name            = $perfume->name;

            $entry_arr = [
              'value'           => $name
            ];

            $return_arr[] = $entry_arr;
        }

        return response()->json($return_arr);
    }
}
