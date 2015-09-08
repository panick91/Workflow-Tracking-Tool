<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 07.09.2015
 * Time: 10:59
 */

namespace WTT;


use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class EHI_SunCla extends Eloquent
{

    protected $table = 'MLOGPROD.TBEHI_SUNCLA';

    protected $visible = [
        'id'
        , 'deliverydt'
        , 'eisRequestInfo'
    ];

    public function eisRequestInfo()
    {
        return $this->belongsTo('WTT\EISRequestInfo', 'id');
    }
}