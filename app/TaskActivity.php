<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 10.09.2015
 * Time: 21:17
 */

namespace WTT;


use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class TaskActivity extends Eloquent {

    protected $table = 'MLOGPROD.TBTASKACTIVITY';

    public function task()
    {
        return $this->belongsTo('WTT\Task', 'task_id');
    }
}