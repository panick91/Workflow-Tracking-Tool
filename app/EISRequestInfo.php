<?php

namespace WTT;

use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class EISRequestInfo extends Eloquent
{
    protected $table = 'MLOGPROD.TBEISREQUESTINFO';

    protected $visible = [
        'id'
        , 'eisrequest_id'
        , 'ehi_SunCla'
        , 'eisRequest'
    ];

    public function ehi_SunCla()
    {
        return $this->hasOne('WTT\EHI_SunCla', 'id');
    }

    public function eisRequest()
    {
        return $this->belongsTo('WTT\EISRequest', 'EISREQUEST_ID');
    }
}
