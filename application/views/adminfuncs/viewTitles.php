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
                    <h1><span class="glyphicon glyphicon-book" aria-hidden="true"></span> View All Titles</h1>
                </div>
            </div>
        </div>
    </header>

    <section id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="active">All Titles</li>
            </ol>
        </div>
    </section>

    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group">
                        <a href='<?php echo base_url('adminportal/adminDashboard'); ?>' class="list-group-item"> <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</a>
                        <a href='<?php echo base_url('adminportal/viewUsers'); ?>' class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge"><?php echo $userCount; ?></span></a>
                        <a href='<?php echo base_url('adminportal/viewTitles'); ?>' class="list-group-item active main-color-bg">
                            <span class="glyphicon glyphicon-book" aria-hidden="true"></span> Titles <span class="badge"><?php echo $totalTitles; ?></span>
                        </a>
                        <a href='<?php echo base_url('adminportal/adminReports'); ?>' class="list-group-item"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Reports <span class="badge"></span></a>

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
                                    <a class="btn btn-primary" href='<?php echo base_url('adminportal/addItem'); ?>' role="button">Add Item</a>

                                </div>
                            </div>
                            <br>
                            <table class="table table-striped table-hover">
                                <tr>
                                    <th>Item ID</th>
                                    <th>Title</th>
                                    <th>ISBN</th>
                                    <th>Genre</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <?php foreach ($allTitles as $title) : ?>
                                <tr>
                                    <?php if ($title->status != "Deleted") : ?>
                                        <td><?php echo $title->itemID; ?></td>
                                        <td><?php echo $title->title; ?></td>
                                        <td><?php echo $title->isbn; ?></td>
                                        <td><?php echo $title->genre; ?></td>
                                        <td><?php echo $title->author; ?></td>
                                        <td><?php echo $title->status; ?></td>
                                        <td><a href="<?php echo base_url(); ?>adminportal/editItem/<?php echo $title->itemID; ?>" class="btn btn-success">Edit</a></td>
                                        <td><a href="<?php echo base_url(); ?>adminportal/confirmDeletion/<?php echo $title->itemID; ?>" class="btn btn-danger">Delete</a></td>
                                    <?php endif; ?>
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
    <script src="js/bootstrap.min.js"></script>
</body>

</html>