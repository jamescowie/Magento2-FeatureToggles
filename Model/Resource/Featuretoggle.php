<?php

namespace Jcowie\FeatureToggle\Model\Resource;

use \Magento\Framework\Model\Resource\Db\AbstractDb;

class Featuretoggle extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('jcowie_featuretoggle', 'featuretoggle_id');
    }
}
