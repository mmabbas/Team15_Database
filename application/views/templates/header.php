<html>

<head>
    <title>Team 15 DBMS</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <script src="http://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">Team 15 Library App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <a class="nav-link" href="<?php echo base_url(); ?>users/dashboard">Dashboard <span class="sr-only">(current)</span></a>
                <a class="nav-link" href="<?php echo base_url(); ?>about">About</a>
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

            <form class="form-inline">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchText" placeholder="Search Books..." name="searchTest">
                    <span class="input-group-btn">
                        <button class="btn btn-light" type="button" onclick="pageRedirect();">Search</button>
                    </span>
                </div>
            </form>
        </div>
    </nav>

    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
            function pageRedirect() {
                var search = $('#searchText').val(); {
                    if (window.location.href != "<?php echo base_url(); ?>pages/search") {
                        window.location.href = "<?php echo base_url(); ?>pages/search";
                        if (search != '') {
                            load_data(search);
                        }
                    }
                    if (search != '') {
                        load_data(search);
                    } else {
                        load_data();
                    }
                }
            }


            function load_data(query) {
                $.ajax({
                    url: "<?php echo base_url(); ?>getitem/getData",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#items').html(data);
                    }
                })
            }
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