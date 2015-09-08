<?php

namespace WTT;

use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class EISRequest extends Eloquent
{
    protected $table = 'MLOGPROD.TBEISREQUEST';

    protected $visible = [
        'id'
        , 'eisrequesttype_id'
        , 'external_id'
        , 'external_id2'
        , 'sourcesystem'
        , 'region_id'
        , 'businessunit_id'
        , 'name'
        , 'description'
        , 'customer_id'
        , 'start_dt'
        , 'end_dt'
        , 'sadDates'
        , 'eisRequestInfos'
        , 'eisRequestContacts'
        , 'taskExecution'
    ];

    public function eisRequestInfos()
    {
        return $this->hasMany('WTT\EISRequestInfo', 'eisrequest_id');
    }

    public function sadDates()
    {
        return $this->hasManyThrough('WTT\EHI_SunCla', 'WTT\EISRequestInfo', 'eisrequest_id', 'id')->select('deliverydt');
    }

    public function eisRequestContacts()
    {
        return $this->hasMany('WTT\EISRequestContact', 'eisrequest_id');
    }

    public function taskExecution()
    {
        return $this->belongsTo('WTT\TaskExecution', 'executionlocation_id');
    }

}
