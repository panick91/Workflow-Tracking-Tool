<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 06.09.2015
 * Time: 01:04
 */

namespace WTT\Repositories\Eloquent;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use \StdClass;
use WTT\Repositories\Contracts\OrdersRepositoryInterface;
use WTT\Services\MilestoneStatesService;

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
        $this->model = $this->model
            ->select('MLOGPROD.TBEISREQUEST.*')
            ->distinct()
            ->leftJoin('MLOGPROD.TBPROJECT', 'MLOGPROD.TBPROJECT.EISREQUEST_ID', '=', 'MLOGPROD.TBEISREQUEST.ID')
            ->leftJoin('MLOGPROD.TBNETWORK', 'MLOGPROD.TBNETWORK.id', '=', 'MLOGPROD.TBPROJECT.NETWORK_ID')
            ->leftJoin('MLOGPROD.TBNETWORK_NODE', 'MLOGPROD.TBNETWORK_NODE.NETWORK_ID', '=', 'MLOGPROD.TBNETWORK.ID')
            ->where(function ($query) {
                $query->where('MLOGPROD.TBPROJECT.state', 'like', 'Activated');
                $query->orWhereNull('MLOGPROD.TBPROJECT.state');
            });

        $this->applyCriteria();

        $this->model->orderBy('MLOGPROD.TBEISREQUEST.create_dt', 'desc');

        // Get total amount of orders
        $data->count = $this->model->count();

        // Pagination
        $this->model->skip($pageSize * ($page - 1));
        $this->model->take($pageSize);

        $data->orders = $this->model->get();

        return $data;
    }

    public function getOrdersByStatus($page, $pageSize, $status)
    {
        $data = new StdClass;
        $this->model = $this->model
            ->select('MLOGPROD.TBEISREQUEST.*')
            ->distinct()
            ->leftJoin('MLOGPROD.TBPROJECT', 'MLOGPROD.TBPROJECT.EISREQUEST_ID', '=', 'MLOGPROD.TBEISREQUEST.ID')
            ->leftJoin('MLOGPROD.TBNETWORK', 'MLOGPROD.TBNETWORK.ID', '=', 'MLOGPROD.TBPROJECT.NETWORK_ID')
            ->leftJoin('MLOGPROD.TBNETWORK_NODE', 'MLOGPROD.TBNETWORK_NODE.NETWORK_ID', '=', 'MLOGPROD.TBNETWORK.ID')
            ->join('MLOGPROD.TBMILESTONETEMPLATE', 'MLOGPROD.TBMILESTONETEMPLATE.ID', '=', 'MLOGPROD.TBNETWORK_NODE.MILESTONETEMPLATE_ID')
            ->where('MLOGPROD.TBPROJECT.state', 'like', 'Activated')
            ->where('MLOGPROD.TBNETWORK_NODE.STATE', 'like', 'Completed')
            ->where('MLOGPROD.TBNETWORK_NODE.MILESTONE', 1)
            ->whereIn('MLOGPROD.TBMILESTONETEMPLATE.NAME', ['MS02', 'MS06', 'MS07', 'MS09']);

        $this->applyCriteria();

        $this->model->orderBy('MLOGPROD.TBEISREQUEST.create_dt', 'desc');

        // Get total amount of orders
        $data->count = $this->model->count();

        $data->orders = $this->model->get();

        return $data;
    }
}