<?php

namespace WTT\Http\Controllers\Orders;

use Illuminate\Http\Request;

use WTT\Http\Requests;
use WTT\Http\Controllers\Controller;
use WTT\Repositories\Eloquent\EISRequestRepository;

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
        $requests = $this->EISRequestRepository->getOrders(10);
        return $requests;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
//        $var = ;
        return $this->EISRequestRepository->getSADDate($id);
//        return EISRequestInfo::find($id)->ehi_SunCla;
//        return EHI_SunCla::find($id)->eisRequestInfo;
    }

}
