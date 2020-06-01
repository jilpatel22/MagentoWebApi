<?php
namespace te\demo\Model\ResourceModel\ProductDetails;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init('te\demo\Model\ProductDetails','te\demo\Model\ResourceModel\ProductDetails');
    }
}