<?php

namespace WTT\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    protected function validateId(Request $request, $value){
        $validator = \Validator::make(
            [
                'eIsRequestId' => $value
            ],
            [
                'eIsRequestId' => ['integer']
            ]
        );
        if($validator->fails()){
            $this->throwValidationException($request, $validator);
        }
        return true;
    }
}
