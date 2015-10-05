<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 08.09.2015
 * Time: 14:30
 */

namespace WTT;


use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class NetworkNodeLink extends Eloquent {

    protected $table = 'MLOGPROD.TBNETWORK_NODE_LINK';

    public function network(){
        return $this->belongsTo('WTT\Network','network_id');
    }

    public function startNode()
    {
        return $this->belongsTo('WTT\NetworkNode', 'start_node_id');
    }

    public function endNode()
    {
        return $this->belongsTo('WTT\NetworkNode', 'end_node_id');
    }

}