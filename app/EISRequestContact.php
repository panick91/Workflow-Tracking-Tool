<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 08.09.2015
 * Time: 11:05
 */

namespace WTT;


use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class EISRequestContact extends Eloquent
{

    protected $table = 'MLOGPROD.TBEISREQUESTCONTACT';

    public function eisRequest()
    {
        return $this->belongsTo('WTT\EISRequest', 'eisrequest_id');
    }

}