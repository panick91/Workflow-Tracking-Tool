<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 06.09.2015
 * Time: 01:04
 */

namespace WTT\Repositories\Eloquent;



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

    public function getSADDate($id) {
//        $this->applyCriteria();
//        $eisRequest = $this->find($id);
//        $eisRequest = $eisRequest->eisRequestInfo;
//        $eisRequest = $eisRequest->ehi_SunCla;
//         return $eisRequest->deliverydt;
        $order = $this->model->find($id);
        $order->load('sadDates');
        return $order;
    }

    public function getOrders($pageSize){
        $orders =  $this->model->with(
            'eisRequestInfos.ehi_SunCla'
            ,'taskExecution'
            ,'eisRequestContacts'
        )->orderBy('id')->paginate($pageSize);
//        $orders = $orders->load('eisRequestInfo.ehi_SunCla');
//        $orders = $orders->load('sadDate');
        return $orders;
    }
}