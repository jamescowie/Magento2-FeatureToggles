<?php

namespace Jcowie\FeatureToggle\Api;

use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Jcowie\FeatureToggle\Api\Data\FeaturetoggleInterface;

interface FeaturetoggleRepositoryInterface
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Retrieve warehouses which match a specified criteria.
     *
     * @api
     * @param  int $featuretoggleId
     * @return FeaturetoggleInterface
     * @throws NoSuchEntityException If warehouse with the specified ID does not exist.
     */
    public function getById($featuretoggleId);
}
