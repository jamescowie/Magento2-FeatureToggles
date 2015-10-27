<?php

namespace Jcowie\FeatureToggle\Block\Adminhtml;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;
use Jcowie\FeatureToggle\Api\FeaturetoggleRepositoryInterface;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * @var FeaturetoggleRepositoryInterface
     */
    private $featuretoggleRepository;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FeaturetoggleRepositoryInterface $featuretoggleRepository
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FeaturetoggleRepositoryInterface $featuretoggleRepository,
        array $data = []
    )
    {
        $this->coreRegistry = $registry;
        $this->featuretoggleRepository = $featuretoggleRepository;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'featuretoggle_id';
        $this->_blockGroup = 'Jcowie_Featuretoggle';
        $this->_controller = 'adminhtml';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save Feature Toggle'));
        $this->buttonList->remove('delete');
    }

    /**
     * Return the feature id.
     *
     * @return int|null
     */
    public function getFeaturetoggleId()
    {
        $featuretoggleId = $this->coreRegistry->registry('current_featuretoggle_id');
        return $featuretoggleId;
    }

    /**
     * Retrieve the save and continue edit Url.
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl(
            'jcowie_featuretoggle/featuretoggle/save',
            ['_current' => true, 'back' => 'edit', 'tab' => '{{tab_id}}']
        );
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        $currentFeaturetoggleId = $this->coreRegistry->registry('current_featuretoggle_id');
        if ($currentFeaturetoggleId) {
            $featuretoggleData = $this->featuretoggleRepository->getById($currentFeaturetoggleId);
            return __("Edit Feature Toggle '%1'", $featuretoggleData->getName());
        } else {
            return __('New Feature Toggle');
        }
    }

}
