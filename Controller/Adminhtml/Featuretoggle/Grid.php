<?php

namespace Jcowie\FeatureToggle\Controller\Adminhtml\Featuretoggle;

use Jcowie\FeatureToggle\Controller\Adminhtml\Manage;

class Grid extends Manage
{
    /**
     * Custom grid action
     *
     * @return \Magento\Framework\View\Result\Layout
     */
    public function execute()
    {
        $resultLayout = $this->resultLayoutFactory->create();
        return $resultLayout;
    }
}
