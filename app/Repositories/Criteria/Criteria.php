<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 06.09.2015
 * Time: 01:08
 */

namespace WTT\Repositories\Criteria;

use WTT\Repositories\Contracts\RepositoryInterface as Repository;
use WTT\Repositories\Contracts\RepositoryInterface;

abstract class Criteria {

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public abstract function apply($model, Repository $repository);
}