<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 13.09.2015
 * Time: 12:27
 */

namespace WTT\Services;

use Illuminate\Support\Facades\Config;
use stdClass;
use WTT\Enumerations\WorkflowState;
use WTT\Repositories\Contracts\OrdersRepositoryInterface;
use WTT\Repositories\Criteria\CustomerCriteria;
use WTT\Repositories\Criteria\EIsRequestIdCriteria;
use WTT\Repositories\Criteria\RequestTypeCriteria;
use WTT\Repositories\Criteria\ServiceIdCriteria;

class OrdersService
{
    private $ordersRepository;
    private $milestoneStatesService;
    private $progressCalculationService;

    /**
     * Loads our $ordersRepository with the actual Repo associated with our ordersRepository
     *
     * @param OrdersRepositoryInterface $ordersRepository
     */
    public function __construct(OrdersRepositoryInterface $ordersRepository)
    {
        $this->ordersRepository = $ordersRepository;
        $this->milestoneStatesService = new MilestoneStatesService();
        $this->progressCalculationService = new ProgressCalculationService();
    }

    #region Public methods
    /**
     * @param $eIsRequestId
     * @return mixed
     */
    public function getOrder($eIsRequestId)
    {
        $this->ordersRepository->pushCriteria(new EIsRequestIdCriteria($eIsRequestId));
        $order = $this->ordersRepository->getOrder();

        if ($order != null) {
            $this->setCustomProperties($order);
        }

        return $order;
    }

    public function getDeviations($eIsRequestId)
    {
        $this->ordersRepository->pushCriteria(new EIsRequestIdCriteria($eIsRequestId));
        $order = $this->ordersRepository->getOrder();

        if ($order != null) {
            $this->setCustomProperties($order);
            $data = $this->progressCalculationService->getMilestoneDeviations(
                $order,
                $this->getSADDate($order));

            return $data;
        } else {
            return null;
        }

    }

    /**
     *
     * @param $page
     * @param $pageSize
     * @return
     */
    public function getOrders($page, $pageSize)
    {
        $data = $this->ordersRepository->getOrders($page, $pageSize);

        foreach ($data->orders as $order) {
            $this->setCustomProperties($order);
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

        if($status !== null){
            $data = $this->ordersRepository->getOrdersByStatus($page == null ? 1 : $page, $pageSize,$status);
        } else{
            $data = $this->ordersRepository->getOrders($page == null ? 1 : $page, $pageSize);
        }

        foreach ($data->orders as $order) {
            $this->setCustomProperties($order);
        }

        if($status !== null){
            $data->orders = $data->orders->filter(function($item) use ($status){
               return $item->currentWorkflowState->currentState == $status;
            })->forPage($page,$pageSize);
        }

        return $data;
    }
    #endregion

    #region Helper methods

    /**
     * Enriches the given object with custom properties.
     *
     * @param $order
     */
    private function setCustomProperties($order)
    {
        $order->availableMilestones = new WorkflowState();
        $order->currentWorkflowState = $this->milestoneStatesService->getCurrentWorkflowState($order);
        $order->sadDate = $this->getSADDate($order);
        $order->customer = $this->getCustomerName($order);

    }

    /**
     * Sets all filters to query the database according to the given input.
     *
     * @param $serviceId
     * @param $customerName
     * @param $siteId
     * @param $gvNumber
     * @param $status
     */
    private function addCriterias($serviceId, $customerName, $siteId, $gvNumber, $status)
    {
        if ($serviceId != null) $this->ordersRepository->pushCriteria(new ServiceIdCriteria($serviceId));
        if ($customerName != null) $this->ordersRepository->pushCriteria(new CustomerCriteria($customerName));

        $this->ordersRepository->pushCriteria(
            new RequestTypeCriteria(Config::get('sunrise.requestTypes'))
        );
    }

    /**
     * Queries the SAD date from the related order entities.
     *
     * @param $order
     * @return stdClass
     */
    private function getSADDate($order)
    {
        $eisRequestInfos = $order->getAttribute('eisRequestInfos');
        if ($eisRequestInfos !== null) {
            $ehi_SunCla = $eisRequestInfos[0]->getAttribute('ehi_SunCla');
            return $ehi_SunCla === null ? null : $ehi_SunCla->getAttribute('deliverydt');
        } else return null;
    }

    /**
     * Queries the customer properties from the related order entities.
     *
     * @param $order
     * @return stdClass
     */
    private function getCustomerName($order)
    {
        $customer = new StdClass();

        if ($order->eisRequestInfos != null) {

            //in case there are multiple infos
            $ehiSunCla = $order->eisRequestInfos->first()->ehi_SunCla;

            $customer->name = $ehiSunCla->sitename;
            $customer->address = $ehiSunCla->custaddress;
            $customer->address2 = $ehiSunCla->custaddress2;
            $customer->city = $ehiSunCla->custzip . ' ' . $ehiSunCla->custcity;
            $customer->state = $ehiSunCla->custstate;
            $customer->phoneNumber = $ehiSunCla->custphone;
            $customer->phoneNumber = $ehiSunCla->custphone;
        }

        return $customer;
    }
    #endregion
}