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

class CustomerCriteria extends Criteria
{

    private $customerName = '';

    public function __construct($customerName)
    {
        $this->customerName = $customerName;
    }

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $query = $model->whereHas('taskExecution', function($query) {
            $query->where('LOWER(location_name)','like','%'.strtolower($this->customerName).'%');
        });

        return $query;
    }
}