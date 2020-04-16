<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Dashboard</title>

</head>

<body>

    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo "Hello " . $firstName . "!"; ?></h1>
                </div>
            </div>
        </div>
    </header>

    <section id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="active">Dashboard</li>
            </ol>
        </div>
    </section>

    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group">
                        <a href='<?php echo base_url('users/newDash'); ?>' class="list-group-item active main-color-bg">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
                        </a>
                        <a href='<?php echo base_url('users/checkedOut'); ?>' class="list-group-item"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Checkouts <span class="badge"><?php echo $numOfCheckOuts; ?> Active</span></a>
                        <a href='<?php echo base_url('users/reserveStatus'); ?>' class="list-group-item"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> Reservations <span class="badge"><?php echo $reserveNum; ?> Active</span></a>
                    </div>
                </div>
                <div class="col-md-9">
                    <!-- Website Overview -->
                    <div class="panel panel-default">
                        <div class="panel-heading main-color-bg">
                            <h3 class="panel-title">Overview</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-3">
                                <div class="well dash-box">
                                    <h2><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> <?php echo $numOfCheckOuts; ?></h2>
                                    <h4>Active Checkouts</h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="well dash-box">
                                    <h2><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> <?php echo $reserveNum; ?></h2>
                                    <h4>Pending Reservations</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Active Checkouts -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Current Titles Checked Out</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-hover">
                                <tr>
                                    <th>Title</th>
                                    <th>Checkout Date</th>
                                    <th>Due Date</th>

                                    <?php foreach ($activeCheckOuts as $item) : ?>
                                <tr>
                                    <td><?php echo $item['title']; ?></td>
                                    <td><?php echo $item['checkoutDate']; ?></td>
                                    <td><?php echo $item['dueDate']; ?></td>
                                </tr>
                            <?php endforeach; ?>

                            </tr>

                            </table>
                        </div>
                    </div>

                    <!-- Newest Reservations -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Current Reservations</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-hover">
                                <tr>
                                    <th>Name</th>
                                    <th>Reservation Date</th>
                                    <th>Experiation Date</th>
                                    <th>Cancel Reservation</th>
                                    <th>Check Out Book</th>

                                    <?php foreach ($latestReservations as $reservation) : ?>
                                <tr>
                                    <td><?php echo $reservation['itemName']; ?></td>
                                    <td><?php echo $reservation['reservationDate']; ?></td>
                                    <td><?php echo $reservation['expirationDate']; ?></td>
                                    <td><a href="<?php echo base_url(); ?>users/confirmCancelation/<?php echo $reservation['itemID']; ?>" class="btn btn-success">Cancel</a></td>
                                    <?php if ($reservation['status'] == "Processing") : ?>
										<td><a href="<?php echo base_url(); ?>users/confirmCheckout/<?php echo $reservation['itemID']; ?>" class="btn btn-success">Check Out</a></td>
									<?php endif; ?>
									<?php if ($reservation['status'] == "Canceled") : ?>
										<td>  N/A</td>
									<?php endif; ?>
                                </tr>
                            <?php endforeach; ?>

                            </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modals -->

    <!-- Add Page -->
    <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Page</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Page Title</label>
                            <input type="text" class="form-control" placeholder="Page Title">
                        </div>
                        <div class="form-group">
                            <label>Page Body</label>
                            <textarea name="editor1" class="form-control" placeholder="Page Body"></textarea>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Published
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Meta Tags</label>
                            <input type="text" class="form-control" placeholder="Add Some Tags...">
                        </div>
                        <div class="form-group">
                            <label>Meta Description</label>
                            <input type="text" class="form-control" placeholder="Add Meta Description...">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        CKEDITOR.replace('editor1');
    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>