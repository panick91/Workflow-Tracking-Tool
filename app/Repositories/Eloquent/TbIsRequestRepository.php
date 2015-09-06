<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 06.09.2015
 * Time: 01:04
 */

namespace WTT\Repositories\Eloquent;



class TbIsRequestRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'WTT\TBISREQUEST';
    }
}