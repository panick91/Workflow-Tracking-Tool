<?php

namespace WTT\Http\Controllers;

use Illuminate\Http\Request;

use WTT\Enumerations\WorkflowState;
use WTT\Http\Requests;
use WTT\Http\Controllers\Controller;

class ProjectStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(new WorkflowState());
    }
}
