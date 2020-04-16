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
						<a href='<?php echo base_url('users/checkedOut'); ?>' class="list-group-item"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Checkouts <span class="badge"><?php echo $numOfCheckOuts; ?></span></a>
						<a href='<?php echo base_url('users/reserveStatus'); ?>' class="list-group-item active main-color-bg">
							<span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> Reservations <span class="badge"><?php echo $reserveNum; ?></span>

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
									<th>Item ID</th>
									<th>Requested By</th>
									<th>Reservation Created On</th>
									<th>Reservation Expires On</th>

									<?php foreach ($reservations as $reservation) : ?>
								<tr>
									<td><?php echo $reservation['itemName']; ?></td>
									<td>UserID # <?php echo $reservation['userID']; ?></td>
									<td><?php echo $reservation['reservationDate']; ?></td>
									<td><?php echo $reservation['expirationDate']; ?></td>
									<td><a button type="button" class="btn btn-cancel" href = '<?php base_url('users/cancelReservation'); ?>'>Cancel</button></td>
								</tr>
							<?php endforeach; ?>

							</table>
						</div>
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