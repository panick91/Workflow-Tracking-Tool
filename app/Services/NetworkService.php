<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 13.09.2015
 * Time: 12:27
 */

namespace WTT\Services;

use WTT\Repositories\Contracts\ActivityRepositoryInterface;
use WTT\Repositories\Contracts\NetworkRepositoryInterface;
use WTT\Repositories\Criteria\NetworkIdCriteria;

class NetworkService
{
    private $networkRepository;

    /**
     * Loads our $ordersRepository with the actual Repo associated with our ordersRepository
     *
     * @param NetworkRepositoryInterface $networkRepository
     */
    public function __construct(NetworkRepositoryInterface $networkRepository)
    {
        $this->networkRepository = $networkRepository;
    }

    #region Public methods
    /**
     *
     * @param $networkId
     * @return string
     */
    public function getNetworkById($networkId)
    {
        $this->networkRepository->pushCriteria(
            new NetworkIdCriteria($networkId, 'eisrequestid')
        );

        $data = $this->networkRepository->getNetwork();

        return $data;
    }
    #endregion

}