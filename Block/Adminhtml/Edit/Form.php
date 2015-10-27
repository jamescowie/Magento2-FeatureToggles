<?php

namespace Jcowie\FeatureToggle\Block\Adminhtml\Edit;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;
use Magento\Framework\Object;
use Jcowie\FeatureToggle\Api\FeaturetoggleRepositoryInterface;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var FeaturetoggleRepositoryInterface
     */
    private $featuretoggleRepository;

    /**
     * @var ExtensibleDataObjectConverter
     */
    private $extensibleDataObjectConverter;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param featureRepositoryInterface $featuretoggleRepository
     * @param array $data
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        FeaturetoggleRepositoryInterface $featuretoggleRepository,
        array $data = [],
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    )
    {
        $this->featuretoggleRepository = $featuretoggleRepository;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
        parent::__construct($context, $registry, $formFactory, $data);
    }


    /**
     * Init Form properties
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('featuretoggle_form');
        $this->setTitle(__('Feature Toggle Information'));
    }

    /**
     * Prepare form fields
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'action' => $this->getData('action'),
                    'method' => 'post'
                ]
            ]
        );
        $featuretoggleId = $this->_coreRegistry->registry('current_featuretoggle_id');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('General')]);
        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Name'),
                'title' => __('Name'),
                'required' => true
            ]
        );

        if ($featuretoggleId) {
            $fieldset->addField('featuretoggle_id', 'hidden', ['name' => 'featuretoggle_id', 'value' => $featuretoggleId]);
            $form->setValues(
                $this->extensibleDataObjectConverter->toFlatArray(
                    $this->featuretoggleRepository->getById($featuretoggleId),
                    [],
                    '\Jcowie\FeatureToggle\Api\Data\FeaturetoggleInterface'
                )
            );
        }
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
