<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 06.09.2015
 * Time: 01:19
 */

namespace WTT\Repositories\Criteria;

use WTT\Repositories\Contracts\RepositoryInterface as Repository;
use WTT\Repositories\Contracts\RepositoryInterface;

class ServiceIdCriteria extends Criteria
{

    private $serviceId = '';

    public function __construct($serviceId)
    {
        $this->serviceId = $serviceId;
    }

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $query = $model->where('LOWER(external_id2)','like','%'.strtolower($this->serviceId).'%');

        return $query;
    }
}