<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 13.09.2015
 * Time: 12:27
 */

namespace WTT\Services;

use WTT\Enumerations\WorkflowState;
use WTT\Repositories\Contracts\OrdersRepositoryInterface;

class OrdersService
{
    protected $ordersRepository;

    /**
     * Loads our $ordersRepository with the actual Repo associated with our ordersRepository
     *
     * @param OrdersRepositoryInterface $ordersRepository
     */
    public function __construct(OrdersRepositoryInterface $ordersRepository)
    {
        $this->ordersRepository = $ordersRepository;
    }

    public function getOrder($external_id2)
    {
        $order = $this->ordersRepository->getOrder($external_id2);

        if($order != null) {
            $order->sadDate = $this->getSADDate($order);
            $order->currentWorkflowState = $this->currentWorkflowState($order);
        }

        return $order;
    }

    /**
     *
     * @param $page
     * @param $pageSize
     * @return string
     * @internal param mixed $pokemon
     */
    public function getOrders($page, $pageSize)
    {
        $data = $this->ordersRepository->getOrders($page, $pageSize);

        foreach ($data->orders as $order) {
            $order->sadDate = $this->getSADDate($order);
            $order->currentWorkflowState = $this->currentWorkflowState($order);
        }

        return $data;
    }

    private function getSADDate($model)
    {
        $eisRequestInfos = $model->getAttribute('eisRequestInfos');
        if ($eisRequestInfos != null) {
            $ehi_SunCla = $eisRequestInfos[0]->getAttribute('ehi_SunCla');
            return $ehi_SunCla == null ? null : $ehi_SunCla->getAttribute('deliverydt');
        } else return null;
    }

    private function currentWorkflowState($model)
    {
        return WorkflowState::PlanningPhase;
    }
}