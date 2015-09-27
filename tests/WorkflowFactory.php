<?php
use Illuminate\Database\Eloquent\Collection;

/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 27.09.2015
 * Time: 15:53
 */
class WorkflowFactory
{
    public function getWorkflowByState($state){

        $networkNodes = new Collection();

        $networkNodes->add(factory(WTT\NetworkNode::class)
            ->make(['milestoneTemplate' => factory(WTT\MilestoneTemplate::class)->make(['name' => "MS01"])]));
        $networkNodes->add(factory(WTT\NetworkNode::class)
            ->make(['milestoneTemplate' => factory(WTT\MilestoneTemplate::class)->make(['name' => "MS02"])]));
        if($state === \WTT\Enumerations\WorkflowState::PlanningPhase) return $networkNodes;

        $networkNodes->add(factory(WTT\NetworkNode::class)
            ->make(['milestoneTemplate' => factory(WTT\MilestoneTemplate::class)->make(['name' => "MS03"])]));
        $networkNodes->add(factory(WTT\NetworkNode::class)
            ->make(['milestoneTemplate' => factory(WTT\MilestoneTemplate::class)->make(['name' => "MS04"])]));
        $networkNodes->add(factory(WTT\NetworkNode::class)
            ->make(['milestoneTemplate' => factory(WTT\MilestoneTemplate::class)->make(['name' => "MS05"])]));
        $networkNodes->add(factory(WTT\NetworkNode::class)
            ->make(['milestoneTemplate' => factory(WTT\MilestoneTemplate::class)->make(['name' => "MS06"])]));
        if($state === \WTT\Enumerations\WorkflowState::StartOrder) return $networkNodes;

        $networkNodes->add(factory(WTT\NetworkNode::class)
            ->make(['milestoneTemplate' => factory(WTT\MilestoneTemplate::class)->make(['name' => "MS07"])]));
        if($state === \WTT\Enumerations\WorkflowState::EquipmentInstallation) return $networkNodes;

        $networkNodes->add(factory(WTT\NetworkNode::class)
            ->make(['milestoneTemplate' => factory(WTT\MilestoneTemplate::class)->make(['name' => "MS08"])]));
        $networkNodes->add(factory(WTT\NetworkNode::class)
            ->make(['milestoneTemplate' => factory(WTT\MilestoneTemplate::class)->make(['name' => "MS09"])]));
        if($state === \WTT\Enumerations\WorkflowState::End) return $networkNodes;

        $networkNodes->add(factory(WTT\NetworkNode::class)
            ->make(['milestoneTemplate' => factory(WTT\MilestoneTemplate::class)->make(['name' => "MS10"])]));

        return $networkNodes;
    }
}