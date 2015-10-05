<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 22.09.2015
 * Time: 13:46
 */

namespace WTT\Services;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Config;
use Network;

class ProgressCalculationService
{
    private $totalCount = 0;
    private $completedCount = 0;

    private $milestones;
    private $milestoneTimespans;

    public function getProgress($model, $currentMilestone, $sadDate)
    {
        if ($sadDate === null) {
            return null;
        }

        $this->milestones = $model->projects[0]->network->milestones;
        $this->milestoneTimespans = Config::get('sunrise.milestoneTimespans');

        $differences = new Collection();

        foreach ($this->milestoneTimespans as $key => $milestone) {
            $date = $sadDate->copy();
            $date->subWeekdays($milestone);

            $filtered = $this->milestones->filter(function($value) use ($key){
                return $value->milestoneTemplate->name === $key;
            });

            if($filtered->count() > 1){
                throw new \Exception("Duplicate milestone within one network!");
            }

            $milestone = $filtered->first();

            if($milestone->state !== 'Completed'){
                continue;
            }

            $diff = $date->diffInDaysFiltered(function(Carbon $date) {
                return !$date->isWeekend();
            }, new Carbon($milestone->milestone_completed_dt), false);

            $differences->add($diff);



        }


        return $this->milestones;
    }

//    function isWeekend($date) {
//        return (date('N', strtotime($date)) >= 6);
//    }

    private function getPrependdingNodes($node)
    {
        $node->isCrawled = true;
//        $this->nodes->add($node);

        $this->totalCount++;
        if ($node->state === 'Completed' ||
            $node->state === 'Disabled'
        ) {
            $this->completedCount++;
        }

//        $nodes = new Collection();

        $node->load('incomingLinks');
        $node->prependingNodes = new Collection();

        foreach ($node->incomingLinks as $link) {
            if ($link->startNode !== null) {
                $startNode = null;
                $filtered = $this->nodes->filter(function ($value) use ($link) {
                    return $value->id === $link->startNode->id;
                });

                if ($filtered->count() > 0) {
                    $startNode = $filtered->first();

                    $node->prependingNodes->add($link->startNode);

                    if ($startNode->milestone !== 1 &&
                        $startNode->isCrawled !== true
                    ) {
                        $this->getPrependdingNodes($startNode);
                    }
                }
            }

//        return $nodes;
        }
    }
}