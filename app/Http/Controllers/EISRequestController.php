<?php

namespace WTT\Http\Controllers;

use Illuminate\Http\Request;

use WTT\Http\Requests;
use WTT\Http\Controllers\Controller;
use WTT\Repositories\Eloquent\EISRequestRepository;
use WTT\EISRequest;

class EISRequestController extends Controller
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
        $requests = $this->EISRequestRepository->paginate(15);
        return $requests;
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return $this->EISRequestRepository->getSADDate($id);
    }

}
