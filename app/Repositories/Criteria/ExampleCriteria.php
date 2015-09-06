<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 06.09.2015
 * Time: 01:19
 */

namespace WTT\Repositories\Criteria;

use WTT\Repositories\Criteria\Criteria;
use WTT\Repositories\Contracts\RepositoryInterface as Repository;
use WTT\Repositories\Contracts\RepositoryInterface;

class ExampleCriteria extends Criteria {

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $query = $model->where('length', '>', 120);
        return $query;
    }
}