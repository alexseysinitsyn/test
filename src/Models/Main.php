<?php
Abstract Class Main
{
  
    protected $sku;
    protected $name;
    protected $type;
    protected $price;
    protected $property;




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
        $this->property = (!empty($size) ? ' Size:' .$size. 'MB' : '') 
        .(!empty($weight) ? ' Weight:' . $weight . 'KG' : '')
        .(!empty($height) ? ' Dimension:' . implode('x', [$height, $width, $length]) : '');
    }

}
