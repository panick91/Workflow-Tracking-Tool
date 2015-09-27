<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 08.09.2015
 * Time: 14:30
 */

namespace WTT;


use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class NetworkNode extends Eloquent {

    protected $table = 'MLOGPROD.TBNETWORK_NODE';

    protected $visible = [
        'id'
        , 'name'
        , 'state'
        , 'milestone_deadline'
        , 'milestone_completed_dt'
        , 'milestoneTemplate'
    ];

    public function network()
    {
        return $this->belongsTo('WTT\Network', 'network_id');
    }

    public function milestoneTemplate()
    {
        return $this->belongsTo('WTT\MilestoneTemplate', 'milestonetemplate_id');
    }
}