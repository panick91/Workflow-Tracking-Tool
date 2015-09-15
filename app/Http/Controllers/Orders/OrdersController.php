<?php

namespace WTT\Http\Controllers\Orders;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use WTT\Http\Requests;
use WTT\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Orders;

class OrdersController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        $ordersData = $this->EISRequestRepository->getOrders(Paginator::resolveCurrentPage(),10);
        $ordersData = Orders::getOrders(Paginator::resolveCurrentPage(),10);

        $paginator = new LengthAwarePaginator($ordersData->orders,
            $ordersData->count,
            10,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]);

        return $paginator;
    }


    /**
     * Display the specified resource.
     *
     * @param $external_id2
     * @return Response
     */
    public function show($external_id2)
    {
        $order = Orders::getOrder($external_id2);
        if($order == null)
            App::abort(204);
        return $order;
    }

}
