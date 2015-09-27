<?php

use \Mockery as m;

require_once('WorkflowFactory.php');


class WorkflowStateTest extends TestCase
{

    protected $workflowFactory;

    public function setUp()
    {
        parent::setUp();
        $this->workflowFactory = new WorkflowFactory();
    }

    /**
     * Tests the result of a workflow which provides milestones beyond the actual
     * end milestone.
     *
     * @return void
     */
    public function testWorkflowState_ExceedEndState()
    {
        $network = factory(WTT\Network::class)->make();
        $network->milestones = $this->workflowFactory->getWorkflowByState(\WTT\Enumerations\WorkflowState::NoData);;

        $order = factory(WTT\EISRequest::class)->make();
        $order->projects = factory(WTT\Project::class, 2)
            ->make()
            ->each(function ($p) use ($network) {
                $p->network = $network;
            });
        $order->eisRequestInfos = factory(WTT\EISRequestInfo::class, 3)
            ->make()
            ->each(function ($i) {
                $i->ehi_SunCla = factory(WTT\EHI_SunCla::class)->make();
            });

        $repository = m::mock('WTT\Repositories\Contracts\OrdersRepositoryInterface');
        $repository->shouldReceive('getOrder')->once()->andReturn($order);

        $ordersService = new \WTT\Services\OrdersService($repository);
        $data = $ordersService->getOrder('IIPA6509', array());

        $this->assertTrue($data->currentMilestone === \WTT\Enumerations\WorkflowState::End, "Current milestone is not correct");
    }

    /**
     * Tests the calculation of the milestone "Planning phase"
     *
     * @return void
     */
    public function testWorkflowState_PlanningPhase()
    {
        $network = factory(WTT\Network::class)->make();
        $network->milestones = $this->workflowFactory->getWorkflowByState(\WTT\Enumerations\WorkflowState::PlanningPhase);;

        $order = factory(WTT\EISRequest::class)->make();
        $order->projects = factory(WTT\Project::class, 2)
            ->make()
            ->each(function ($p) use ($network) {
                $p->network = $network;
            });
        $order->eisRequestInfos = factory(WTT\EISRequestInfo::class, 3)
            ->make()
            ->each(function ($i) {
                $i->ehi_SunCla = factory(WTT\EHI_SunCla::class)->make();
            });

        $repository = m::mock('WTT\Repositories\Contracts\OrdersRepositoryInterface');
        $repository->shouldReceive('getOrder')->once()->andReturn($order);

        $ordersService = new \WTT\Services\OrdersService($repository);
        $data = $ordersService->getOrder('IIPA6509', array());

        $this->assertTrue($data->currentMilestone === \WTT\Enumerations\WorkflowState::PlanningPhase, "Current milestone is not correct");
    }

    /**
     * Tests the calculation of the milestone "Start Order"
     *
     * @return void
     */
    public function testWorkflowState_StartOrder()
    {
        $network = factory(WTT\Network::class)->make();
        $network->milestones = $this->workflowFactory->getWorkflowByState(\WTT\Enumerations\WorkflowState::StartOrder);;

        $order = factory(WTT\EISRequest::class)->make();
        $order->projects = factory(WTT\Project::class, 2)
            ->make()
            ->each(function ($p) use ($network) {
                $p->network = $network;
            });
        $order->eisRequestInfos = factory(WTT\EISRequestInfo::class, 3)
            ->make()
            ->each(function ($i) {
                $i->ehi_SunCla = factory(WTT\EHI_SunCla::class)->make();
            });

        $repository = m::mock('WTT\Repositories\Contracts\OrdersRepositoryInterface');
        $repository->shouldReceive('getOrder')->once()->andReturn($order);

        $ordersService = new \WTT\Services\OrdersService($repository);
        $data = $ordersService->getOrder('IIPA6509', array());

        $this->assertTrue($data->currentMilestone === \WTT\Enumerations\WorkflowState::StartOrder, "Current milestone is not correct");
    }

    /**
     * Tests the calculation of the milestone "Start Order"
     *
     * @return void
     */
    public function testWorkflowState_EquipmentInstallation()
    {
        $network = factory(WTT\Network::class)->make();
        $network->milestones = $this->workflowFactory->getWorkflowByState(\WTT\Enumerations\WorkflowState::EquipmentInstallation);;

        $order = factory(WTT\EISRequest::class)->make();
        $order->projects = factory(WTT\Project::class, 2)
            ->make()
            ->each(function ($p) use ($network) {
                $p->network = $network;
            });
        $order->eisRequestInfos = factory(WTT\EISRequestInfo::class, 3)
            ->make()
            ->each(function ($i) {
                $i->ehi_SunCla = factory(WTT\EHI_SunCla::class)->make();
            });

        $repository = m::mock('WTT\Repositories\Contracts\OrdersRepositoryInterface');
        $repository->shouldReceive('getOrder')->once()->andReturn($order);

        $ordersService = new \WTT\Services\OrdersService($repository);
        $data = $ordersService->getOrder('IIPA6509', array());

        $this->assertTrue($data->currentMilestone === \WTT\Enumerations\WorkflowState::EquipmentInstallation, "Current milestone is not correct");
    }

    /**
     * Tests the calculation of the milestone "End"
     *
     * @return void
     */
    public function testWorkflowState_End()
    {
        $network = factory(WTT\Network::class)->make();
        $network->milestones = $this->workflowFactory->getWorkflowByState(\WTT\Enumerations\WorkflowState::End);;

        $order = factory(WTT\EISRequest::class)->make();
        $order->projects = factory(WTT\Project::class, 2)
            ->make()
            ->each(function ($p) use ($network) {
                $p->network = $network;
            });
        $order->eisRequestInfos = factory(WTT\EISRequestInfo::class, 3)
            ->make()
            ->each(function ($i) {
                $i->ehi_SunCla = factory(WTT\EHI_SunCla::class)->make();
            });

        $repository = m::mock('WTT\Repositories\Contracts\OrdersRepositoryInterface');
        $repository->shouldReceive('getOrder')->once()->andReturn($order);

        $ordersService = new \WTT\Services\OrdersService($repository);
        $data = $ordersService->getOrder('IIPA6509', array());

        $this->assertTrue($data->currentMilestone === \WTT\Enumerations\WorkflowState::End, "Current milestone is not correct");
    }
}
