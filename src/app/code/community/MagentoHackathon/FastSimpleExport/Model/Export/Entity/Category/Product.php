<?php
/**
 * Created by PhpStorm.
 * User: havoc
 * Date: 10/25/14
 * Time: 11:54 AM
 */
class MagentoHackathon_FastSimpleExport_Model_Export_Entity_Category_Product extends Mage_ImportExport_Model_Export_Entity_Abstract
{

    /**
     * Export process.
     *
     * @return string
     */
    public function export()
    {
        $rootId     = Mage::app()->getStore(1)->getRootCategoryId();
        $categories = Mage::getModel('catalog/category')
            ->getCollection()
            ->addFieldToFilter('path', array('like' => '1/'.$rootId.'%'))
        ;
        $_cats = array();
        $_catp = array();
        foreach ($categories->getData() as $_category) {

            $_cat = Mage::getModel('catalog/category')->load($_category['entity_id']);
            $_cats[$_category['entity_id']] =
                $_cat->getName();
            $products = $_cat->getProductCollection();
            foreach ($products as $product) {
                $_products[$product->getId()] = $product->getSku();
            }
            foreach ($_cat->getProductsPosition() as $pid => $pos) {
                $l = explode('/', $_category['path']);
                foreach ($l as $c) {
                    if (isset($_cats[$c]) && $c != $rootId) {
                        $t .= (!empty($t)) ? '/'.$_cats[$c] : $_cats[$c];
                    }
                }
                $_catp[] = array(
                    '_root' => $_cats[$rootId],
                    '_sku' => $_products[$pid],
                    'position' => $pos,
                    '_category' => $t,
                );
                unset($t);
            }

        }
        return $_catp;
    }

    /**
     * Entity attributes collection getter.
     *
     * @return Mage_Eav_Model_Resource_Entity_Attribute_Collection
     */
    public function getAttributeCollection()
    {
        return Mage::getResourceModel('catalog/category_product');
    }

    /**
     * EAV entity type code getter.
     *
     * @return string
     */
    public function getEntityTypeCode()
    {
        return 'catalog_category';
    }
}
