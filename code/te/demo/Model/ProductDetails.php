<?php
namespace te\demo\Model;

use \Magento\Framework\Model\AbstractModel;

class ProductDetails extends AbstractModel{

    public function _construct()
    {
        $this->_init('te\demo\Model\ResourceModel\ProductDetails');
    }
}