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
                    <h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span> View Registered Users</h1>
                </div>
            </div>
        </div>
    </header>

    <section id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="active">User View</li>
            </ol>
        </div>
    </section>

    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group">
                        <a href='<?php echo base_url('adminportal/adminDashboard'); ?>' class="list-group-item"> <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</a>
                        <a href='<?php echo base_url('adminPortal/viewUsers'); ?>' class="list-group-item active main-color-bg">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge"><?php echo $userCount; ?></span>
                        </a>
                        <a href='<?php echo base_url('adminportal/viewTitles'); ?>' class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Titles <span class="badge"><?php echo $totalTitles; ?></span></a>
                        <a href='<?php echo base_url('adminportal/viewCheckouts'); ?>' class="list-group-item"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Checkouts <span class="badge"><?php echo $checkOuts; ?></span></a>
                        <a href='<?php echo base_url('adminportal/adminReservations'); ?>' class="list-group-item"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> Reservations <span class="badge"><?php echo $reservations; ?></span></a>
                    </div>


                </div>
                <div class="col-md-9">
                    <!-- Website Overview -->
                    <div class="panel panel-default">
                        <div class="panel-heading main-color-bg">
                            <h3 class="panel-title">Users</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="search" class="form-control form-control-sm" placeholder="Search for User" aria-controls="userTable">
                                </div>
                            </div>
                            <br>
                            <table id="userTable" class="table table-striped table-hover">
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Login ID</th>
                                    <th>Email</th>
                                    <?php foreach ($userInfo as $user) : ?>
                                <tr>
                                    <td><?php echo $user->userID; ?></td>
                                    <td><?php echo $user->firstName; ?> <?php echo $user->lastName; ?> </td>
                                    <td><?php echo $user->loginID; ?></td>
                                    <td><?php echo $user->email; ?></td>
                                </tr>
                            <?php endforeach; ?>

                            </tr>

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
    <script src="<?php echo base_url(); ?>/assets/js/bootstrap.min.js"></script>
</body>

</html>