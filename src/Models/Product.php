<?php
namespace Models;


 
Class Product
{
        private $connect;
        private $sku;
        private $name;
        private $type;
        private $price;
        private $size;
        private $weight;
        private $height;
        private $width;
        private $length;
        private $dimension;
   public function __construct()
   {
       $this->connect = mysqli_connect("sql4.freemysqlhosting.net","sql4501255","lyqGprQLi5","sql4501255");
       
   }

   public function validate()
   {
    
      $this->sku = $_POST['sku'];
      if($this->sku)
      {
        $check_sku = $this->connect->query("SELECT sku FROM products WHERE sku = '".$this->sku."'");
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
        $this->sku = $_POST['sku'];
        $this->name = $_POST['name'];
        $this->price = $_POST['price'];
        $this->size = $_POST['size'];
        $this->weight = $_POST['weight'];
        $this->height = $_POST['height'];
        $this->width = $_POST['width'];
        $this->length = $_POST['length'];
        if($this->height)
        {
          $this->dimension = $this->height."x".$this->width."x".$this->length;
        }
   
          $sql = $this->connect->query('INSERT INTO products (sku, name, price, size, weight, dimension ) VALUES("'.$this->sku.'","'.$this->name.'","'.$this->price.'","'.$this->size.'","'.$this->weight.'","'.$this->dimension.'")');
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
      $block1="<div  class='block'>
         <input  type='checkbox' class='delete-checkbox' name='checked[]' value=".$one['sku'].">
         <p id='sku'>".$one['sku']."<p>
         <p id='name'>".$one['name']."<p>
         <p id='price'>".$one['price']."$<p>";
      if($one['size'])
      {
         $block2="<p id='size'>Size:".$one['size']."MB<p>
         </div>";
      }else if($one['weight'])
      {
        $block2="<p id='weight'>Weight:".$one['weight']."MB<p>
        </div>"; 
      }else if($one['dimension'])
      {
        $block2="<p id='dimension'>Dimension:".$one['dimension']."<p>
        </div>"; 
      }
      $list[$i]="$block1 $block2";
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