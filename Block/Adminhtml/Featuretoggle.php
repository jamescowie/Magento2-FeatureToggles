<?php

namespace Jcowie\FeatureToggle\Block\Adminhtml;

class Featuretoggle extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml';
        $this->_blockGroup = 'Jcowie_Featuretoggle';
        $this->_headerText = __('Feature Toggles');
        $this->_addButtonLabel = __('Add New Feature Toggle');
        parent::_construct();
    }
}
