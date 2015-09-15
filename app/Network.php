<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 08.09.2015
 * Time: 14:30
 */

namespace WTT;


use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Network extends Eloquent
{

    protected $table = 'MLOGPROD.TBNETWORK';

    public function projects()
    {
        return $this->hasMany('WTT\Project', 'network_id');
    }

    public function networkNodes()
    {
        return $this->hasMany('WTT\NetworkNode', 'network_id');
    }

    public function milestones()
    {
        return $this->hasMany('WTT\NetworkNode', 'network_id')->where('milestone','1');
    }
}