<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 06.09.2015
 * Time: 00:55
 */

namespace WTT\Repositories\Contracts;

use WTT\Repositories\Criteria\Criteria;

interface RepositoryInterface
{
    public function all($columns = array('*'));

    public function paginate($perPage = 1, $columns = array('*'));

    public function create(array $data);

    public function update(array $data, $id, $attribute = "id");

    public function delete($id);

    public function find($id, $columns = array('*'));

    public function findBy($attribute, $value, $columns = array('*'));

    public function resetScope();

    public function skipCriteria($status = true);

    public function getCriteria();

    public function getByCriteria(Criteria $criteria);

    public function pushCriteria(Criteria $criteria);

    public function applyCriteria();
}