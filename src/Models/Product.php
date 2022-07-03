<?php
namespace Models;

class Product extends Main
{
   
   public function __construct()
   {
    
       $this->connect = mysqli_connect("sql4.freemysqlhosting.net","sql4501255","lyqGprQLi5","sql4501255");
       /*$this->connect = mysqli_connect("localhost:8889","root","root","shop");*/
       
   }

   public function validate()
   {
      if(isset($_POST['sku']))
      {
        $this->setSku($_POST['sku']);
        $sql='SELECT sku FROM ' . $this->getTableName() . ' WHERE sku = "'. $this->getSku().'"';
        $check_sku = $this->connect->query($sql);
        $result = $check_sku->num_rows;
        
        if($result > 0)
        {
          echo "Sorry, sku  already exists";
          die;
        }else
        {
         return true;
        }
      }
    }


    public function save()
    {
      if($_POST)
      {
        $this->setSku($_POST['sku']);
        $this->setName($_POST['name']);
        $this->setPrice($_POST['price']);
        $this->setProperty($_POST['size'], $_POST['weight'], $_POST['height'], $_POST['width'], $_POST['length']); 

        $sql='INSERT INTO ' . $this->getTableName() . ' VALUES ("' . implode('", "', $this->getProductAttributes()) . '")';
       $this->connect->query($sql);
          header("Location: index.php"); exit;
      }
    } 

    public function delete(){
      $checkbox = $_POST['checked'];
      if($checkbox)
      {
	      foreach($checkbox as $check)
        { 
          $this->setSku($check);
          $sql='DELETE FROM ' . $this->getTableName() . ' WHERE sku = "'. $this->getSku().'"';
	        $this->connect->query($sql);
        }
          header("Location: index.php"); exit;
      }
  } 



  public function listAll(){
   
    $sql='SELECT ' . implode(', ', $this->getTableColumns()) . ' FROM ' . $this->getTableName();
    return $this->connect->query($sql);
     
  } 

}