<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 10.09.2015
 * Time: 21:16
 */

namespace WTT;


use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class ProjectActivity extends Eloquent {

    protected $table = 'MLOGPROD.TBPROJECT_ACTIVITY';

    public function project()
    {
        return $this->belongsTo('WTT\Project', 'project_id');
    }
}