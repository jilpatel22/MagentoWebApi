<?php
namespace te\demo\Model\ResourceModel;
use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ProductDetails extends AbstractDb
{
    protected $_isPkAutoIncrement=false;
    public function _construct()
    {
        $this->_init('te_demo_productDetails','product_id');
    }
}