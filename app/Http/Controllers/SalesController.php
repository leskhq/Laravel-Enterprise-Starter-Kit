<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\SaleRepository as Sale;
use App\Repositories\CustomerRepository as Customer;
use App\Repositories\SaleDetailRepository as SaleDetail;
use App\Repositories\FormulaRepository as Formula;
use App\Repositories\MaterialRepository as Material;
use App\Repositories\Criteria\Sale\SalesWithCustomers;
use App\Repositories\Criteria\Sale\SalesWithSaleDetails;
use App\Repositories\Criteria\Sale\SalesByTransferDateDescending;
use App\Repositories\Criteria\Sale\SalesByTransferDateAscending;
use App\Repositories\Criteria\Sale\SalesByShipDateAscending;
use App\Repositories\Criteria\Sale\SalesByOrderDateDescending;
use App\Repositories\Criteria\Sale\SalesOrderAfter;
use App\Repositories\Criteria\Sale\SalesOrderBefore;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;
use Excel;

class SalesController extends Controller
{
    private $sale;

    private $customer;

    private $saleDetail;

    private $formula;

    private $material;

    public function __construct(Sale $sale, Customer $customer, SaleDetail $saleDetail, Formula $formula, Material $material)
    {
        $this->sale       = $sale;
        $this->customer   = $customer;
        $this->saleDetail = $saleDetail;
        $this->formula    = $formula;
        $this->material   = $material;
    }

