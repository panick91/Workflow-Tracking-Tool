<?php

namespace WTT\Http\Controllers\Orders;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use WTT\Http\Requests;
use WTT\Http\Controllers\Controller;
use Orders;

class DeviationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request, $eIsRequestId)
    {
        $this->validateId($request, $eIsRequestId);

        $data = Orders::getDeviations($eIsRequestId);
        if ($data === null)
            App::abort(204);
        return $data;
    }
}
