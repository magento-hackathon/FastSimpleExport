<?php
class MagentoHackathon_FastSimpleExport_Model_Export_Entity_Attribute_Option
{
    /**
     * Export process.
     *
     * @return string
     */
    public function export()
    {

        $attributes = Mage::getModel('catalog/product')->getAttributes();
        $data = array();
        foreach ($attributes as $key => $attribute) {
            $attr = Mage::getModel('eav/entity_attribute')->load($attribute->getId());
            if (($attr->getFrontendInput() == 'select' || $attr->getFrontendInput() == 'multiselect') ) {
                $collection = Mage::getResourceModel('eav/entity_attribute_option_collection')
                    ->setPositionOrder('asc')
                    ->setAttributeFilter($attr->getId())
                    ->setStoreFilter(0)
                    ->load();
                $options = $collection->toArray()['items'];
                foreach ($options as $option) {
                    $data[$attr->getAttributeCode()][] = array(
                        'attribute_code' => $attr->getAttributeCode(),
                        'option_id' => $option['option_id'],
                        'order' => $option['sort_order'],
                        'admin' => $option['value']
                    );
                }
            }
        }
        return $data;
    }


    public function setIncludePayment($input = false)
    {
        $this->_payment = $input;
    }
    public function setIncludeAddresses($input = false)
    {
        $this->_addresses = $input;
    }

    public function setIncludeItems($input = false)
    {
        $this->_items = $input;
    }

    public function setIncludeShipment($input = false)
    {
        $this->_shipment = $input;
    }
    /**
     * Entity attributes collection getter.
     *
     * @return Mage_Eav_Model_Resource_Entity_Attribute_Collection
     */
    public function getAttributeCollection()
    {
        return Mage::getResourceModel('sales_order/attribute_collection');
    }

    /**
     * EAV entity type code getter.
     *
     * @return string
     */
    public function getEntityTypeCode()
    {
        return "order";
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