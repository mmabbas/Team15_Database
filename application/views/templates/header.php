<html>

<head>
    <title>Team 15 DBMS</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <script src="http://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">Team 15 Library App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                    <a class="nav-link" href="<?php echo base_url(); ?>users/dashboard">Dashboard <span class="sr-only">(current)</span></a>
                    <a class="nav-link" href="<?php echo base_url(); ?>about">About</a>
                </li>
            </div>
            <ul class="navbar-nav ml-auto">
                <?php if(!$this->session->userdata('logged_in')) : ?>
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
                <?php if($this->session->userdata('logged_in')) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>users/logout">Logout</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

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