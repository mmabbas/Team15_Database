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
					<h1><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> View Fees</h1>
				</div>
			</div>
		</div>
	</header>

	<section id="breadcrumb">
		<div class="container">
			<ol class="breadcrumb">
				<li class="active"> User Fees</li>
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
						<a href='<?php echo base_url('users/reserveStatus'); ?>' class="list-group-item">
							<span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> Reservations <span class="badge"><?php echo $reserveNum; ?></span>
						</a>
						<a href='<?php echo base_url('users/userFees'); ?>' class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> Fees</a>
					</div>
				</div>
				<div class="col-md-9">
					<!-- Website Overview -->
					<div class="panel panel-default">
						<div class="panel-heading main-color-bg">
							<h3 class="panel-title">Titles</h3>
						</div>
						<div class="panel-body">
							<div class="col-md-3">
                                <div class="well dash-box">
                                    <h2>$<?php echo $feeTotal; ?></h2>
                                    <h4>Fee Total</h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="well dash-box">
                                    <h2><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> <?php echo $feeCount; ?></h2>
                                    <h4>Unpaid Fees</h4>
                                </div>
                            </div>
							<br>
							<table class="table table-striped table-hover">
								<tr>
									<th>Title</th>
									<th>Date Fee Applied</th>
									<th>Date Paid</th>
									<th>Status</th>
									<th>Amount</th>
									<th>Pay</th>

									<?php foreach ($feesNums as $feeNum) : ?>
								<tr>
									<td><?php echo $feeNum['title']; ?></td>
									<td><?php echo $feeNum['dateCreated']; ?></td>
									<td><?php echo $feeNum['dateSettled']; ?></td>
                                    <td><?php echo $feeNum['feeStatus']; ?></td>
                                    <td>$<?php echo $feeNum['feeAmount']; ?></td>
									<?php if ($feeNum['feeStatus'] == "Unpaid") : ?>
										<td><a href="<?php echo base_url(); ?>users/confirmPayment/<?php echo $feeNum['feeID']; ?>" class="btn btn-success">Pay</a></td>
									<?php endif; ?>
									<?php if ($feeNum['feeStatus'] == "Paid") : ?>
										<td> </td>
										<td> </td>
									<?php endif; ?>
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