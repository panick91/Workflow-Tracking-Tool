<?php

namespace WTT\Http\Controllers\Orders;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use WTT\Http\Requests;
use WTT\Http\Controllers\Controller;
use Activities;
use Orders;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($external_id2)
    {
        $orderId = Orders::getIdByExternalId2($external_id2);

        if($orderId === -1){
            App::abort(204);
        }

        $activities = Activities::getActivities(
            $orderId
            , Paginator::resolveCurrentPage()
            , 10);

        $paginator = new LengthAwarePaginator($activities->orders,
            $activities->count,
            10,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]);

        return $paginator;
    }
}
