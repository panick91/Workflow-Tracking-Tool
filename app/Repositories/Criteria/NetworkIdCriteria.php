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

class NetworkIdCriteria extends Criteria
{

    private $networkId;

    public function __construct($networkId)
    {
        $this->networkId = $networkId;
    }

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $query = $model->where('id',$this->networkId);

        return $query;
    }
}