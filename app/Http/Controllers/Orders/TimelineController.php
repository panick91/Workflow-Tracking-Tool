<?php

namespace WTT\Http\Controllers\Orders;

use Illuminate\Http\Request;

use WTT\Http\Requests;
use WTT\Http\Controllers\Controller;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($orderId)
    {
        return 'Timeline Index';
    }
}
