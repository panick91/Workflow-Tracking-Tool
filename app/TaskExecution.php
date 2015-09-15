<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 08.09.2015
 * Time: 11:04
 */

namespace WTT;


use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class TaskExecution extends Eloquent
{

    protected $table = 'MLOGPROD.TBTASKEXECUTION';

    protected $visible = [
        'name'
        , 'name2'
        , 'name3'
        , 'title'
        , 'firstname'
        , 'lastname'
        , 'jobtitle'
        , 'street'
        , 'housenumber'
        , 'shortzipcode'
        , 'city'
        , 'countrycode'
        , 'contact'
        , 'additionalline'
        , 'phone'
        , 'phone2'
        , 'phone3'
        , 'email'
        , 'contact_name'
        , 'contact_name2'
        , 'contact_name3'
        , 'contact_title'
        , 'contact_firstname'
        , 'contact_lastname'
        , 'contact_jobtitle'
        , 'contact_street'
        , 'contact_housenumber'
        , 'contact_shortzipcode'
        , 'contact_city'
        , 'contact_subcityname'
        , 'contact_countrycode'
        , 'contact_additionalline'
        , 'contact_phone'
        , 'contact_phone2'
        , 'contact_phone3'
        , 'contact_companyname'
        , 'location_name'

    ];

    public function eisRequests()
    {
        return $this->hasMany('WTT\EISRequest', 'executionlocation_id');
    }
}