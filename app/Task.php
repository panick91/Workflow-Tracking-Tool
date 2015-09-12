<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 10.09.2015
 * Time: 21:17
 */

namespace WTT;


use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Task extends Eloquent {

    protected $table = 'MLOGPROD.TBTASK';

    public function taskActivites()
    {
        return $this->hasMany('WTT\TaskActivity', 'task_id');
    }

    public function eisRequest()
    {
        return $this->belongsTo('WTT\EISRequest', 'eisrequest_id');
    }

    public function project()
    {
        return $this->belongsTo('WTT\Project', 'project_id');
    }
}