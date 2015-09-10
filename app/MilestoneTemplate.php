<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 08.09.2015
 * Time: 14:31
 */

namespace WTT;


use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class MilestoneTemplate extends Eloquent {

    protected $table = 'MLOGPROD.TBMILESTONETEMPLATE';

    public function networkNodes()
    {
        return $this->hasMany('WTT\NetworkNode', 'milestonetemplate_id  ');
    }
}