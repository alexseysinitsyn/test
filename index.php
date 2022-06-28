<?php 

require 'vendor/autoload.php';

 use Models\Product;
 
	$model = new Product();
	
	$model->delete();
	$list = $model->listAll();
		
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
}
</style>
<script>

</script>
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
	
	 			foreach($list as $one)
				 	{
		 				echo $one;
	 				}

			?>
		</div>
	</form>
	
</body>
</html>