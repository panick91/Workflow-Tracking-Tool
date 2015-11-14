<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 08.09.2015
 * Time: 14:29
 */

namespace WTT;


use Carbon\Carbon;
use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Project extends Eloquent
{

    protected $table = 'MLOGPROD.TBPROJECT';

    protected $dates = ['update_dt'];

    public function tasks()
    {
        return $this->hasMany('WTT\Task', 'project_id');
    }

    public function projectActivites()
    {
        return $this->hasMany('WTT\ProjectActivity', 'project_id');
    }

    public function eisRequest()
    {
        return $this->belongsTo('WTT\EISRequest', 'eisrequest_id');
    }

    public function network()
    {
        return $this->belongsTo('WTT\Network', 'network_id');
    }

    public function setUpdateDtAttribute($value)
    {
        $this->attributes['update_dt'] = Carbon::parse($value);
    }
}