<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 15.09.2015
 * Time: 21:27
 */

namespace WTT;


use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class EISRequestType extends Eloquent {

    protected $table = 'MLOGPROD.TBEISREQUESTTYPE';

    protected $visible = [
        'name'
        , 'description'
    ];

    public function eisRequest(){
        return $this->hasMany('WTT\EISRequest','eisrequesttype_id');
    }

}