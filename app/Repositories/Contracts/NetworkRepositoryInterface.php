<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 13.09.2015
 * Time: 11:51
 */

namespace WTT\Repositories\Contracts;


interface NetworkRepositoryInterface extends RepositoryInterface
{
    public function getNetwork();
}