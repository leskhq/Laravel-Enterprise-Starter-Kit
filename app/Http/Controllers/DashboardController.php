<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Customer;
use App\Models\CustomerCandidate;
use App\Models\Sale;

use Carbon\Carbon;
use DateTime;
use DB;

class DashboardController extends Controller
{

    /**
     * Create a new dashboard controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Protect all dashboard routes. Users must be authenticated.
        $this->middleware('auth');
    }

    public function index() {
        $newCustomersCount = Customer::where(DB::raw('YEAR(created_at)'), Carbon::now()->year)
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->count();

        $salesThisMonthCount = Sale::whereBetween('order_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->count();

        $incomeThisMount = Sale::where('status', 2)
            ->whereBetween('transfer_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->select('nominal', 'shipping_fee', 'packing_fee')
            ->get();
        $incomeThisMountTotal = $incomeThisMount->sum(function ($sale) {
            return $sale->nominal + $sale->shipping_fee + $sale->packing_fee;
        });

        $chemicalIndex      = [1,2,3,4,8];
        $materialIndex      = [6,7];

        $saleDetails = [
            'chemicals' => [
                'value'     => 0,
                'color'     => 'green',
                'highlight' => '#00a65a',
                'label'     => 'Chemicals'
            ],
            'materials' => [
                'value'     => 0,
                'color'     => 'blue',
                'highlight' => '#0073b7',
                'label'     => 'Materials'
            ],
            'equipments' => [
                'value'     => 0,
                'color'     => 'red',
                'highlight' => '#dd4b39',
                'label'     => 'Equipments'
            ],
        ];

         $sales = Sale::
            whereBetween('transfer_date', [Carbon::now()->startOfMonth(), Carbon::today()])
            ->get();

        foreach ($sales as $key => $row) {
            foreach($row->saleDetails as $key => $d) {
                if(in_array( $d->product->category, $chemicalIndex)) {
                    $saleDetails['chemicals']['value'] += $d->total;
                } elseif (in_array( $d->product->category, $materialIndex)) {
                    $saleDetails['materials']['value'] += $d->total;
                } else {
                    $saleDetails['equipments']['value'] += $d->total;
                }
            }
        }

        $salesLastMonth = Sale::
            whereBetween('transfer_date', [new DateTime('first day of previous month'), new DateTime('last day of previous month')])
            ->get();

        $saleDetailsLastMonth = [
            'chemicals' => [
                'value'          => 0,
                'valueThisMonth' => $saleDetails['chemicals']['value'],
                'label'          => 'Chemicals'
            ],
            'materials' => [
                'value'          => 0,
                'valueThisMonth' => $saleDetails['materials']['value'],
                'label'          => 'Materials'
            ],
            'equipments' => [
                'value'          => 0,
                'valueThisMonth' => $saleDetails['equipments']['value'],
                'label'          => 'Equipments'
            ],
        ];

        foreach ($salesLastMonth as $key => $row) {
            foreach($row->saleDetails as $key => $d) {
                if(in_array( $d->product->category, $chemicalIndex)) {
                    $saleDetailsLastMonth['chemicals']['value'] += $d->total;
                } elseif (in_array( $d->product->category, $materialIndex)) {
                    $saleDetailsLastMonth['materials']['value'] += $d->total;
                } else {
                    $saleDetailsLastMonth['equipments']['value'] += $d->total;
                }
            }
        }

        $page_title = "Dashboard";
        $page_description = "This is the dashboard";

        flash('Welcome Aboard!');

        return view('dashboard', compact(
            'page_title',
            'page_description',
            'newCustomersCount',
            'salesThisMonthCount',
            'incomeThisMountTotal',
            'saleDetails',
            'saleDetailsLastMonth'));
    }

    public function search(Request $request) {
        $keyword = $request->input('term');

        $products      = Product::where('name', 'like', '%'.$keyword.'%')
                        ->orderBy('name', 'ASC')
                        ->get();

        $customers     = Customer::where('name', 'LIKE', '%'.$keyword.'%')
                        ->orWhere('address',     'LIKE', '%'.$keyword.'%')
			->orWhere('laundry_address', 'LIKE', '%'.$keyword.'%')
			->orWhere('send_address', 'LIKE', '%'.$keyword.'%')
                        ->orWhere('phone',       'LIKE', '%'.$keyword.'%')
                        ->get();

        # TODO: create sales search by customer name

        $customerCandidates = CustomerCandidate::where('name','LIKE', '%'.$keyword.'%')
                ->orWhere('address', 'LIKE', '%'.$keyword.'%')
                ->orWhere('phone',   'LIKE', '%'.$keyword.'%')
                ->get();

        $page_title       = trans('general.page.search.title');
        $page_description = trans('general.page.search.description', ['keyword' => $keyword]);

        return view('search', compact(
            'page_title',
            'page_description',
            'keyword',
            'products',
            'customers',
            'customerCandidates'
        ));
    }

}
