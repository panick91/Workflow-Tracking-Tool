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
        , 'network_id'
        , 'prependingNodes'
        , 'isCrawled'
    ];

    public function network()
    {
        return $this->belongsTo('WTT\Network', 'network_id');
    }

    public function milestoneTemplate()
    {
        return $this->belongsTo('WTT\MilestoneTemplate', 'milestonetemplate_id');
    }

    public function incomingLinks()
    {
        return $this->hasMany('WTT\NetworkNodeLink', 'end_node_id');
    }

    public function outgoingLinks()
    {
        return $this->hasMany('WTT\NetworkNodeLink', 'start_node_id');
    }
}