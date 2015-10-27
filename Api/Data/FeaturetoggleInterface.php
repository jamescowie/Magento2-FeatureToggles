<?php

namespace Jcowie\FeatureToggle\Api\Data;

interface FeaturetoggleInterface
{
    /**
     * Return with the id of the Feature toggle
     *
     * @api
     *
     * @return int
     */
    public function getFeaturetoggleId();

    /**
     * Set the id of the feature toggle
     *
     * @api
     *
     * @param $featureId int
     *
     * @return $this
     */
    public function setFeaturetoggleId($featureId);

    /**
     * Set the name of the Feature
     *
     * @api
     *
     * @param $name string
     *
     * @return $this
     */
    public function setName($name);

    /**
     * Return with the name of the Feature
     *
     * @api
     *
     * @return string
     */
    public function getName();

    /**
     * Set the status
     *
     * @api
     *
     * @param $status
     * @return mixed
     */
    public function setStatus($status);

    /**
     * Set the status
     *
     * @api
     *
     * @return mixed
     */
    public function getStatus();
}
