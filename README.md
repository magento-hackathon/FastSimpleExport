## FastSimpleExport - Array output for Magento ImportExport

### Export Magento Entities as multidimensional arrays for further usage

This extension is able to export some entities to a simple multidimensional array for further usage.

### Supported entities

* Products
```php
$exporter = Mage::getModel("fastsimpleexport/export");
$result = $exporter->processProductExport();
```
* Customer
```php
$exporter = Mage::getModel("fastsimpleexport/export");
$result = $exporter->processCustomerExport();
```
* Orders
```php
$exporter = Mage::getModel("fastsimpleexport/export");
$result = $exporter
->setIncludePayment(true)
->setIncludeShipment(true)
->setIncludeAddresses(true)
->setIncludeItems(true)
->processOrderExport();
```
* Catalog Category Product Positions
```php
$exporter = Mage::getModel('fastsimpleexport/export');
$result = $exporter->processCategoryProductExport();
```

* Catalogrules
```php
$exporter = Mage::getModel('fastsimpleexport/export');
$result = $exporter->processCatalogruleExport();
```
* Cartrules
```php
$exporter = Mage::getModel('fastsimpleexport/export');
$result = $exporter->processCartrulesExport();
```

### Filtering

Filtering is done the same way it is done in ImportExport.
Simply create an array of the following structure and use it as parameter in the set filter call.

```php
$filter = array('export_filter' => array('gender' => 123, 'price' => array(100,200)));
$export->setExportFilter($filter);
```