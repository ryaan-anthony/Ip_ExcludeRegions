<?php

class Ip_ExcludeRegions_Model_Resource_Region_Collection extends Mage_Directory_Model_Resource_Region_Collection
{

    const EXCLUDES_CONFIG_PATH = 'general/country/excluded_regions';

    /**
     * Exclude regions for frontend only
     *
     * @return Mage_Directory_Model_Resource_Region_Collection
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        $store = Mage::app()->getStore();
        if(!$store->isAdmin() && $exclude_regions = Mage::getStoreConfig(self::EXCLUDES_CONFIG_PATH, $store)){
            $this->getSelect()->where('main_table.region_id NOT IN (?)', array_filter(explode(',',$exclude_regions),'strlen'));
        }
        return $this;
    }

}
