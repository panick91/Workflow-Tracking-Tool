<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 22.09.2015
 * Time: 13:46
 */

namespace WTT\Services;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Config;
use stdClass;
use WTT\Enumerations\WorkflowState;

class MilestoneStatesService
{
    public function getCurrentWorkflowState($model)
    {
        $workflowState = new StdClass();
        $workflowState->completedMilestones = new Collection();

        $configuratedMilestones = Config::get('sunrise.milestones');

        $project = $model->projects->first();

        if ($project === null ||
            $project->network === null ||
            $project->network->milestones === null ||
            $project->network->milestones->count() <= 0
        ) {
            $workflowState->currentState = WorkflowState::NoData;
            return $workflowState;
        }

        // filter for general milestones
        $milestones = $project->network->milestones->filter(function ($milestone) {
            return $milestone->milestoneTemplate->milestonetemplategroup_id == 22;
        });

        // filter for configurated milestones
        $milestones = $milestones->filter(function ($milestone) use ($configuratedMilestones) {
            foreach (array_keys($configuratedMilestones) as $m) {
                if ($milestone->milestoneTemplate->name === $m) {
                    return true;
                }
            }
            return false;
        });

        if ($milestones->count() === 0) {
            $workflowState->currentState = WorkflowState::NoData;
            return $workflowState;
        }

        $milestones = $milestones->sortBy(function ($milestone, $key) {
            return $milestone->milestoneTemplate->name;
        });

        foreach($milestones as $completedMilestone){
            $workflowState->completedMilestones->add(Config::get('sunrise.milestones')[$completedMilestone->milestoneTemplate->name]);
        }
        $workflowState->currentState = Config::get('sunrise.milestones')[$milestones->last()->milestoneTemplate->name];

        return $workflowState;
    }
}