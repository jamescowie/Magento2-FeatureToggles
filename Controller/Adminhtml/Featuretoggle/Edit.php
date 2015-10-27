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
//        try {
//            $warehouse = $this->_initWarehouse();
//        } catch (\Exception $exception) {
//            $this->messageManager->addError(__($exception->getMessage()));
//            /** @var Redirect $resultRedirect */
//            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
//            $resultRedirect->setPath('warehouse/*');
//            return $resultRedirect;
//        }
//        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getPageData(true);
//        if (! empty($data)) {
//            $warehouse->addData($data);
//        }
//        $this->coreRegistry->register('current_warehouse_id', $warehouse->getWarehouseId());
//        /** @var Page $resultPage */
//        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
//        $resultPage->getConfig()->getTitle()->prepend(__('Warehouses'));
//        $resultPage->getConfig()->getTitle()->prepend(
//            $warehouse->getId() ? $warehouse->getName() : __('New Warehouse')
//        );
//        $resultPage->getLayout()->getBlock('admin.block.mx_warehouse.edit')
//            ->setData('action', $this->getUrl('warehouse/index/save'));
//        $resultPage->addBreadcrumb(
//            $warehouse->getId() ? __('Edit Warehouse') : __('New Warehouse'),
//            $warehouse->getId() ? __('Edit Warehouse') : __('New Warehouse')
//        );
//        return $resultPage;
    }
}
