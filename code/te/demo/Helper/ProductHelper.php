<?php
/** @package    mage2 ... */

namespace te\demo\Helper;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Pricing\Helper\Data;

class ProductHelper
{
    /**
     * @var Data
     */
    private $priceHelper;

    /**
     * ProductHelper constructor
     * @param Data $priceHelper
     */
    public function __construct(Data $priceHelper)
    {
        $this->priceHelper=$priceHelper;
    }

    public function formatPrice($price)
    {
        return $this->priceHelper->currency($price,true,false);
    }
}