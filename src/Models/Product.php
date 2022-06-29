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
	        $sql = $this->connect->real_query("DELETE FROM products WHERE sku ='".$check."'");
        }
          header("Location: index.php"); exit;
      }
  } 



  public function listAll(){
        
    $list = array();
    $sql = $this->connect->query("SELECT * FROM products");
    $i=0;
    foreach($sql as $one)
    {
      $list[$i]= '<div  class="block">
         <input  type="checkbox" class="delete-checkbox" name="checked[]" value='.$one['sku'].'><p>'
         .implode('<br>', $one).'<br></div>';
         $i++;
    }
    return $list;
  }

}







/*class SqlCreateTable{
    public function createTable()
    {
$table = 'CREATE TABLE IF NOT EXISTS products (
    sku VARCHAR (255) NOT NULL PRIMARY KEY,
    name  VARCHAR (255) NOT NULL,
    price  INTEGER NOT NULL,
    weight INTEGER DEFAULT NULL(255),
    dimension  INTEGER DEFAULT NULL(255),
    size INTEGER DEFAULT NULL(255))';

$sql = new Product();   
$sql = $this->connect->query('CREATE TABLE IF NOT EXISTS products (
  sku VARCHAR (255) NOT NULL PRIMARY KEY,
  name  VARCHAR (255) NOT NULL,
  price  INTEGER NOT NULL,
  weight INTEGER DEFAULT NULL(255),
  dimension  INTEGER DEFAULT NULL(255),
  size INTEGER DEFAULT NULL(255))');
    }
}

(new SqlCreateTable())->createTable(); 
var_dump('table is created');
die;*/