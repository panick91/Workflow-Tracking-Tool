<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 08.09.2015
 * Time: 11:04
 */

namespace WTT;


use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class TaskExecution extends Eloquent
{

    protected $table = 'MLOGPROD.TBTASKEXECUTION';

    public function eisRequests(){
        return $this->hasMany('WTT\EISRequest','executionlocation_id');
    }
}