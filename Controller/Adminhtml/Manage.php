<?php

namespace Jcowie\FeatureToggle\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\LayoutFactory;

use Jcowie\FeatureToggle\Api\Data\FeaturetoggleInterface;
use Jcowie\FeatureToggle\Api\Data\FeaturetoggleInterfaceFactory;
use Jcowie\FeatureToggle\Api\FeaturetoggleRepositoryInterface;

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
     * @var FeaturetoggleInterfaceFactory
     */
    protected $featuretoggleFactory;

    /**
     * @var FeaturetoggleRepositoryInterface
     */
    protected $featuretoggleRepository;

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
        Registry $coreRegistry,
        FeaturetoggleInterfaceFactory $featuretoggleFactory,
        FeaturetoggleRepositoryInterface $featuretoggleRepository
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->resultLayoutFactory = $resultLayoutFactory;
        $this->coreRegistry = $coreRegistry;
        $this->featuretoggleFactory = $featuretoggleFactory;
        $this->featuretoggleRepository = $featuretoggleRepository;
    }

    /**
     * Initialise feature toggle based on request
     *
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function _initFeatureToggle()
    {
        $featuretoggleId = (int)$this->getRequest()->getParam('featuretoggle_id');
        if ($featuretoggleId) {
            $featuretoggle = $this->featuretoggleRepository->getById($featuretoggleId);
            if (!$featuretoggle->getFeaturetoggleId()) {
                throw new NoSuchEntityException('This feature does not exist');
            }
        } else {
            $featuretoggle = $this->featuretoggleFactory->create();
        }
        return $featuretoggle;
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

}
