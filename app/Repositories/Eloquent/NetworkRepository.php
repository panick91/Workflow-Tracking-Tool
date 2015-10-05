<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 06.09.2015
 * Time: 01:04
 */

namespace WTT\Repositories\Eloquent;

use WTT\Repositories\Contracts\NetworkRepositoryInterface;

class NetworkRepository extends Repository implements NetworkRepositoryInterface
{
    public function getNetwork()
    {
        $this->model = $this->model->with(array(
            'networkNodes'
        ));

        $this->applyCriteria();

        return $this->model->first();
    }
}