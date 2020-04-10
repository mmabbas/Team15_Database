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
   <h3 align="center">Checkout Cart</h3><br />
   <?php

   foreach($item as $row)
   {
    echo '
	<div>
	 <h4>'.$row->title.' </h4>
	 <input type="text" id="'.$row->itemID.'" /><br />
	 <button type="button" name="add_cart" class="btn btn-success add_cart" 
	 data-title = "'.$row->title.'" 
	 data-itemID="'.$row->itemID.'" \>Add to Cart</button>
	</div>
	';	
   }
   ?>

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
  //var item_quantity = $('#' + itemID).val();
  /*if(quantity != '' && quantity > 0)
  {
   $.ajax
   (
   {
    url:"<?php echo base_url(); ?>checkout_cart/add",
    method:"POST",
    data:{item_id:item_id, item_name:item_name, quantity:quantity},
    success:function(data)
    {
     alert("Item Added into Cart");
     $('#cart_details').html(data);
     $('#' + item_id).val('');
    }
   }
   );
  }
  else
  {
   alert("Please Enter quantity");
  }
 }
 */
 );

 $('#cart_details').load("<?php echo base_url(); ?>checkout_cart/load");

 $(document).on('click', '.remove_inventory', function(){
  var row_id = $(this).attr("id");
  if(confirm("Are you sure you want to remove this?"))
  {
   $.ajax({
    url:"<?php echo base_url(); ?>checkout_cart/remove",
    method:"POST",
    data:{row_id:row_id},
    success:function(data)
    {
     alert("item removed from Cart");
     $('#cart_details').html(data);
    }
   });
  }
  else
  {
   return false;
  }
 });

 $(document).on('click', '#clear_cart', function(){
  if(confirm("Are you sure you want to clear cart?"))
  {
   $.ajax({
    url:"<?php echo base_url(); ?>checkout_cart/clear",
    success:function(data)
    {
     alert("Your cart has been clear...");
     $('#cart_details').html(data);
    }
   });
  }
  else
  {
   return false;
  }
 });

});
</script>
