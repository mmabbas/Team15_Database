<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

</head>

<body>

    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h1><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> One Month Overview</h1>
                </div>
            </div>
        </div>
    </header>

    <section id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="active">From <?php echo date("M d, Y", strtotime("-1 month")); ?> to <?php echo date("M d, Y"); ?></li>
            </ol>
        </div>
    </section>

    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Website Overview -->
                    <div class="panel panel-default">
                        <div class="panel-heading main-color-bg">
                            <h3 class="panel-title">Summary</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-3">
                                <div class="well dash-box">
                                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $usersAdded; ?></h2>
                                    <h4>Users Added</h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="well dash-box">
                                    <h2><span class="glyphicon glyphicon-book" aria-hidden="true"></span> <?php echo $titlesAdded; ?></h2>
                                    <h4>Titles Added</h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="well dash-box">
                                    <h2><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> <?php echo $checkOuts; ?></h2>
                                    <h4>Checkouts Initiated</h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="well dash-box">
                                    <h2><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> <?php echo $reservations; ?></h2>
                                    <h4>Reservations Made</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <canvas id="mostCheckedOutTitles"></canvas>
            </div>

            <div class="col-md-6">
                <canvas id="mostReservedTitles"></canvas>
            </div>
        </div>
    </section>

    <!-- Modals -->

    <script>
        let mostCheckedOutTitles = document.getElementById('mostCheckedOutTitles').getContext('2d');
        let mostReservedTitles = document.getElementById('mostReservedTitles').getContext('2d');

        //global options
        Chart.defaults.global.defaultFontFamily = 'Segoe UI';
        Chart.defaults.global.defaultFontSize = 15;
        Chart.defaults.global.defaultFontColor = 'white';

        let fineByUserChart = new Chart(mostCheckedOutTitles, {
            type: 'doughnut', //bar, horizontalBar, pie, line, doughnut, radar, polarArea
            data: {
                labels: [
                    '<?php echo $mostCheckedOut[0]['itemName']; ?>',
                    '<?php echo $mostCheckedOut[1]['itemName']; ?>',
                    '<?php echo $mostCheckedOut[2]['itemName']; ?>',
                    '<?php echo $mostCheckedOut[3]['itemName']; ?>',
                    '<?php echo $mostCheckedOut[4]['itemName']; ?>'
                ],
                datasets: [{
                    label: 'Number of CheckOuts:',
                    data: [
                        '<?php echo $mostCheckedOut[0]['count']; ?>',
                        '<?php echo $mostCheckedOut[1]['count']; ?>',
                        '<?php echo $mostCheckedOut[2]['count']; ?>',
                        '<?php echo $mostCheckedOut[3]['count']; ?>',
                        '<?php echo $mostCheckedOut[4]['count']; ?>'
                    ],

                    //backgroundColor:'grey'
                    backgroundColor: [
                        '#F85A3E',
                        '#FF7733',
                        '#E15634',
                        '#E63B2E',
                        '#E1E6E1',
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
                    text: 'Top 5 Most Checked Out Titles From <?php echo date("M d, Y", strtotime("-1 month")); ?> to <?php echo date("M d, Y"); ?>',
                    fontSize: 18,
                },
                legend: {
                    display: true,
                    position: 'left',
                    labels: {
                        fontColor: 'white'
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

        let mostReservedTitlesChart = new Chart(mostReservedTitles, {
            type: 'doughnut', //bar, horizontalBar, pie, line, doughnut, radar, polarArea
            data: {
                labels: [
                    '<?php echo $mostReserved[0]['itemName']; ?>',
                    '<?php echo $mostReserved[1]['itemName']; ?>',
                    '<?php echo $mostReserved[2]['itemName']; ?>',
                    '<?php echo $mostReserved[3]['itemName']; ?>',
                    '<?php echo $mostReserved[4]['itemName']; ?>'
                ],
                datasets: [{
                    label: 'Number of Reservations:',
                    data: [
                        '<?php echo $mostReserved[0]['count']; ?>',
                        '<?php echo $mostReserved[1]['count']; ?>',
                        '<?php echo $mostReserved[2]['count']; ?>',
                        '<?php echo $mostReserved[3]['count']; ?>',
                        '<?php echo $mostReserved[4]['count']; ?>'
                    ],

                    //backgroundColor:'grey'
                    backgroundColor: [
                        '#05668D',
                        '#427AA1',
                        '#679436',
                        '#A5BE00',
                        '#EBF2FA',
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
                    text: 'Top 5 Most Reserved Titles From <?php echo date("M d, Y", strtotime("-1 month")); ?> to <?php echo date("M d, Y"); ?>',
                    fontSize: 18,
                },
                legend: {
                    display: true,
                    position: 'right',
                    labels: {
                        fontColor: 'white'
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

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>