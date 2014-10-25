<?php
/**
 * Created by PhpStorm.
 * User: havoc
 * Date: 10/25/14
 * Time: 7:56 PM
 */
class MagentoHackathon_FastSimpleExport_Model_Export_Entity_Cartrule
{
    public function export()
    {
        foreach(Mage::getResourceModel('salesrule/rule_collection')->load() as $rule) {
            $rule->getStoreLabels();
            $rules[] = $rule->getData();
        };
        return $rules;

    }

    /**
     * Writer model setter.
     *
     * @param Mage_ImportExport_Model_Export_Adapter_Abstract $writer
     * @return Mage_ImportExport_Model_Export_Entity_Abstract
     */
    public function setWriter(MagentoHackathon_FastSimpleExport_Model_Export_Adapter_Array $writer)
    {
        $this->_writer = $writer;

        return $this;
    }
}