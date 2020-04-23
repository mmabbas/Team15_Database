<html>

<head>
  <title>Fees Report</title>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #222222;
      color: black;
    }

    .box {
      width: 1270px;
      padding: 20px;
      background-color: dimgray;
      color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-top: 25px;
    }
  </style>


</head>

<body>
  <div class="container box">
    <h4 style="float: left; width: 50%; text-indent: 450px; margin: 0;">Total Income</h4>
    <h4 style="float: right; width: 50%; text-indent: 30px; margin: 0;">Total Owed</h4>
    <h1 style="float: left; width: 50%; text-indent: 445px; color:#6ab04c; margin: 0;">$<?php echo $income; ?>.00</h1>
    <h1 style="float: right; width: 50%; text-indent: 20px; color:#ff7979; margin: 0;">$<?php echo $owe; ?>.00</h1>
    <h5 style="float: left; width: 50%; text-indent: 445px; margin: 0;">Total Paid Fees: <?php echo $income/5; ?></h5>
    <h5 style="float: right; width: 50%; text-indent: 15px; margin: 0;">Total Unpaid Fees: <?php echo $owe/5; ?></h5>

  </div>
  <div class="container box">
    <h1 align="center">Fees Report</h1>
    <br />
    <div class="table-responsive">
      <br />
      <div class="row">
        <div class="input-daterange">
          <div class="col-md-4">
            <input type="text" name="start_date" id="start_date" class="form-control" />
          </div>
          <div class="col-md-4">
            <input type="text" name="end_date" id="end_date" class="form-control" />
          </div>
        </div>
        <div class="col-md-4">
          <input type="button" name="search" id="search" value="Search" class="btn btn-info" />
        </div>
      </div>
      <br />
      <table id="order_data" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Fee ID</th>
            <th>User ID </th>
            <th>Item ID</th>
            <th>Title</th>
            <th>Fee Amount (US Dollars)</th>
            <th>Fee Status</th>
            <th>Fee Created</th>
            <th>Fee Settled</th>
          </tr>
        </thead>
      </table>

    </div>
  </div>

  <div class="container box">
    <canvas id="userFineChart"></canvas>
  </div>
</body>

</html>



<script type="text/javascript" language="javascript">
  $(document).ready(function() {

    $('.input-daterange').datepicker({
      todayBtn: 'linked',
      format: "yyyy-mm-dd",
      autoclose: true
    });

    fetch_data('no');

    function fetch_data(is_date_search, start_date = '', end_date = '') {
      var dataTable = $('#order_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
          url: "<?php echo base_url(); ?>adminportal/fetchReportFeeData",
          type: "POST",
          data: {
            is_date_search: is_date_search,
            start_date: start_date,
            end_date: end_date
          }
        }
      });
    }

    $('#search').click(function() {
      var start_date = $('#start_date').val();
      var end_date = $('#end_date').val();
      if (start_date != '' && end_date != '') {
        $('#order_data').DataTable().destroy();
        fetch_data('yes', start_date, end_date);
      } else {
        alert("Both dates are required");
      }
    });

  });
</script>

<script>
  let userFineChart = document.getElementById('userFineChart').getContext('2d');

  //global options
  Chart.defaults.global.defaultFontFamily = 'Segoe UI';
  Chart.defaults.global.defaultFontSize = 17;
  Chart.defaults.global.defaultFontColor = 'white';

  let fineByUserChart = new Chart(userFineChart, {
    type: 'bar', //bar, horizontalBar, pie, line, doughnut, radar, polarArea
    data: {
      labels: [
        '<?php echo $topFiveUsers[0]['userID']; ?>',
        '<?php echo $topFiveUsers[1]['userID']; ?>',
        '<?php echo $topFiveUsers[2]['userID']; ?>',
        '<?php echo $topFiveUsers[3]['userID']; ?>',
        '<?php echo $topFiveUsers[4]['userID']; ?>'
      ],
      datasets: [{
          label: 'Amount of Fines Issued',
          data: [
            '<?php echo $topFiveUsers[0]['count']; ?>',
            '<?php echo $topFiveUsers[1]['count']; ?>',
            '<?php echo $topFiveUsers[2]['count']; ?>',
            '<?php echo $topFiveUsers[3]['count']; ?>',
            '<?php echo $topFiveUsers[4]['count']; ?>'
          ],
        
        //backgroundColor:'grey'
        backgroundColor: [
          '#F7B2B7',
          '#F7717D',
          '#DE639A',
          '#7F2982',
          '#16001E',
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
      text: 'Top 5 Users with the Most Fines',
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
    }, 
  }

  });
</script>