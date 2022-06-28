<?php
    require 'vendor/autoload.php';

 use Models\Product;
   $model = new Product();
   $model->validate();
   $model->save();
?>

<!DOCTYPE html>
<html>
<head>
</head>
<style>
.bottom-border {
		border-bottom: 3px solid black;
	}
.button {
    position: absolute;	
    top: 10px;
    right: 10px;
    }
.title{
	display: inline-block;	
    }
    form {
	display: inline-block;	
}
.save {
	position: absolute;	
    top: 10px;
    right: 90px;
}

</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script> $(document).ready(function()
{
    $('#productType').change(function()
    {
        
        if($('#productType').val()=='DVD')
        {
            $('.attribute').empty();
            $('.attribute').html('<p>Please, provide size</p><p><input type="number" name="size" id="size" required="">MB</p>'); 
        }else if($('#productType').val()=='Book')
        {
            $('.attribute').empty();
            $('.attribute').html('<p>Please, provide weight</p><p><input type="number" name="weight" id="weight" required="">KG</p>'); 
        }else if($('#productType').val()=='Furniture')
        {
            $('.attribute').empty();
            $('.attribute').html(
            '<p>Please, provide dimensions</p><p>Height<input type="number" name="height" id="height">CM</p><p>Width<input type="number" name="width" id="width">CM</p><p>Length<input type="number" name="length" id="length" required="">CM</p>'); 
        }
    });
});
</script>
<body>

    
    <div class='bottom-border'>
        <h2 class='title'>Products AD</h2>   
    </div>
    <p class='button'><a href="/" ><button>Cancel</button></a></p>
    <form method="post" id="product_form" target="_self">
    <p class="save"><input type='submit' value='Save' id="save" ></p>
    <div class='bottom-border'>
        <p>SKU: <input type="text" name="sku" id="sku" required=""/></p>
        <p>Name: <input type="text" name="name" id="name" required=""/></p>
        <p>Price: <input type="number" step="0.01" name="price" id="price" required=""/>$</p>
        <p>Product Type: 
            <select size="1"  id="productType" required="" >
                <option id="Other">Product Type:</option>
                <option id="Furniture" value="Furniture">Furniture</option>
                <option id="Book" value="Book">Book</option>
                <option id="DVD" value="DVD">DVD</option>
                
            </select>
        </p>
        <p class="attribute"></p>
        
     </div>
     </form>

</body>
</html>