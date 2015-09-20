<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 06.09.2015
 * Time: 01:04
 */

namespace WTT\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use \StdClass;
use Illuminate\Support\Facades\DB;
use WTT\Repositories\Contracts\OrdersRepositoryInterface;

class OrdersRepository extends Repository implements OrdersRepositoryInterface
{
    private $requestTypes = array(
        'SIPVPN'
    , 'SID'
    , 'SBV'
    , 'IIPA'
    );

    public function getOrder($external_id2)
    {
        $query = $this->model->with(array(
//            'projects' => function ($query) {
//                $query->where('MLOGPROD.TBPROJECT.state', 'like', 'Activated');
//                $query->with('network.milestones.milestoneTemplate');
//            },
            'taskExecution',
            'eisRequestType',
            'projects' => function ($query) {
                $query->where('MLOGPROD.TBPROJECT.state', 'like', 'Activated');
                $query->with('network.milestones.milestoneTemplate');
            },
        ));

        $query->where('external_id2', 'like', $external_id2);

        $this->filterRequestTypes($query);

        $order = $query->first();

        return $order;
    }

    public function getOrders($page, $pageSize)
    {
//        DB::enableQueryLog();

        $data = new StdClass;
        $this->model = $this->model->with(array(
            'projects' => function ($query) {
                $query->where('MLOGPROD.TBPROJECT.state', 'like', 'Activated');
                $query->with('network.milestones.milestoneTemplate');
            },
            'taskExecution'
        ));

        $this->filterRequestTypes();
        $this->applyCriteria();

        $this->model->orderBy('create_dt', 'desc');

        // Pagination
        $this->model->skip($pageSize * ($page - 1));
        $this->model->take($pageSize);


        $data->orders = $this->model->get();
        $data->count = $this->model->count();

//        print_r(DB::getQueryLog());

        return $data;
    }

    private function filterRequestTypes()
    {
        $this->model->where(function ($query) {
            $i = 0;
            foreach ($this->requestTypes as $requestType) {
                if ($i == 0) $query->where('external_id2', 'like', $requestType . '%');
                else $query->orWhere('external_id2', 'like', $requestType . '%');
                $i++;
            }
        });
    }
}