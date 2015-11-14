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

class RequestTypeCriteria extends Criteria
{

    private $requestTypes;

    public function __construct($requestTypes)
    {
        $this->requestTypes = $requestTypes;
    }

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $query = $model->where(function ($query) {
            $i = 0;
            foreach ($this->requestTypes as $requestType) {
                if ($i == 0) $query->where('MLOGPROD.TBEISREQUEST.external_id2', 'like', $requestType . '%');
                else $query->orWhere('MLOGPROD.TBEISREQUEST.external_id2', 'like', $requestType . '%');
                $i++;
            }
        });
        return $query;
    }
}