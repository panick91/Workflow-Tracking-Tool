<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 08.09.2015
 * Time: 14:29
 */

namespace WTT;


use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Project extends Eloquent
{

    protected $table = 'MLOGPROD.TBPROJECT';

    public function eisRequest()
    {
        return $this->belongsTo('WTT\EISRequest', 'eisrequest_id');
    }

    public function network()
    {
        return $this->belongsTo('WTT\Network', 'network_id');
    }
}