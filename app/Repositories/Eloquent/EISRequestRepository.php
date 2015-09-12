<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 06.09.2015
 * Time: 01:04
 */

namespace WTT\Repositories\Eloquent;

use \StdClass;
use Illuminate\Support\Facades\DB;

class EISRequestRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'WTT\EISRequest';
    }

    public function getSADDate($id)
    {
//        $this->applyCriteria();
//        $eisRequest = $this->find($id);
//        $eisRequest = $eisRequest->eisRequestInfo;
//        $eisRequest = $eisRequest->ehi_SunCla;
//         return $eisRequest->deliverydt;
        $order = $this->model->find($id);
        $order->load('sadDates');
        return $order;
    }

    public function getOrders($page,$pageSize)
    {

        DB::enableQueryLog();

        $data = new StdClass;
        $data->orders = $this->model->with(
//            'eisRequestInfos.ehi_SunCla'
//            ,'taskExecution'
            'eisRequestContacts'
            ,'projects.network.networkNodes.milestoneTemplate'
//            , 'eisRequestActivities'
//            , 'projects.projectActivites'
//            , 'projects.tasks.taskACtivites'
        )
            ->orderBy('create_dt', 'desc')
            ->skip($pageSize * ($page - 1))
            ->take($pageSize)->get();

        $data->count = $this->model->count();

//        print_r(DB::getQueryLog());

        return $data;
    }
}