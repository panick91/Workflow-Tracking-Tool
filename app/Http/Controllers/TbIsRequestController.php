<?php

namespace WTT\Http\Controllers;

use Illuminate\Http\Request;

use WTT\Http\Requests;
use WTT\Http\Controllers\Controller;
use WTT\Repositories\Eloquent\TbIsRequestRepository;
use WTT\TBISREQUEST;

class TbIsRequestController extends Controller
{
    /**
     * @var TbIsRequestRepository
     */
    private $tbIsRequestRepository;

    public function __construct(TbIsRequestRepository $tbIsRequestRepository)
    {
        $this->tbIsRequestRepository = $tbIsRequestRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $requests = $this->tbIsRequestRepository->paginate(15);
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
        //
    }

}
