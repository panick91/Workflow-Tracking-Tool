<?php

namespace WTT\Http\Controllers\Orders;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use WTT\Enumerations\WorkflowState;
use WTT\Http\Requests;
use WTT\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Orders;

class OrdersController extends Controller
{

    protected $serviceId = null;
    protected $customer = null;
    protected $siteId = null;
    protected $gvNumber = null;
    protected $status = null;

    public function __construct()
    {
        if (Input::has('serviceId')) {
            $this->serviceId = Input::get('serviceId');
        }
        if (Input::has('customer')) {
            $this->customer = Input::get('customer');
        }
        if (Input::has('siteId')) {
            $this->siteId = Input::get('siteId');
        }
        if (Input::has('gvNumber')) {
            $this->gvNumber = Input::get('gvNumber');
        }
        if (Input::has('status')) {
            $this->status = Input::get('status');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'serviceId' => 'alpha_num|max:10',
            'customer' => 'string|max:255',
            'siteId' => 'alpha_dash|max:255',
            'gvNumber' => 'alpha_dash|max:255',
            'status' => 'in:'.WorkflowState::getCSV()
        ]);

        $ordersData = Orders::getOrdersFiltered(Paginator::resolveCurrentPage()
            , 10
            , $this->serviceId
            , $this->customer
            , $this->siteId
            , $this->gvNumber
            , $this->status);

        $paginator = new LengthAwarePaginator($ordersData->orders,
            $ordersData->count,
            10,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]);

        return $paginator;
    }


    /**
     * @param $eIsRequestId
     * @return mixed
     */
    public function show(Request $request, $eIsRequestId)
    {
        $this->validateId($request, $eIsRequestId);

        $order = Orders::getOrder($eIsRequestId);
        if ($order == null)
            App::abort(204);
        return $order;
    }

}
