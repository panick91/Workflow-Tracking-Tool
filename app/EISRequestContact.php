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

    protected $visible = [
        'contact_type'
        , 'name'
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
        , 'subcityname'
        , 'countrycode'
        , 'location'
        , 'contact'
        , 'additionalline'
        , 'phone'
        , 'phone2'
        , 'phone3'
        , 'web'
        , 'email'
        , 'contactlanguage'
        , 'companyname'
        , 'organization'

    ];

    public function eisRequest()
    {
        return $this->belongsTo('WTT\EISRequest', 'eisrequest_id');
    }

}