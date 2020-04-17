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
					<h1><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> View Reservations</h1>
				</div>
			</div>
		</div>
	</header>

	<section id="breadcrumb">
		<div class="container">
			<ol class="breadcrumb">
				<li class="active"> Active Reservations</li>
			</ol>
		</div>
	</section>

	<section id="main">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="list-group">
						<a href='<?php echo base_url('users/newDash'); ?>' class="list-group-item"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</a>
						<a href='<?php echo base_url('users/userprofile'); ?>' class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> User Profile <span class="badge"></span></a>
						<a href='<?php echo base_url('users/checkedOut'); ?>' class="list-group-item"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Checkouts <span class="badge"><?php echo $numOfCheckOuts; ?></span></a>
						<a href='<?php echo base_url('users/reserveStatus'); ?>' class="list-group-item active main-color-bg">
							<span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> Reservations <span class="badge"><?php echo $reserveNum; ?></span>
						<!-- <a href='<?php echo base_url('users/reservationHistory'); ?>' class="list-group-item"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Reservation History</a> -->
						</a>
					</div>
				</div>
				<div class="col-md-9">
					<!-- Website Overview -->
					<div class="panel panel-default">
						<div class="panel-heading main-color-bg">
							<h3 class="panel-title">Titles</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<!-- <input class="form-control" type="text" placeholder="Filter Users..."> -->
									<!-- <a class="btn btn-primary" href='<?php echo base_url('adminPortal/addItem'); ?>' role="button">Add Item</a> -->

								</div>
							</div>
							<br>
							<table class="table table-striped table-hover">
								<tr>
									<th>Title</th>
									<th>Reservation Created On</th>
									<th>Reservation Expires On</th>
									<th>Status</th>
									<th>Cancel Reservation</th>
									<th>Check Out</th>

									<?php foreach ($reservations as $reservation) : ?>
								<tr>
									<td><?php echo $reservation['itemName']; ?></td>
									<td><?php echo $reservation['reservationDate']; ?></td>
									<td><?php echo $reservation['expirationDate']; ?></td>
									<td><?php echo $reservation['status']; ?></td>
									<?php if ($reservation['status'] == "Reserved") : ?>
										<td><a href="<?php echo base_url(); ?>users/confirmCancelation/<?php echo $reservation['itemID']; ?>" class="btn btn-success">Cancel</a></td>
										<td><a href="<?php echo base_url(); ?>users/confirmCheckout/<?php echo $reservation['itemID']; ?>" class="btn btn-success">Check Out</a></td>
									<?php endif; ?>
									<?php if ($reservation['status'] == "Canceled") : ?>
										<td> </td>
										<td> </td>
									<?php endif; ?>
								</tr>
							<?php endforeach; ?>

							</table>
						</div>
						<a href="<?php echo base_url(); ?>users/getHistory" class="btn btn-sucess"> Reservation History</a>
					</div>
				</div>
			</div>
	</section>

	<!-- Modals -->



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