<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 06.09.2015
 * Time: 01:04
 */

namespace WTT\Repositories\Eloquent;


use \StdClass;
use WTT\Repositories\Contracts\OrdersRepositoryInterface;

class OrdersRepository extends Repository implements OrdersRepositoryInterface
{
    public function getOrder($external_id2, array $relations = array())
    {
        $query = $this->model->with($relations);

        $query->where('external_id2', 'like', $external_id2);

        $this->filterRequestTypes($query);

        $order = $query->first();

        return $order;
    }

    public function getOrders($page, $pageSize)
    {
        $data = new StdClass;
        $this->model = $this->model->with(array(
            'projects' => function ($query) {
                $query->where('MLOGPROD.TBPROJECT.state', 'like', 'Activated');
                $query->with('network.milestones.milestoneTemplate');
            },
            'taskExecution',
            'eisRequestInfos'
        ));

        $this->applyCriteria();

        $this->model->orderBy('create_dt', 'desc');

        // Pagination
        $this->model->skip($pageSize * ($page - 1));
        $this->model->take($pageSize);


        $data->orders = $this->model->get();
        $data->count = $this->model->count();

        return $data;
    }
}