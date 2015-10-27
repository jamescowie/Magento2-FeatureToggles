<?php

namespace Jcowie\FeatureToggle\Model\Data;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Api\ExtensibleDataInterface;

use Jcowie\FeatureToggle\Api\Data\FeaturetoggleInterface;
use Jcowie\FeatureToggle\Model\Resource\Featuretoggle as FeaturetoggleResource;

class Featuretoggle extends AbstractModel implements FeaturetoggleInterface, ExtensibleDataInterface
{
    protected function _construct()
    {
        $this->_init(FeaturetoggleResource::class);
    }
    /**
     * Set with the name value
     *
     * @param $name string
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->setData('name', $name);
        return $this;
    }
    /**
     * Returns with the name value
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData('name');
    }
    /**
     * Return with the id of the warehouse
     *
     * @api
     *
     * @return int
     */
    public function getFeaturetoggleId()
    {
        return $this->getData('featuretoggle_id');
    }
    /**
     * Set the id of the warehouse
     *
     * @api
     *
     * @param $warehouseId int
     *
     * @return $this
     */
    public function setFeaturetoggleId($featuretoggleId)
    {
        $this->setData('featuretoggle_id', $featuretoggleId);
        return $this;
    }

    public function setStatus($status)
    {
        $this->setData('setatus', $status);
        return $this;
    }

    public function getStatus()
    {
        return $this->getData('status');
    }
}
