<?php

namespace WTT\Http\Controllers\Orders;


use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use WTT\Http\Requests;
use WTT\Http\Controllers\Controller;
use Activities;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request, $eIsRequestId)
    {
        $this->validateId($request, $eIsRequestId);

        $activities = Activities::getActivities(
            $eIsRequestId
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
