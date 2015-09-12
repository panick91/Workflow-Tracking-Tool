<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 10.09.2015
 * Time: 21:10
 */

namespace WTT;


use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class EISRequestActivity extends Eloquent {

    protected $table = 'MLOGPROD.TBEISREQUESTACTIVITY';

    public function eisRequest()
    {
        return $this->belongsTo('WTT\EISRequest', 'eisrequest_id');
    }
}