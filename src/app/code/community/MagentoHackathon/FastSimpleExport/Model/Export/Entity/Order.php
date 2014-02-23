<?php
class MagentoHackathon_FastSimpleExport_Model_Export_Entity_Order extends Mage_ImportExport_Model_Export_Entity_Abstract
{
    protected $_shipment = false;
    protected $_items = false;
    protected $_payment = false;
    protected $_addresses = false;
    /**
     * Export process.
     *
     * @return string
     */
    public function export()
    {

        $orders = Mage::getModel("sales/order")->getCollection();

        foreach ($orders as $key => $order) {
            $result[$key] = $order->getData();
            if ($this->_addresses) {
                if (!$order->getShippingAddress()->getData('same_as_billing')) {
                    $result[$key]['shipping_address'] = $order->getShippingAddress()->getData();
                }
                $result[$key]['billing_address'] = $order->getBillingAddress()->getData();
            }
            if ($this->_items) {
                foreach ($order->getAllItems() as $item) {
                    $result[$key]['items'][] = $item->getData();
                }
            }
            if ($this->_payment) {
                $result[$key]['payment'] = $order->getPayment()->getData();
            }
            if ($this->_shipment) {
                $result[$key]['shipments'] = $order->getShipmentsCollection()->getData();
            }
        }
        return $result;
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
}