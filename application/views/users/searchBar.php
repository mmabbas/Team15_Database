<body>
  <link rel="stylesheet" href="<?php echo base_url('./assets/css/style.css')?>">
  <div class="container">
      	<div class="jumbotron">
            <div class="input-group mb-3">
            <input type="text" class="form-control" id="searchText" placeholder="Search Books..." name="searchTest">
            <div class="input-group-append">
              <button class="btn btn-warning" type="button">Search</button>
            </div>
            </div>
          </div>
  	    </div>
      </div>
      <div class = "items-container">
        <div id="items"></div>
      </div>
</body>

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("button").click(function(){
    var search = $('#searchText').val();{
      if(search != ''){
        load_data(search);
      }else{
        load_data();
      }
    }
    function load_data(query){
    $.ajax({
      url:"<?php echo base_url(); ?>getitem/getData",
      method:"POST",
      data:{query:query},
      success:function(data){
        $('#items').html(data);
        }
      })
    }
  })
});
</script>
</head>
