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
					<h1><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> User Profile</h1>
				</div>
			</div>
		</div>
	</header>

	<section id="breadcrumb">
		<div class="container">
			<ol class="breadcrumb">
				<li class="active">User Profile</li>
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
                        <a href='<?php echo base_url('users/checkedOut'); ?>' class="list-group-item active main-color-bg">
							<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Checkouts <span class="badge"><?php echo $numOfCheckOuts; ?> Active</span>
						</a>
						<a href='<?php echo base_url('users/reserveStatus'); ?>' class="list-group-item"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> Reservations <span class="badge"><?php echo $reserveNum; ?> Active</span></a>
					</div>
				</div>
				<div class="col-md-9">
					<!-- Website Overview -->
					<div class="panel panel-default">
						<div  class="panel-heading main-color-bg">
							<h3 class="panel-title">User Info</h3>
						</div>
						<div class="panel-body">
						<table class="table table-striped table-hover">
							<tr>
								<th>First Name</th>
								<td><?php echo $this->session->userdata['first_name']; ?></td>
							</tr>
							<tr>
								<th>Last Name</th>
								<td><?php echo $this->session->userdata['last_name']; ?></td>
							</tr>
							<tr>
								<th>Age</th>
								<td><?php echo $this->session->userdata['age']; ?></td>
							</tr>
							<tr>
								<th>Email</th>
								<td><?php echo $this->session->userdata['email']; ?></td>
							</tr>
							<tr>
								<th>User Type</th>
								<td><?php echo $this->session->userdata['user_type']; ?></td>
							</tr>
							<tr>
								<th>Username</th>
								<td><?php echo $this->session->userdata['username']; ?></td>
							</tr>
							<tr>
								<th>Password</th>
								<td>********</td>
							</tr>
						</table>
						<a href="<?php echo base_url(); ?>users/editProfile/" class="btn btn-success">Edit</a>
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