<?php

namespace Jcowie\FeatureToggle\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\LayoutFactory;

class Manage extends Action
{
    /**
     * @var string
     */
    protected $aclAction = 'list';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var LayoutFactory
     */
    protected $resultLayoutFactory;

    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * @param Context                      $context
     * @param ForwardFactory               $resultForwardFactory
     * @param LayoutFactory                $resultLayoutFactory
     * @param PageFactory                  $resultPageFactory
     * @param Registry                     $coreRegistry
     */
    public function __construct(
        Context $context,
        ForwardFactory $resultForwardFactory,
        LayoutFactory $resultLayoutFactory,
        PageFactory $resultPageFactory,
        Registry $coreRegistry
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->resultLayoutFactory = $resultLayoutFactory;
        $this->coreRegistry = $coreRegistry;
    }

    /**
     * Customer access rights checking
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Jcowie_Featuretoggle::' . $this->aclAction);
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        // TODO: Implement execute() method.
    }
}
