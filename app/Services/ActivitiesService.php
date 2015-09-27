<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 13.09.2015
 * Time: 12:27
 */

namespace WTT\Services;

use Illuminate\Support\Facades\Config;
use WTT\Repositories\Contracts\ActivityRepositoryInterface;
use WTT\Repositories\Criteria\ActivityTypeCriteria;

class ActivitiesService
{
    private $activitiesRepository;

    /**
     * Loads our $ordersRepository with the actual Repo associated with our ordersRepository
     *
     * @param ActivityRepositoryInterface $activitiesRepository
     */
    public function __construct(ActivityRepositoryInterface $activitiesRepository)
    {
        $this->activitiesRepository = $activitiesRepository;
    }

    #region Public methods
    /**
     *
     * @param $eisRequestId
     * @param $page
     * @param $pageSize
     * @return string
     * @internal param mixed $pokemon
     */
    public function getActivities($eisRequestId, $page, $pageSize)
    {
        $this->activitiesRepository->pushCriteria(
            new ActivityTypeCriteria(Config::get('sunrise.activityTypes'))
        );

        $data = $this->activitiesRepository->getActivities($eisRequestId, $page, $pageSize);

//        foreach ($data->activies as $activity) {
//
//        }

        return $data;
    }

    #endregion

    #region Helper methods

    #endregion
}