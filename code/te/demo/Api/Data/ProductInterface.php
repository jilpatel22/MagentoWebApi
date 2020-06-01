<?php
/** @package    mage2... */

namespace te\demo\Api\Data;

interface ProductInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getPrice();

    /**
     * @param int $price
     * @return $this
     */

    public function setPrice($price);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getSizes();

    /**
     * @param string $sizes
     * @return $this
     */
    public function setSizes($sizes);

    /**
     * @return string
     */
    public function getColours();

    /**
     * @param string $colours
     * @return $this
     */
    public function setColours($colours);


}