<?php
/** @package     mage2 ... */

namespace te\demo\Api;

use Magento\Framework\Exception\NoSuchEntityException;
/**
 * te Api to get product by ID
 */
interface ProductRepositoryInterface
{
    /**
     * Get Product by its ID
     * 
     * @param string $id
     * @return \te\demo\Api\Data\ProductInterface
     * @throws NoSuchEntityException
     */
    public function getProductById($id);

    
    /**
     * Add product
     * @return string
     */
    public function addProduct();

     /**
     * Update product
     * @return string
     */
    public function updateProduct();



}