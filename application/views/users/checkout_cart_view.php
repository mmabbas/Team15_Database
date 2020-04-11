<html>
<head>
    <title>Checkout Cart</title>
    <link rel="stylesheet" href="<?php echo base_url('./assets/css/style.css')?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
<div class="container">
 <br /><br />

 <div class="col-lg-10 col-md-5">
  <div class="table-responsive">
   <h3 align="center">Item List</h3><br />
   <?php

   foreach($item as $row)
   {
    echo '
	<div class="col-md-4" style="padding:16px; align="center">
	 <h4>'.$row->title.' </h4>
	 <h5>'.$row->author.' </h5>
     <input type="text" name="quantity" class="form-control quantity" id="'.$row->itemID.'" /><br />
     <button type="button" name="add_cart" class="btn btn-success add_cart" data-productname="'.$row->title.'" data-itemID="'.$row->itemID.'" />Add to Cart</button>
    </div>
	';	
   }
   ?>
  </div>
 </div>
 <div class="col-lg-10 col-md-5">
  <div id="cart_details">
   <h3 align="center">Cart is Empty</h3>
  </div>
 </div>
 
</div>
</body>
</html>
<script>
$(document).ready(function(){
 
 $('.add_cart').click(function(){
  var itemID = $(this).data("itemID");
  var title = $(this).data("title");
  var quantity = $('#' + itemID).val();
  
  if(quantity != '' && quantity > 0)
  {
   $.ajax
   (
   {
    url:"<?php echo base_url(); ?>checkout_cart/add",
    method:"POST",
    data:{itemID:itemID, title:title, quantity:quantity},
    success:function(data)
    {
     alert("Item added into Cart");
     $('#cart_details').html(data);
     $('#' + itemID).val('');
    }
   }
   );
  }
  else
  {
   alert("Please enter quantity");
  }
 }
 );

 $('#cart_details').load("<?php echo base_url(); ?>checkout_cart/load");

 $(document).on('click', '.remove_inventory', function(){
  var row_id = $(this).attr("id");
  if(confirm("Are you sure you want to remove this?"))
  {
   $.ajax
   (
   {
    url:"<?php echo base_url(); ?>checkout_cart/remove",
    method:"POST",
    data:{row_id:row_id},
    success:function(data)
    {
     alert("item removed from your cart");
     $('#cart_details').html(data);
    }
   }
   );
  }
  else
  {
   return false;
  }
 });

 $(document).on('click', '#clear_cart', function(){
  if(confirm("Are you sure you want to clear your cart?"))
  {
   $.ajax
   (
   {
    url:"<?php echo base_url(); ?>checkout_cart/clear",
    success:function(data)
    {
     alert("Your cart has been cleared...");
     $('#cart_details').html(data);
    }
   }
   );
  }
  else
  {
   return false;
  }
 });

});
</script>
