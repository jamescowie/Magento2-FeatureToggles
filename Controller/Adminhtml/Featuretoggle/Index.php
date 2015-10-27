<?php

namespace Jcowie\FeatureToggle\Controller\Adminhtml\Featuretoggle;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Forward;
use Magento\Backend\Model\View\Result\ForwardFactory;

use Jcowie\FeatureToggle\Controller\Adminhtml\Manage;

class Index extends Manage
{
    /**
     * Forward to edit
     *
     * @return Forward
     */
    public function execute()
    {
        if ($this->getRequest()->getQuery('ajax')) {
            $resultForward = $this->resultForwardFactory->create();
            $resultForward->forward('grid');
            return $resultForward;
        }
        $resultPage = $this->resultPageFactory->create();
        /**
         * Set active menu item
         */
        $resultPage->setActiveMenu('Jcowie_Featuretoggle::featuretoggle');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Feature Toggles'));

        /**
         * Add breadcrumb item
         */
        $resultPage->addBreadcrumb(__('Manage'), __('Manage'));

        return $resultPage; }
}
