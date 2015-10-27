<?php

namespace Jcowie\FeatureToggle\Controller\Adminhtml\Featuretoggle;

use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Jcowie\FeatureToggle\Controller\Adminhtml\Manage;

class Edit extends Manage
{
    /**
     * @var string
     */
    protected $aclAction = 'edit';

    /**
     * @return Page|Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        try {
            $featuretoggle = $this->_initFeatureToggle();
        } catch (\Exception $exception) {
            $this->messageManager->addError(__($exception->getMessage()));
            /** @var Redirect $resultRedirect */
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setPath('featuretoggle/*');
            return $resultRedirect;
        }
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getPageData(true);
        if (! empty($data)) {
            $featuretoggle->addData($data);
        }
        $this->coreRegistry->register('current_featuretoggle_id', $featuretoggle->getFeaturetoggleId());
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Feature Toggle'));
        $resultPage->getConfig()->getTitle()->prepend(
            $featuretoggle->getId() ? $featuretoggle->getName() : __('New Feature Toggle')
        );
        $resultPage->getLayout()->getBlock('admin.block.mx_featuretoggle.edit')
            ->setData('action', $this->getUrl('featuretoggle/index/save'));
        $resultPage->addBreadcrumb(
            $featuretoggle->getId() ? __('Edit Feature Toggle') : __('New Feature Toggle'),
            $featuretoggle->getId() ? __('Edit Feature Toggle') : __('New Feature Toggle')
        );
        return $resultPage;
    }
}
