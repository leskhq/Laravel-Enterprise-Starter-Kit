<?php

namespace App\Http\Controllers;

use App\Repositories\PurchaseOrderRepository as PurchaseOrder;
use App\Repositories\PurchaseOrderDetailRepository as PurchaseOrderDetail;
use App\Repositories\MaterialRepository as Material;
use App\Repositories\Criteria\PurchaseOrder\PurchaseOrdersWithDetails;
use App\Repositories\Criteria\Material\MaterialsOutOfStock;
use App\Repositories\Criteria\PurchaseOrder\PurchaseOrdersByCreatedAtDescending;
use App\Repositories\Criteria\PurchaseOrder\PurchaseOrdersWhereStatus;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Helpers;
use Flash;

class PurchaseOrdersController extends Controller
{
    private $purchaseOrder;

    private $purchaseOrderDetail;

    private $material;

    public function __construct(
            PurchaseOrder $purchaseOrder,
            PurchaseOrderDetail $purchaseOrderDetail,
            Material $material
        )
    {
        $this->purchaseOrder       = $purchaseOrder;
        $this->purchaseOrderDetail = $purchaseOrderDetail;
        $this->material            = $material;
    }

    static function routes() {
        \Route::group(['prefix' => 'purchase-orders'], function () {
            \Route::get(  '/',                      'PurchaseOrdersController@index')           ->name('admin.purchase-orders.index');
            \Route::post( '/',                      'PurchaseOrdersController@store')           ->name('admin.purchase-orders.store');
            \Route::get(  '/search',                'PurchaseOrdersController@search')          ->name('admin.purchase-orders.search');
            \Route::get(  '/create',                'PurchaseOrdersController@create')          ->name('admin.purchase-orders.create');
            \Route::get(  '/{poId}',                'PurchaseOrdersController@show')            ->name('admin.purchase-orders.show');
            \Route::patch('/{poId}',                'PurchaseOrdersController@update')          ->name('admin.purchase-orders.update');
            \Route::get(  '/{poId}/print',          'PurchaseOrdersController@print')           ->name('admin.purchase-orders.print');
            \Route::get(  '/{poId}/edit',           'PurchaseOrdersController@edit')            ->name('admin.purchase-orders.edit');
            \Route::get(  '/{poId}/delete',         'PurchaseOrdersController@destroy')         ->name('admin.purchase-orders.delete');
            \Route::get(  '/{poId}/get-details',    'PurchaseOrdersController@getDetails')      ->name('admin.purchase-orders.get-details');
            \Route::post( '/{poId}/update-status',  'PurchaseOrdersController@updateStatus')    ->name('admin.purchase-orders.update-status');
            \Route::get(  '/{poId}/check-all',      'PurchaseOrdersController@checkAll')        ->name('admin.purchase-orders.check-all');
            \Route::get(  '/{poId}/confirm-delete', 'PurchaseOrdersController@getModalDelete')  ->name('admin.purchase-orders.confirm-delete');
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseOrders   = $this->purchaseOrder->pushCriteria(new PurchaseOrdersByCreatedAtDescending())->all();
        $pending          = $this->purchaseOrder->pushCriteria(new PurchaseOrdersWhereStatus())->all();
        $materials        = $this->material->pushCriteria(new MaterialsOutOfStock())->all();
        
        $page_title       = trans('admin/purchase-orders/general.page.index.title');
        $page_description = trans('admin/purchase-orders/general.page.index.description');

        return view('admin.purchase-orders.index', compact(
            'page_title',
            'page_description',
            'purchaseOrders',
            'materials',
            'pending'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title       = trans('admin/purchase-orders/general.page.create.title');
        $page_description = trans('admin/purchase-orders/general.page.create.description');

        return view('admin.purchase-orders.create', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data          = $request->only('description');
        $data['total'] = 0;
        $items         = $request->only('material');

        foreach ($items as $key => $pODetails) {
            foreach ($pODetails as $key => $pODetail) {
                if ( !isset($pODetail['total']) ) {
                    $pODetail['total'] = Helpers::getMaterialById($pODetail['material_id'])->price * $pODetail['quantity'];
                }
                $data['total'] += $pODetail['total'];
            }
        }

        $newPurchaseOrder = $this->purchaseOrder->create($data);

        foreach ($items as $key => $pODetails) {
            foreach ($pODetails as $key => $pODetail) {
                $pODetail['purchase_order_id'] = $newPurchaseOrder->id;
                $this->purchaseOrderDetail->create($pODetail);
            }
        }

        Flash::success( trans('admin/purchase-orders/general.status.created') );

        return redirect()->route('admin.purchase-orders.show', $newPurchaseOrder->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchaseOrder = $this->purchaseOrder
            ->pushCriteria(new PurchaseOrdersWithDetails())
            ->find($id);

        $page_title       = trans('admin/purchase-orders/general.page.show.title');
        $page_description = trans('admin/purchase-orders/general.page.show.description', ['name' => 'name']);

        return view('admin.purchase-orders.show', compact('page_title', 'page_description', 'purchaseOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchaseOrder    = $this->purchaseOrder->find($id);
        
        $page_title       = trans('admin/purchase-orders/general.page.edit.title');
        $page_description = trans('admin/purchase-orders/general.page.edit.description', ['name' => 'name']);

        return view('admin.purchase-orders.edit', compact('page_title', 'page_description', 'purchaseOrder'));
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
        $data          = $request->only('description');
        $data['total'] = 0;
        $items         = $request->only('material');
        $purchaseOrder = $this->purchaseOrder->pushCriteria(new PurchaseOrdersWithDetails())->find($id);

        foreach ($items as $key => $pODetails) {
            foreach ($pODetails as $key => $pODetail) {
                $data['total'] += $pODetail['total'];
            }
        }

        $this->purchaseOrder->update($data, $id);

        foreach ($purchaseOrder->purchaseOrderDetails as $key => $value) {
            $this->purchaseOrderDetail->delete($value->id);
        }

        foreach ($items as $key => $pODetails) {
            foreach ($pODetails as $key => $pODetail) {
                $pODetail['purchase_order_id'] = $id;
                $this->purchaseOrderDetail->create($pODetail);
            }
        }

        Flash::success( trans('admin/purchase-orders/general.status.updated') );

        return redirect()->route('admin.purchase-orders.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->purchaseOrder->delete($id);

        Flash::success( trans('admin/purchase-orders/general.status.deleted') );

        return view('/admin/purchase-orders');
    }

    /**
     * Delete Confirm
     *
     * @param   int   $id
     * @return  View
     */
    public function getModalDelete($id)
    {
        $error         = null;
        
        $purchaseOrder = $this->purchaseOrder->find($id);
        
        $modal_title   = trans('admin/purchase-orders/dialog.delete-confirm.title');
        $modal_route   = route('admin.purchase-orders.delete', array('id' => $purchaseOrder->id));
        $modal_body    = trans('admin/purchase-orders/dialog.delete-confirm.body', ['id' => $purchaseOrder->id, 'name' => 'name']);

        return view('modal_confirmation', compact('error', 'modal_route', 'modal_title', 'modal_body'));

    }

    public function print($id) {
        $purchaseOrder = $this->purchaseOrder->find($id);
        return view('admin.purchase-orders.print-po', compact('purchaseOrder'));
    }

    public function updateStatus($id)
    {
        $purchaseOrder = $this->purchaseOrderDetail->find($id);
        $material      = $this->material->find($purchaseOrder->material_id);

        if ($purchaseOrder->accepted == 0) {
            $purchaseOrder->accepted = 1;
            $material->stock += $purchaseOrder->quantity;
        } else {
            $purchaseOrder->accepted = 0;
            $material->stock -= $purchaseOrder->quantity;
        }

        $material->save();
        $purchaseOrder->save();
    }

    public function checkAll($id)
    {
        $purchaseOrder = $this->purchaseOrder->pushCriteria(new PurchaseOrdersWithDetails())->find($id);

        foreach ($purchaseOrder->purchaseOrderDetails as $key => $detail) {
            $detail->accepted = 1;
            $detail->save();
        }

        $this->purchaseOrder->update(['status' => 5], $id);

        Flash::success( trans('admin/purchase-orders/general.status.updated') );

        return redirect()->route('admin.purchase-orders.show', $id);
    }

    public function getDetails($id)
    {
        $purchaseOrder = $this->purchaseOrder->pushCriteria(new PurchaseOrdersWithDetails())->find($id);
        $materials     = [];

        foreach ($purchaseOrder->purchaseOrderDetails as $key => $material) {
            $materials[$key]['id']          = $material->material_id;
            $materials[$key]['name']        = $material->material->name;
            $materials[$key]['price']       = $material->material->price;
            $materials[$key]['quantity']    = $material->quantity;
            $materials[$key]['total']       = $material->total;
            $materials[$key]['description'] = $material->description;
        }

        return $materials;
    }
}
