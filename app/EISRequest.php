<?php

namespace WTT;

use Carbon\Carbon;
use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class EISRequest extends Eloquent
{
    protected $table = 'MLOGPROD.TBEISREQUEST';

    protected $visible = [
        'id'
        , 'eisRequestType'
//        , 'external_id'
        , 'external_id2'
        , 'sourcesystem'
        , 'region_id'
        , 'businessunit_id'
        , 'name'
        , 'description'
        , 'customer_id'
        , 'start_dt'
        , 'end_dt'
//        , 'eisRequestContacts'
        , 'taskExecution'
//        , 'projects'
        , 'tasks'
        , 'eisRequestActivities'
        , 'sadDate'
        , 'currentMilestone'
    ];

    protected $appends = [
        'sadDate'
    ];

    public function eisRequestInfos()
    {
        return $this->hasMany('WTT\EISRequestInfo', 'eisrequest_id');
    }

    public function eisRequestContacts()
    {
        return $this->hasMany('WTT\EISRequestContact', 'eisrequest_id');
    }

    public function eisRequestActivities()
    {
        return $this->hasMany('WTT\EISRequestActivity', 'eisrequest_id');
    }

    public function eisRequestType(){
        return $this->belongsTo('WTT\EISRequestType','eisrequesttype_id');
    }

    public function projects()
    {
        return $this->hasMany('WTT\Project', 'eisrequest_id');
    }

    public function tasks()
    {
        return $this->hasMany('WTT\Task', 'eisrequest_id');
    }

    public function taskExecution()
    {
        return $this->belongsTo('WTT\TaskExecution', 'executionlocation_id');
    }


    public function getSADDateAttribute()
    {
        return $this->attributes['sadDate'];
    }

    public function setSADDateAttribute($value)
    {
        $this->attributes['sadDate'] = Carbon::parse($value);
    }
}
