<html>

<head>
    <title>Team 15 DBMS</title>
    <link rel="stylesheet" href="https://bootswatch.com/3/darkly/bootstrap.min.css">
    <script src="http://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <link href="<?php echo base_url(); ?>/assets/css/style.css" rel="stylesheet" />
</head>

<body>

    <nav class="navbar navbar-inverse" style="background-color: #464545;">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php if (!$this->session->userdata('logged_in')) : ?>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>">Team 15 Library App</a>
                <?php endif; ?>
                <?php if ($this->session->userdata('logged_in')) : ?>
                    <?php if ($this->session->userdata('userType') == "Admin") : ?>
                        <a class="navbar-brand" href="<?php echo base_url(); ?>users/adminDashboard">Team 15 Library App</a>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('userType') == "User") : ?>
                        <a class="navbar-brand" href="<?php echo base_url(); ?>users/newDash">Team 15 Library App</a>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php if ($this->session->userdata('logged_in')) : ?>
                        <?php if ($this->session->userdata('userType') == "Admin") : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url(); ?>users/adminDashboard">Dashboard <span class="sr-only">(current)</span></a>
                            </li>
                        <?php endif; ?>
                        <?php if ($this->session->userdata('userType') == "User") : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url(); ?>users/newDash">Dashboard <span class="sr-only">(current)</span></a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>about">About</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (!$this->session->userdata('logged_in')) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>users/adminLogin">Admin Portal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>users/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>users/register">Register</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('logged_in')) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>users/logout">Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <form class="navbar-form navbar-right" action="<?php echo base_url(); ?>pages/search">
                    <div class="form-group">

                    </div>
                    <button class="btn btn-info" type="button">Search</button>
                </form>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
        $(document).ready(function() {
            $("button").click(function() {
                var search = $('#searchtxt').val();
                var type = $("#searchType :selected").val();
                var title = $("#searchTitle :selected").val();
                if (window.location.href != "<?php echo base_url(); ?>users/search") {
                    window.location.href = "<?php echo base_url(); ?>users/search";
                } else {
                if (search != '') {
                    load_data(search, type, title);
                }
              }

                function load_data(search, type, title) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>getitem/getData",
                        method: "POST",
                        data: {search: search, type, title},
                        success: function(data) {
                            $('#items').html(data);
                        }
                    })
                }
            })
        });
        </script>
    </head>

    <div class="container">
        <!-- Flash messages -->
        <?php if ($this->session->flashdata('user_registered')) : ?>
            <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_registered') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('post_created')) : ?>
            <?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_created') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('post_updated')) : ?>
            <?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_updated') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('category_created')) : ?>
            <?php echo '<p class="alert alert-success">' . $this->session->flashdata('category_created') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('post_deleted')) : ?>
            <?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_deleted') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('login_failed')) : ?>
            <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('login_failed') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('user_loggedin')) : ?>
            <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loggedin') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('user_loggedout')) : ?>
            <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loggedout') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('not_signed_in')) : ?>
            <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('not_signed_in') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('no_reservations')) : ?>
            <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('no_reservations') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('item_added')) : ?>
            <?php echo '<p class="alert alert-success">' . $this->session->flashdata('item_added') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('none_checkedOut')) : ?>
            <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('none_checkedOut') . '</p>'; ?>
        <?php endif; ?>
