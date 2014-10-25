<?php
/**
 * Created by PhpStorm.
 * User: havoc
 * Date: 10/25/14
 * Time: 5:27 PM
 */
class MagentoHackathon_FastSimpleExport_Model_Export_Entity_Catalogrule
{
    public function export()
    {

        $rules = Mage::getModel('catalogrule/rule')->getCollection();

        return $rules->getData();
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