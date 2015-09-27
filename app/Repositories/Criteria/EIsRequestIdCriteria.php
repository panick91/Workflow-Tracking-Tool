<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 06.09.2015
 * Time: 01:19
 */

namespace WTT\Repositories\Criteria;

use WTT\Repositories\Contracts\RepositoryInterface as Repository;
use WTT\Repositories\Contracts\RepositoryInterface;

class EIsRequestIdCriteria extends Criteria
{

    private $eIsRequestId;
    private $databaseField;

    public function __construct($eIsRequestId, $databaseField = 'id')
    {
        $this->eIsRequestId = $eIsRequestId;
        $this->databaseField = $databaseField;
    }

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $query = $model->where($this->databaseField,$this->eIsRequestId);

        return $query;
    }
}