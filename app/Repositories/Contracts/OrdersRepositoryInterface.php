<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 13.09.2015
 * Time: 11:51
 */

namespace WTT\Repositories\Contracts;


interface OrdersRepositoryInterface extends RepositoryInterface
{
    public function getOrder($externel_id2, array $relations = array());

    public function getOrders($page, $pageSize);
}