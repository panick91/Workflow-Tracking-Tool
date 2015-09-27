<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 22.09.2015
 * Time: 13:46
 */

namespace WTT\Services;


use Illuminate\Support\Facades\Config;
use WTT\Enumerations\WorkflowState;

class MilestoneStatesService
{
    public function getCurrentMilestone($model)
    {
        $configuratedMilestones = Config::get('sunrise.milestones');

        $project = $model->projects->first();

        if ($project === null ||
            $project->network === null ||
            $project->network->milestones === null ||
            $project->network->milestones->count() <= 0) {
            return WorkflowState::NoData;
        }

        // filter for general milestones
        $milestones = $project->network->milestones->filter(function ($milestone) {
            return $milestone->milestoneTemplate->milestonetemplategroup_id == 22;
        });

        // filter for configurated milestones
        $milestones = $milestones->filter(function ($milestone) use ($configuratedMilestones) {
            foreach (array_keys($configuratedMilestones) as $m) {
                if ($milestone->milestoneTemplate->name == $m) {
                    return true;
                }
            }
            return false;
        });

        $milestones = $milestones->sortBy(function ($milestone, $key) {
            return $milestone->milestoneTemplate->name;
        });

        return Config::get('sunrise.milestones')[$milestones->last()->milestoneTemplate->name];
    }
}