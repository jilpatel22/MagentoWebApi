<?php
/** @package    mage2 ... */
namespace te\demo\Model\Data;
use te\demo\Api\Data\ProductInterface;
use Magento\Framework\Dataobject;

class Product extends DataObject implements ProductInterface
{
    /**
     * @return string
     */
    public function getId()
    {
        return $this->getData('id');
    }

    /**
     * @param string $id
     * @return $this
     */

    public function setId($id)
    {
        return $this->setData('id',$id);
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->getData('price');
    }
    
    /**
     * @param int $price
     * @return $this
     */

    public function setPrice($price)
    {
        return $this->setData('price',$price);
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->getData('description');
    }
    
    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        return $this->setData('description',$description);
    }

    /**
     * @return string
     */
    public function getSizes()
    {
        return $this->getData('sizes');
    }
    
    /**
     * @param string $sizes
     * @return $this
     */
    public function setSizes($sizes)
    {
        return $this->setData('sizes',$sizes);
    }

    /**
     * @return string
     */
    public function getColours()
    {
        return $this->getData('colours');
    }
    
    /**
     * @param string $colours
     * @return $this
     */
    public function setColours($colours)
    {
        return $this->setData('colours',$colours);
    }

    
}