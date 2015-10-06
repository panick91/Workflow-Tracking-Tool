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
use stdClass;

class ProgressCalculationService
{

    /**
     * @param $model
     * @param $sadDate
     * @return array|null
     * @throws \Exception
     */
    public function getMilestoneDeviations($model, $sadDate)
    {
        if (!$this->validateInputValues($model, $sadDate)) return null;

        $deviations = new Collection();
        $milestones = new Collection();
        $orderMilestones = $model->projects[0]->network->milestones;

        $milestoneTimespans = Config::get('sunrise.milestoneTimespans');

        $count = 0;
        $date = new Carbon($sadDate);

        foreach ($milestoneTimespans as $milestoneName => $days) {
            // calculate deadline
            $date->subWeekdays($days);

            // get configured milestone from network
            $milestone = $this->getMilestone($orderMilestones, $milestoneName);

            $deviationDays = 0;
            if ($milestone->state === 'Completed') {
                // get difference between planned completion date and actual completion date
                $deviationDays = $date->diffInDaysFiltered(function (Carbon $date) {
                    return !$date->isWeekend();
                }, new Carbon($milestone->milestone_completed_dt), false);
            }

            $deviations->add($deviationDays);
            $milestones->add($milestone->milestoneTemplate->name);

            $count++;
        }

        return $this->createDeviationObject($milestones, $deviations);
    }

    /**
     * @param $model
     * @param $sadDate
     * @return bool
     */
    private function validateInputValues($model, $sadDate)
    {
        if ($sadDate === null) return false;
        if ($model === null) return false;
        if ($model->projects->first() === null) return false;
        if ($model->projects->first()->network === null) return false;
        if ($model->projects->first()->network->milestones === null) return false;
        if ($model->projects->first()->network->milestones->count() === 0) return false;

        return true;
    }

    /**
     * @param $orderMilestones
     * @param $milestoneName
     * @return mixed
     * @throws \Exception
     */
    private function getMilestone($orderMilestones, $milestoneName)
    {
        $filtered = $orderMilestones->filter(function ($value) use ($milestoneName) {
            return $value->milestoneTemplate->name === $milestoneName;
        });

        if ($filtered->count() > 1) {
            throw new \Exception("Duplicate milestone within one network!");
        }

        $milestone = $filtered->first();
        return $milestone;
    }

    private function createDeviationObject($milestones, $deviations){
        return [
            'milestones' => $milestones->reverse()->all()
            , 'deviations' => $deviations->reverse()->all()
        ];
    }

//    private function getPrependdingNodes($node)
//    {
//        $node->isCrawled = true;
////        $this->nodes->add($node);
//
//        $this->totalCount++;
//        if ($node->state === 'Completed' ||
//            $node->state === 'Disabled'
//        ) {
//            $this->completedCount++;
//        }
//
////        $nodes = new Collection();
//
//        $node->load('incomingLinks');
//        $node->prependingNodes = new Collection();
//
//        foreach ($node->incomingLinks as $link) {
//            if ($link->startNode !== null) {
//                $startNode = null;
//                $filtered = $this->nodes->filter(function ($value) use ($link) {
//                    return $value->id === $link->startNode->id;
//                });
//
//                if ($filtered->count() > 0) {
//                    $startNode = $filtered->first();
//
//                    $node->prependingNodes->add($link->startNode);
//
//                    if ($startNode->milestone !== 1 &&
//                        $startNode->isCrawled !== true
//                    ) {
//                        $this->getPrependdingNodes($startNode);
//                    }
//                }
//            }
//
////        return $nodes;
//        }
//    }
}