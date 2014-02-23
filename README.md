## FastSimpleExport - Array output for Magento ImportExport

### Export Magento Entities as multidimensional arrays for further

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
$result = $exporter->processOrderExport();
```