<?php

namespace Jcowie\FeatureToggle\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Jcowie\FeatureToggle\Api\Data\FeaturetoggleInterfaceFactory;
use Jcowie\FeatureToggle\Model\Data\Featuretoggle;

class FeaturetoggleRegistry
{
    /**
     * @var FeaturetoggleInterfaceFactory
     */
    private $featuretoggleFactory;

    private $featuretoggleRegistryById;

    public function __construct(FeaturetoggleInterfaceFactory $featuretoggleInterfaceFactory)
    {
        $this->featuretoggleFactory = $featuretoggleInterfaceFactory;
    }


    public function retrieve($featuretoggleId)
    {
        if (isset($this->featuretoggleRegistryById[$featuretoggleId])) {
            return $this->featuretoggleRegistryById[$featuretoggleId];
        }
        /** @var Warehouse $warehouse */
        $featureToggle = $this->featuretoggleFactory->create()->load($featuretoggleId);
        if (!$featureToggle->getFeaturetoggleId()) {
            // featureToggle does not exist
            throw NoSuchEntityException::singleField('featuretoggleId', $featuretoggleId);
        } else {
            $this->featuretoggleRegistryById[$featuretoggleId] = $featureToggle;
            return $featureToggle;
        }
    }
    /**
     * Replace existing feature toggle model with a new one.
     *
     * @param Featuretoggle $featuretoggle
     *
     * @return $this
     */
    public function push(Featuretoggle $featuretoggle)
    {
        $this->featuretoggleRegistryById[$featuretoggle->getId()] = $featuretoggle;
        return $this;
    }
}
