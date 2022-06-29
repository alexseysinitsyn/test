<?php
namespace Models;

class Product extends Main
{
   
   public function __construct()
   {
    
       $this->connect = mysqli_connect("sql4.freemysqlhosting.net","sql4501255","lyqGprQLi5","sql4501255");
      /* $this->connect = mysqli_connect("localhost:8889","root","root","shop");*/
       
   }

   public function validate()
   {
      if(isset($_POST['sku']))
      {
        $check_sku = $this->connect->query("SELECT sku FROM products WHERE sku = '".$this->getSku()."'");
        if($check_sku->num_rows > 0)
        {
          echo "Sorry, sku  already exists";
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

        $sql='INSERT INTO ' . $this->getTableName() . '(' . implode(', ', $this->getTableColumns()) . ') VALUES ("' . implode('", "', $this->getProductAttributes()) . '")';
       $this->connect->real_query($sql);
          header("Location: index.php"); exit;
      }
    } 

    public function delete(){
      $checkbox = $_POST['checked'];
      if($checkbox)
      {
	      foreach($checkbox as $check)
        { 
	        $sql = $this->connect->real_query('"DELETE FROM '. $this->getTableName().' WHERE sku ='.$check.'"');
        }
          header("Location: index.php"); exit;
      }
  } 



  public function listAll(){
   
    $sql='SELECT ' . implode(', ', $this->getTableColumns()) . ' FROM ' . $this->getTableName();
    return $this->connect->query($sql);
     
  } 

}