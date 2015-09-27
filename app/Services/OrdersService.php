<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 13.09.2015
 * Time: 12:27
 */

namespace WTT\Services;

use WTT\Repositories\Contracts\OrdersRepositoryInterface;
use WTT\Repositories\Criteria\CustomerCriteria;
use WTT\Repositories\Criteria\ServiceIdCriteria;

class OrdersService
{
    private $ordersRepository;
    private $milestoneStatesService;

    /**
     * Loads our $ordersRepository with the actual Repo associated with our ordersRepository
     *
     * @param OrdersRepositoryInterface $ordersRepository
     */
    public function __construct(OrdersRepositoryInterface $ordersRepository)
    {
        $this->ordersRepository = $ordersRepository;
        $this->milestoneStatesService = new MilestoneStatesService();
    }

    #region Public methods
    /**
     * @param $external_id2
     * @return mixed
     */
    public function getOrder($external_id2)
    {
        $order = $this->ordersRepository
            ->getOrder($external_id2,
                array(
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

        if ($order != null) {
            $order->sadDate = $this->getSADDate($order);
            $order->currentMilestone = $this->milestoneStatesService->getCurrentMilestone($order);
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
            $order->currentMilestone = $this->milestoneStatesService->getCurrentMilestone($order);
        }

        return $data;
    }

    /**
     * @param $page
     * @param $pageSize
     * @param $serviceId
     * @param $customerName
     * @param $siteId
     * @param $gvNumber
     * @param $status
     * @return mixed
     */
    public function getOrdersFiltered($page, $pageSize, $serviceId, $customerName, $siteId, $gvNumber, $status)
    {
        $this->addCriterias($serviceId, $customerName, $siteId, $gvNumber, $status);

        $data = $this->ordersRepository->getOrders($page, $pageSize);

        foreach ($data->orders as $order) {
            $order->sadDate = $this->getSADDate($order);
            $order->currentMilestone = $this->milestoneStatesService->getCurrentMilestone($order);

        }

        return $data;
    }

    #endregion

    #region Helper methods
    private function addCriterias($serviceId, $customerName, $siteId, $gvNumber, $status)
    {
        if ($serviceId != null) $this->ordersRepository->pushCriteria(new ServiceIdCriteria($serviceId));
        if ($customerName != null) $this->ordersRepository->pushCriteria(new CustomerCriteria($customerName));
    }

    private function getSADDate($model)
    {
        $eisRequestInfos = $model->getAttribute('eisRequestInfos');
        if ($eisRequestInfos !== null) {
            $ehi_SunCla = $eisRequestInfos[0]->getAttribute('ehi_SunCla');
            return $ehi_SunCla === null ? null : $ehi_SunCla->getAttribute('deliverydt');
        } else return null;
    }
    #endregion
}