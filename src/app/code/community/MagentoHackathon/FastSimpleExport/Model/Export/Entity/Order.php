<?php
class MagentoHackathon_FastSimpleExport_Model_Export_Entity_Order extends Mage_ImportExport_Model_Export_Entity_Abstract
{

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
            $result[$key]['payment'] = $order->getPayment()->getData();
            if (!$order->getShippingAddress()->getData('same_as_billing')) {
                $result[$key]['shipping_address'] = $order->getShippingAddress()->getData();
            }
            $result[$key]['billing_address'] = $order->getBillingAddress()->getData();
            foreach ($order->getAllItems() as $item) {
                $result[$key]['items'][] = $item->getData();
            }
            $result[$key]['shipments'] = $order->getShipmentsCollection()->getData();
        }
        return $result;
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