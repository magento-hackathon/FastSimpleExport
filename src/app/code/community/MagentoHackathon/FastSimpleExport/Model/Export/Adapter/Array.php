<?php


class MagentoHackathon_FastSimpleExport_Model_Export_Adapter_Array extends MagentoHackathon_FastSimpleExport_Model_Export_Adapter_Abstract
{
    protected  $_content = array();
    public function writeRow(array $rowData)
    {
        $this->_content[] = $rowData;
    }

    public function getContents()
    {
        return $this->_content;
    }
}