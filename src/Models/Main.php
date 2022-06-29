<?php
namespace Models;

abstract class Main
{
    private $tableName;
    private $sku;
    private $name;
    private $type;
    private $price;
    private $property;
    private $oneProduct;


    public function getTableName()
    {
        return 'products';
    }
    
    public function getTableColumns()
    {
        return [
            'sku',
            'name',
            'price',
            'property'];
    }

    
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSku()
    {
        return $this->sku;
    }
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    

    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($price)
    {
        $this->price = $price.'$';
    }

    public function getProperty()
    {
        return $this->property;
    }
    public function setProperty($size, $weight, $height, $width, $length)
    {
        $this->property = (!empty($size) ? ' Size:' .$size. 'MB' : ' ') 
        .(!empty($weight) ? ' Weight:' . $weight . 'KG' : ' ')
        .(!empty($height) ? ' Dimension:' . implode('x', [$height, $width, $length]) : ' ');
    }

    public function getProductAttributes()
    {
        return [
            $this->getSku(),
            $this->getName(),
            $this->getPrice(),
            $this->getProperty()
        ];
    }

    public function getOneProduct()
    {
        return $this->oneProduct;
    }

    public function setOneProduct($one)
    {
       $this->oneProduct =  '<div  class="block">
            <input  type="checkbox" class="delete-checkbox" name="checked[]" value='.$one['sku'].'><p>'
            .implode('<br>', $one).'<br></div>';  
    }

}
