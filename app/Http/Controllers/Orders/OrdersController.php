<?php

namespace WTT\Http\Controllers\Orders;

use Illuminate\Http\Request;

use WTT\Http\Requests;
use WTT\Http\Controllers\Controller;
use WTT\Repositories\Eloquent\EISRequestRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class OrdersController extends Controller
{
    /**
     * @var EISRequestRepository
     */
    private $EISRequestRepository;

    public function __construct(EISRequestRepository $EISRequestRepository)
    {
        $this->EISRequestRepository = $EISRequestRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $ordersData = $this->EISRequestRepository->getOrders(Paginator::resolveCurrentPage(),10);

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
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return $this->EISRequestRepository->getSADDate($id);
    }

}
