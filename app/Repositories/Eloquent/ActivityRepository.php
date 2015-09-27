<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 06.09.2015
 * Time: 01:04
 */

namespace WTT\Repositories\Eloquent;

use \StdClass;
use WTT\Repositories\Contracts\ActivityRepositoryInterface;

class ActivityRepository extends Repository implements ActivityRepositoryInterface
{
    public function getActivities($page, $pageSize)
    {
        $data = new StdClass;

        $this->applyCriteria();

        $this->model->orderBy('time', 'desc');

        // Pagination
        $this->model->skip($pageSize * ($page - 1));
        $this->model->take($pageSize);


        $data->orders = $this->model->get();
        $data->count = $this->model->count();

        return $data;
    }
}