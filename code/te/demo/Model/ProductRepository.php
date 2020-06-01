<?php 
/** @package    mage2 ... */

namespace te\demo\Model;

use te\demo\Api\ConfigurableProductRepositoryInterface;
use te\demo\Api\ProductRepositoryInterface;
use te\demo\Api\Data\ProductInterfaceFactory;
use te\demo\Helper\ProductHelper;
use Magento\Framework\Execption\NosuchEntityException;
use \Magento\Framework\App\RequestInterface;
use lib\internal\Magento\Framework\Http\PhpEnvironment\Request;
use te\demo\Model\ProductDetailsFactory;
use \Magento\Framework\App\ResourceConnection;

/**
 * te Api to get product data
 */

 class ProductRepository implements ProductRepositoryInterface
 {
     /**
      * @var ProductInterfaceFactory
      */
      private $productInterfaceFactory;

      /**
       * @var ProductHelper
       */
      private $productHelper;

      /**
       * @var \Magento\Catalog\Api\ProductRepositoryInterface
       */
      private $productRepository;

      /**
       * @var \Magento\Framework\App\RequestInterface $request
       */
        private $request;

        /**
         * @var ProductDetailsFactory
         */
        private $productDetailsFactory;

        /**
         * @var Magento\Framework\App\ResourceConnection $resource
         */
        private $resource;

      /**
       * ProductRepository constructor
       * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
       * @param ProductInterfaceFactory $productInterfaceFactory
       * @param ProductHelper $productHelper
       */
      public function __construct(\Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
      ProductInterfaceFactory $productInterfaceFactory,
      ProductHelper $productHelper,
      \Magento\Framework\App\RequestInterface $request,
      \te\demo\Model\ProductDetailsFactory $productDetailsFactory,
      \Magento\Framework\App\ResourceConnection $resource)
      {
          $this->productInterfaceFactory= $productInterfaceFactory;
          $this->productHelper =$productHelper;
          $this->productRepository=$productRepository;
          $this->request=$request;
          $this->productDetailsFactory= $productDetailsFactory;
          $this->resource=$resource;
      }

      /**
       * Get product by its ID
       * 
       * @param string $id
       * @return \te\demo\Api\Data\ProductInterface
       * @throws NoSuchEntityException
       */
        public function getProductById($id)
        {
            if(preg_match("/(KS[-])([A-Za-z]{4}[-])([0-9]{5}[-])([A-Za-z]{2})/",$id))
            {
                   /**
             * @var \te\demo\Api\Data\ProductInterface $productInterface 
            */
            $productInterface=$this->productInterfaceFactory->create();
            try{
                
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                $model=$objectManager->create('te\demo\Model\ProductDetails');
                $datacollection =$model->getCollection();
                foreach($datacollection as $data)
                {
                    if($data->getId()==$id)
                    {
                        $productInterface->setId($data->getId());
                        $productInterface->setPrice($data->getproduct_price());
                        $productInterface->setDescription($data->getproduct_description());
                        $productInterface->setSizes($data->getsizes());
                        $productInterface->setColours($data->getcolours());


                    }
                }
                return $productInterface;
            
            }
            catch(NoSuchEntityException $e)
            {
                throw NoSuchEntityException::singleField("id",$id);
            }

            }
            else{
                return "Invalid product Id";
            }
           
         
            

        }

        /**
         * @return string
         * add product
         */
        public function addProduct()
        {


            $data=json_decode($this->request->getContent(),true);
            if($this->validate($data))
            {
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $model=$objectManager->create('te\demo\Model\ProductDetails');
            $model->setData(array(
                'product_id'=>$data["id"],
                'product_price'=>$data["price"],
                'product_description'=>$data['description'],
                'sizes'=>$data['sizes'],
                'colours'=>$data['colours'],
                'image_url'=>$data['image_url']));

            $saveData=$model->save();
            if($saveData)
            {
                return "Data added successfully";
            }
            else
            {
                return "Error adding data";
            }
            }
            else
            {
                return "Inavlid input format";
            }
            
            
        }
        
       
        /**
         * @return string
         * add product
         */
        public function updateProduct()
        {
            $data=json_decode($this->request->getContent(),true);
            if($this->validate($data))
            {
                $connection = $this->resource->getConnection();
                $values=array("product_price"=>$data['price'],
                "product_description"=>$data['description'],
                "sizes"=>$data['sizes'],
                "colours"=>$data['colours'],
                "image_url"=>$data['image_url']
                );
                $where=['product_id=?'=>$data['id']];
                $tableName=$connection->getTableName("te_demo_productDetails");
                $connection->update($tableName,$values,$where);
                return "Updated Successfully";

            }
            else{
                return "Inavlid input format";
            }
           
    }

    
/**
 * @return boolean
 */
    public function validate($data)
    {
        
        if(preg_match("/(KS[-])([A-Za-z]{4}[-])([0-9]{5}[-])([A-Za-z]{2})/",$data['id']))   
        {
            if(is_int($data['price']) && $data['price']>100 && $data['price']<1000)
            {
                if(is_string($data['description']) && strlen($data['description'])<25)
                {
                    if(strcmp($data['sizes'],'SM')==0 || strcmp($data['sizes'],'M')==0 || strcmp($data['sizes'],'L')==0 || strcmp($data['sizes'],'XL')==0 || strcmp($data['sizes'],'XS')==0 )
                    {
                        if(preg_match("/([A-Za-z]{3}[-][0-9]{3})/",$data['colours']))
                        {
                            if(filter_var($data['image_url'],FILTER_VALIDATE_URL))
                            {
                                return true;
                            }
                            else
                            {
                                return false;
                            }

                        }
                        else{
                            return false;
                        }
                       
                    }
                    else
                    {
                        return false;
                    }
                    
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
            
           
        }
        else{
            return false;
        }
        
        
    }
}