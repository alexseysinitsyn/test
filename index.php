<?php 

require 'vendor/autoload.php';

 use Models\Product;
 
	$model = new Product();
	$model->delete();
	?>
<!DOCTYPE html>
<html>
<head>

</head>
<style>
.bottom-border {		
border-bottom: 3px solid black;
height:150px;
	}	
.button {
float: right;
}
.title{
	display: inline-block;
	float: left;	
}
.delete-checkbox{
	float: left;
}
form {
	display: inline-block;	
}

.block{
	display: inline-block;
	text-align: center;
	width: 250px;
	height:250px;
	border: 1px solid black;
	margin:7px;
	line-height: 2.0;
}
</style>
<body>

	<div class='bottom-border'>
			<h2 class='title'>Products List</h2>
			<div class="button">
			<a href="add-product.php" ><button>ADD</button></a>
			<form method="post">
			<input type='submit' value="MASS DELETE" id="delete-product-btn">
			</div>
		</div>
		
		<div>
			<?php
	
	 			foreach($model->listAll() as $one)
				 	{
						$model->setOneProduct($one);
						echo $model->getOneProduct();	
	 				}

			?>
		</div>
	</form>
	
</body>
</html>