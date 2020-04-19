<html>
 <head>
  <title>Checkout Report</title>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
  <style>
   body
   {
    margin:0;
    padding:0;
    background-color:#222222;
    color:black;
   }
   .box
   {
    width:1270px;
    padding:20px;
    background-color:dimgray;
    color: #fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:25px;
   }
  </style>


 </head>
 <body>
  <div class="container box">
   <h1 align="center">Checkout Report</h1>
   <br />
   <div class="table-responsive">
    <br />
    <div class="row">
     <div class="input-daterange">
      <div class="col-md-4">
       <input type="text" name="start_date" id="start_date" class="form-control" placeholder="Starting Date" />
      </div>
      <div class="col-md-4">
       <input type="text" name="end_date" id="end_date" class="form-control" placeholder="Ending Date" />
      </div>
     </div>
     <div class="col-md-4">
      <input type="button" name="search" id="search" value="Search" class="btn btn-info" />
     </div>
     <div class="col-md-4">
     <label for="checkbox-checkedout">
     <input type="checkbox" id="checkbox-checkedout" name="checkbox-checkedout" value="Checked Out">
     Checked Out Items
     </label><br>
   </div>
    </div>
    <br />
    <table id="order_data" class="table table-bordered table-striped">
     <thead>
      <tr>
	   <th>Loan ID</th>
       <th>User ID</th>
	   <th>Item ID</th>
       <th>Title</th>
       <th>Date Checked Out</th>
	   <th>Due Date</th>
	   <th>Over Due</th>
	   <th>Status</th>
      </tr>
     </thead>
    </table>

   </div>
  </div>

  <div class="container box">
        <canvas id="myChart"></canvas>
    </div>
 </body>
</html>



<script type="text/javascript" language="javascript" >
$(document).ready(function(){

 $('.input-daterange').datepicker({
  todayBtn:'linked',
  format: "yyyy-mm-dd",
  autoclose: true
 });

 fetch_data('no');

 function fetch_data(is_date_search, start_date='', end_date='')
 {
   if (document.getElementById('checkbox-checkedout').checked) {
             var checkoutBox = $('#checkbox-checkedout').val();
         } else{
             var checkoutBox = '';
         }
  var dataTable = $('#order_data').DataTable({
   "processing" : true,
   "serverSide" : true,
   "order" : [],
   "ajax" : {
    url:"<?php echo base_url(); ?>adminportal/fetchReportCheckoutData",
    type:"POST",
    data:{
     is_date_search:is_date_search, start_date:start_date, end_date:end_date, checkoutBox:checkoutBox
    }
   }
  });
 }
 $('#checkbox-checkedout').click(function(){
   if (document.getElementById('checkbox-checkedout').checked) {
             var checkoutBox = $('#checkbox-checkedout').val();
         } else{
             var checkoutBox = '';
         }
  var start_date = $('#start_date').val();
  var end_date = $('#end_date').val();
  if(start_date != '' && end_date !='')
  {
   $('#order_data').DataTable().destroy();
   fetch_data('yes', start_date, end_date, checkoutBox);
  }
  else
  {
    $('#order_data').DataTable().destroy();
   fetch_data('no');
  }
});

 $('#search').click(function(){
  var start_date = $('#start_date').val();
  var end_date = $('#end_date').val();
  if(start_date != '' && end_date !='')
  {
   $('#order_data').DataTable().destroy();
   fetch_data('yes', start_date, end_date);
  }
  else
  {
   alert("Both dates are required");
  }
 });
});
</script>


<script>
        let myChart = document.getElementById('myChart').getContext('2d');

        //global options
        Chart.defaults.global.defaultFontFamily = 'Segoe UI';
        Chart.defaults.global.defaultFontSize = 17;
        Chart.defaults.global.defaultFontColor = 'white';

        let massPopChart = new Chart(myChart, {
            type: 'bar', //bar, horizontalBar, pie, line, doughnut, radar, polarArea
            data: {
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                datasets: [{
                    label: 'Amount of Checkouts',
                    data: [
                        1,
                        1,
                        1,
                        1,
                        1,
                        1,
                        1
                    ],
                    //backgroundColor:'grey'
                    backgroundColor: [
                        '#8F0B0B',
                        '#9C5700',
                        '#948B01',
                        '#006218',
                        '#001E9E',
                        '#390049',
                        '#614e6e'
                    ],
                    borderWidth: 1,
                    borderColor: 'grey',
                    hoverBorderWidth: 3,
                    hoverBorderColor: '#000'
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Amount of Checkouts by Day',
                    fontSize: 25,
                },
                legend: {
                    display: false,
                    position: 'right',
                    labels: {
                        fontColor: 'black'
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        bottom: 0,
                        top: 0,
                    }
                },
                tooltips: {
                    enabled: true
                }
            }

        });
    </script>
