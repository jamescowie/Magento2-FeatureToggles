<?php

namespace Jcowie\FeatureToggle\Model\Resource\Featuretoggle;

use Magento\Framework\Model\Resource\Db\Collection\AbstractCollection;

use Jcowie\FeatureToggle\Model\Data\Featuretoggle;
use Jcowie\FeatureToggle\Model\Resource\Featuretoggle as FeaturetoggleResource;


class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Featuretoggle::class, FeaturetoggleResource::class);
    }
}
