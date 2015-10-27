<?php

namespace Jcowie\FeatureToggle\Model\Resource;

use Jcowie\FeatureToggle\Api\Data\FeaturetoggleInterface;
use Jcowie\FeatureToggle\Api\FeaturetoggleRepositoryInterface;
use Jcowie\FeatureToggle\Model\Resource\Featuretoggle\Collection as FeaturetoggleCollection;
use Jcowie\FeatureToggle\Model\Resource\Featuretoggle\CollectionFactory;
use Jcowie\FeatureToggle\Model\FeaturetoggleRegistry;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;

class FeaturetoggleRepository implements FeaturetoggleRepositoryInterface
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var SearchResultsInterface
     */
    private $searchResult;

    /**
     * @var SearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var FeaturetoggleRegistry
     */
    private $featuretoggleRegistry;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @param CollectionFactory             $collectionFactory
     * @param SearchResultsInterface        $searchResult
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param FeaturetoggleRegistry             $featuretoggleRegistry
     * @param StoreManagerInterface         $storeManager
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        SearchResultsInterface $searchResult,
        SearchResultsInterfaceFactory $searchResultsFactory,
        FeaturetoggleRegistry $featuretoggleRegistry,
        StoreManagerInterface $storeManager
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->searchResult = $searchResult;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->featuretoggleRegistry = $featuretoggleRegistry;
        $this->storeManager = $storeManager;
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var FeatureToggle $collection */
        $collection = $this->collectionFactory->create();

        $this->setFilters($searchCriteria, $collection);
        $this->setSortOrder($searchCriteria, $collection);
        $this->setPageSize($searchCriteria, $collection);
        $this->setCurrentPage($searchCriteria, $collection);
        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setItems($collection->getItems());
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setTotalCount($collection->getSize());
        return $searchResult;
    }

    public function getById($featuretoggleId)
    {
        return $this->featuretoggleRegistry->retrieve($featuretoggleId);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param FeaturetoggleCollection     $collection
     */
    private function setFilters(SearchCriteriaInterface $searchCriteria, $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $collection->addFieldToFilter(
                    $filter->getField(),
                    [$filter->getConditionType() => $filter->getValue()]
                );
            }
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param FeaturetoggleCollection     $collection
     */
    private function setSortOrder(SearchCriteriaInterface $searchCriteria, $collection)
    {
        if ($searchCriteria->getSortOrders()) {
            foreach ($searchCriteria->getSortOrders() as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    $sortOrder->getDirection() === SearchCriteriaInterface::SORT_ASC ? 'ASC' : 'DESC'
                );
            }
        }
    }
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param FeaturetoggleCollection     $collection
     */
    private function setPageSize(SearchCriteriaInterface $searchCriteria, $collection)
    {
        if ($searchCriteria->getPageSize()) {
            $collection->setPageSize($searchCriteria->getPageSize());
        }
    }
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param FeaturetoggleCollection     $collection
     */
    private function setCurrentPage(SearchCriteriaInterface $searchCriteria, $collection)
    {
        if ($searchCriteria->getCurrentPage()) {
            $collection->setCurPage($searchCriteria->getCurrentPage());
        }
    }

}
