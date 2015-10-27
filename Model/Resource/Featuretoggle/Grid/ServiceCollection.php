<?php

namespace Jcowie\FeatureToggle\Model\Resource\Featuretoggle\Grid;

use Magento\Framework\Data\Collection\EntityFactory;
use Magento\Framework\Api\AbstractServiceCollection;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;

use Jcowie\FeatureToggle\Api\Data\FeaturetoggleInterface;
use Jcowie\FeatureToggle\Api\FeaturetoggleRepositoryInterface;

class ServiceCollection extends AbstractServiceCollection
{
    /**
     * @var FeaturetoggleRepositoryInterface
     */
    private $featuretoggleRepository;

    /**
     * @param \Magento\Framework\Data\Collection\EntityFactory $entityFactory
     * @param FilterBuilder                                    $filterBuilder
     * @param SearchCriteriaBuilder                            $searchCriteriaBuilder
     * @param SortOrderBuilder                                 $sortOrderBuilder
     * @param FeaturetoggleRepositoryInterface                     $featuretoggleRepository
     */
    public function __construct(
        EntityFactory $entityFactory,
        FilterBuilder $filterBuilder,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder,
        FeaturetoggleRepositoryInterface $featuretoggleRepository
    ) {
        parent::__construct($entityFactory, $filterBuilder, $searchCriteriaBuilder, $sortOrderBuilder);
        $this->featuretoggleRepository = $featuretoggleRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function loadData($printQuery = false, $logQuery = false)
    {
        if (!$this->isLoaded()) {
            $searchCriteria = $this->getSearchCriteria();
            $searchResults = $this->featuretoggleRepository->getList($searchCriteria);
            $this->_totalRecords = $searchResults->getTotalCount();
            /** @var featuretoggleInterface[] $featuretoggles */
            $featuretoggles = $searchResults->getItems();
            foreach ($featuretoggles as $toggle) {
                $this->_addItem($this->createFeaturetoggleItem($toggle));
            }
            $this->_setIsLoaded();
        }
        return $this;
    }

    /**
     * Creates a collection item that represents a featuretoggle for the features Grid.
     *
     * @param FeaturetoggleInterface $featuretoggle Input data for creating the item.
     * @return \Magento\Framework\Object Collection item that represents a warehouse
     */
    protected function createFeaturetoggleItem(FeaturetoggleInterface $featuretoggle)
    {
        $featuretoggleItem = new \Magento\Framework\Object();
        $featuretoggleItem->setFeaturetoggleId($featuretoggle->getFeaturetoggleId());
        $featuretoggleItem->setName($featuretoggle->getName());
        return $featuretoggleItem;
    }
}