    static function routes() {
        \Route::group(['prefix' => 'sales'], function () {
            \Route::get(  '/',                     'SalesController@index')             ->name('admin.sales.index');
            \Route::post( '/',                     'SalesController@store')             ->name('admin.sales.store');
            \Route::get(  '/create',               'SalesController@create')            ->name('admin.sales.create');
            \Route::get(  '/report',               'SalesController@report')            ->name('admin.sales.report');
            \Route::post( '/export',               'SalesController@export')            ->name('admin.sales.export');
            \Route::get(  '/{sId}',                'SalesController@show')              ->name('admin.sales.show');
            \Route::patch('/{sId}',                'SalesController@update')            ->name('admin.sales.update');
            \Route::get(  '/{sId}/edit',           'SalesController@edit')              ->name('admin.sales.edit');
            \Route::get(  '/{sId}/excel',          'SalesController@excel')             ->name('admin.sales.excel');
            \Route::get(  '/{sId}/print',          'SalesController@printTemp')         ->name('admin.sales.print');
            \Route::get(  '/{sId}/delete',         'SalesController@destroy')           ->name('admin.sales.delete');
            \Route::post( '/getReportData',        'SalesController@getReportData')     ->name('admin.sales.get-report-data');
            \Route::post( '/getReportDataByShipDate', 'SalesController@getReportDataShip')->name('admin.sales.get-report-data-by-ship-date');
            \Route::post( '/select-by-status',     'SalesController@selectByStatus')    ->name('admin.sales.select-by-status');
            \Route::post( '/{sId}/update-status',  'SalesController@updateStatus')      ->name('admin.sales.update-status');
            \Route::get(  '/{sId}/confirm-delete', 'SalesController@getModalDelete')    ->name('admin.sales.confirm-delete');
            \Route::get(  '/{sId}/formula',        'SalesController@formula')           ->name('admin.sales.formula');
	    \Route::get(  '{sId}/print-prod',      'SalesController@printProd')         ->name('admin.sales.print-prod');
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = $this->sale
            ->pushCriteria(new SalesWithCustomers())
            ->pushCriteria(new SalesByTransferDateDescending())
            ->all();

        $page_title       = trans('admin/sales/general.page.index.title');
        $page_description = trans('admin/sales/general.page.index.description');

        return view('admin.sales.index', compact('sales', 'page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title       = trans('admin/sales/general.page.create.title');
        $page_description = trans('admin/sales/general.page.create.description');

        return view('admin.sales.create', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data    = $request->all();
        $items   = $request->input('item');
        $nominal = 0;

        // because database cannot read null
        if ($data['transfer_date'] == '') {
            $data['transfer_date'] = null;
        } else {
            $data['status'] = 2;
        }

        if ($data['ship_date'] == '') {
            $data['ship_date'] = null;
        }
        if ($data['estimation_date'] == '') {
            $data['estimation_date'] = null;
        }

        // if the id is null then it must be a new customer
        if ( $data['customer_id'] == null ) {
            $newCustomer = $this->customer->create($data);
            // get the id from the brand new customer
            $data['customer_id'] = $newCustomer->id;
        }

        // get the customer name from its ID
        // $data['name'] = $this->customer->find( $data['customer_id'] )->name;

        // loop all the items to define the total sale nominal
        foreach($items as $order) {
            if ( $order['product_id'] != '' ) {
                $nominal += $order['total'];
            }
        }
        $data['nominal'] = $nominal;
        // save sale
        $newSale = $this->sale->create($data);

        foreach($items as $order) {
            if ( $order['product_id'] != '' ) {
                // get sale id for each sale details column
                $order['sale_id'] = $newSale->id;
                // save detail sale
                $this->saleDetail->create( $order );
            }
        }

        Flash::success( trans('admin/sales/general.status.created') ); // 'Sale successfully created');

        return redirect('admin/sales');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale             = $this->sale->pushCriteria(new SalesWithSaleDetails())->find($id);
        
        $page_title       = trans('admin/sales/general.page.show.title');
        $page_description = trans('admin/sales/general.page.show.description', ['name' => $sale->customer->name]);

        return view('admin.sales.show', compact('sale', 'page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale             = $this->sale->find($id);
        
        $page_title       = trans('admin/sales/general.page.edit.title');
        $page_description = trans('admin/sales/general.page.edit.description', ['name' => $sale->customer->name]);

        return view('admin.sales.edit', compact('page_title', 'page_description', 'sale'));
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
        $data    = $request->except(['item', 'productName', 'baseWeight', 'customer_id', '_method', '_token']);
        $items   = $request->input('item');
        $nominal = 0;
        $status  = $this->sale->find($id)->status;

        // because database cannot read null
        if ($data['transfer_date'] == '') {
            $data['transfer_date'] = null;
        }
        if ($data['ship_date'] == '') {
            $data['ship_date'] = null;
        }
        if ($data['estimation_date'] == '') {
            $data['estimation_date'] = null;
        }

        if ($data['transfer_date'] != '' && $data['transfer_date'] != '0000-00-00') {
            if ($status == 1) {
                $data['status'] = 2;
            }
        }

        // loop all the items to define the new total nominal of sale
        foreach($items as $order) {
            if ( $order['product_id']!='' ) {
                $nominal += $order['total'];
            }
        }

        $data['nominal'] = $nominal;
        // update sale
        $this->sale->update($data, $id);

        // get all the saleDetail sale from this sale
        $saleDetails = $this->saleDetail->findWhere(['sale_id' => $id]);

        // loop the saleDetail and delete each one of them
        foreach ($saleDetails as $key => $value) {
            $this->saleDetail->delete($value->id);
        }

        // replace the saleDetail sale for this sale
        foreach($items as $order) {
            if ($order['product_id']!='') {
                $order['sale_id'] = $id;
                $this->saleDetail->create( $order );
            }
        }

        Flash::success( trans('admin/sales/general.status.updated') ); // 'Sale successfully updated');

        return redirect()->route('admin.sales.show', $id);
    }

    public function updateStatus($id)
    {
        $status       = $_POST['status'];
        
        $sale         = $this->sale->find($id);
        $sale->status = $status;
        $sale->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->sale->delete($id);

        Flash::success( trans('admin/sales/general.status.deleted') );

        return redirect('/admin/sales');
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
        
        $sale        = $this->sale->find($id);
        
        $modal_title = trans('admin/sales/dialog.delete-confirm.title');
        $modal_route = route('admin.sales.delete', array('id' => $sale->id));
        $modal_body  = trans('admin/sales/dialog.delete-confirm.body', ['id' => $sale->id, 'name' => $sale->customer->name]);

        return view('modal_confirmation', compact('error', 'modal_route', 'modal_title', 'modal_body'));

    }

    /**
     * export to excel function
     * @param  int $id sale id
     * @return xls     excel doc extension
     */
    public function excel($id) {
        $customer     = $this->sale->find($id)->customer;

        Excel::create('PO - '.$customer->name.'', function($excel) use($id) {
            $excel->sheet('DetailPO', function($sheet) use($id) {
                $sale     = $this->sale->find($id);
                $customer = $this->sale->find($id)->customer;
                $details  = $this->sale->find($id)->saleDetails;
                $sheet->loadView('admin.sales.excel', ['sale' => $sale, 'customer' => $customer, 'details' => $details]);
            });
        })->download('xls');
    }

    public function selectByStatus()
    {
        $status = $_POST['query'];

        $sales = $this->sale->pushCriteria(new SalesByOrderDateDescending())->findWhere(['status' => $status]);

        return view('admin.sales.get-by-status', compact('sales'));
    }

    public function printTemp($id)
    {
        $sale = $this->sale->find($id);

        return view('admin.sales.print', compact('sale'));
    }
    public function printProd($id) {
	$sale = $this->sale->find($id);
	return view('admin.sales.print-prod', compact('sale'));
    }

    public function report()
    {
        $page_title       = trans('admin/sales/general.page.report.title');
        $page_description = trans('admin/sales/general.page.report.description');

        return view('admin.sales.report', compact('page_title', 'page_description'));
    }

    public function export()
    {
        Excel::create('Penjualan', function($excel) {
			$excel->sheet('Penjualan', function($sheet) {
    			$sales              = $this->sale
                                    ->pushCriteria(new SalesWithSaleDetails())
                                    ->pushCriteria(new SalesByTransferDateAscending())
                                    ->pushCriteria(new SalesOrderAfter($_POST['eStart']))
                                    ->pushCriteria(new SalesOrderBefore($_POST['eEnd']))
                                    ->all();
                $chemicalIndex      = [1,2,3,4,8];
        		$materialIndex      = [6,7];
                $chemicals          = 0;
        		$materials          = 0;
                $equipments         = 0;
                $no                 = 1;
                $total              = 0;
                $total_shipping_fee = 0;
		$total_packing_fee  = 0;

                foreach ($sales as $key => $row) {
        	        foreach($row->saleDetails as $key => $d) {
                        if(in_array( $d->product->category, $chemicalIndex)) {
                            $chemicals += $d->total;
                        } elseif (in_array( $d->product->category, $materialIndex)) {
                            $materials += $d->total;
                        } else {
                            $equipments += $d->total;
                        }
        	       }
                }

        		$sheet->loadView('admin.sales.sale-reports-export',
                    [
                        'sales'              => $sales,
                        'materials'          => $materials,
                        'equipments'         => $equipments,
                        'chemicals'          => $chemicals,
                        'no'                 => $no,
                        'total'              => $total,
                        'total_shipping_fee' => $total_shipping_fee,
                        'total_packing_fee'  => $total_packing_fee,
                        'chemicalIndex'      => $chemicalIndex,
                        'materialIndex'      => $materialIndex
                    ]);
            });
		})->download('xls');
    }

    public function getReportData()
    {
        $sales              = $this->sale
                            ->pushCriteria(new SalesWithSaleDetails())
                            ->pushCriteria(new SalesByTransferDateAscending())
                            ->pushCriteria(new SalesOrderAfter($_POST['start']))
                            ->pushCriteria(new SalesOrderBefore($_POST['end']))
                            ->all();

        $chemicalIndex      = [1,2,3,4,8];
		$materialIndex      = [6,7];

		$chemicals          = 0;
		$materials          = 0;
        $equipments         = 0;

        $no                 = 1;
        $total              = 0;
        $total_shipping_fee = 0;
        $total_packing_fee  = 0;
        foreach ($sales as $key => $row) {
            foreach($row->saleDetails as $key => $d) {
                if(in_array( $d->product->category, $chemicalIndex)) {
                    $chemicals += $d->total;
                } elseif (in_array( $d->product->category, $materialIndex)) {
                    $materials += $d->total;
                } else {
                    $equipments += $d->total;
                }
            }
        }

        return view('admin.sales.get-report-data', compact(
                'sales',
                'chemicalIndex',
                'materialIndex',
                'chemicals',
                'materials',
                'equipments',
                'no',
                'total',
                'total_shipping_fee',
                'total_packing_fee'
            ));
    }
    
    public function getReportDataShip()
    {
        $sales              = $this->sale
                            ->pushCriteria(new SalesWithSaleDetails())
                            ->pushCriteria(new SalesByShipDateAscending())
                            ->pushCriteria(new SalesOrderAfter($_POST['start']))
                            ->pushCriteria(new SalesOrderBefore($_POST['end']))
                            ->all();

        $chemicalIndex      = [1,2,3,4,8];
        $materialIndex      = [6,7];

        $chemicals          = 0;
        $materials          = 0;
        $equipments         = 0;

        $no                 = 1;
        $total              = 0;
        $total_shipping_fee = 0;
        $total_packing_fee  = 0;
        foreach ($sales as $key => $row) {
            foreach($row->saleDetails as $key => $d) {
                if(in_array( $d->product->category, $chemicalIndex)) {
                    $chemicals += $d->total;
                } elseif (in_array( $d->product->category, $materialIndex)) {
                    $materials += $d->total;
                } else {
                    $equipments += $d->total;
                }
            }
        }

        return view('admin.sales.get-report-data', compact(
                'sales',
                'chemicalIndex',
                'materialIndex',
                'chemicals',
                'materials',
                'equipments',
                'no',
                'total',
                'total_shipping_fee',
                'total_packing_fee'
            ));
    }

    public function formula($id)
    {
        $sale   = $this->sale->pushCriteria(new SalesWithSaleDetails())->find($id);
        $data   = [];
        $total  = [];
        $newVar = [];
        $x      = 1;

        $page_title       = trans('admin/sales/general.page.formula.title');
        $page_description = trans('admin/sales/general.page.formula.description', ['name' => $sale->customer->name]);

        foreach ($sale->saleDetails as $key => $d) {
            $data[$d->product->name]['quantity'] = $d->quantity;
            $formula = $this->formula->findBy('product_id', $d->product_id);
            if ($formula) {
                $data[$d->product->name]['materials'] = $formula->formulaDetails;
            }
        }

        return view('admin.sales.get-formula', compact(
            'data',
            'total',
            'newVar',
            'page_title',
            'page_description',
            'x',
            'sale'
        ));
    }
}
