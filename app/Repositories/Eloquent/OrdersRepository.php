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
    public function getOrder()
    {
        $this->model = $this->model->with(array(
            'taskExecution',
            'eisRequestType',
            'projects' => function ($query) {
                $query->where('MLOGPROD.TBPROJECT.state', 'like', 'Activated');
                $query->with('network.milestones.milestoneTemplate');
                $query->orderBy('update_dt', 'desc');
                $query->orderBy('id', 'desc');
                $query->first();
            },
        ));

        $this->applyCriteria();
        $order = $this->model->first();
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