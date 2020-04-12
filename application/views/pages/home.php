<!DOCTYPE html>
<html>

<head>
  <title>Team 15 Library Web App</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="<?php echo base_url(); ?>/assets/css/landing.css" rel="stylesheet" />
</head>


<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url(); ?>">Team 15 Library App</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>about">About</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>users/searchBar" class="btn btn-warning btn-lg" type="button">Search</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>users/adminLogin">Admin Portal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>users/login">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>users/register">Register</a>
        </li>
      </ul>
    </div>
    <!--/.nav-collapse -->
  </div>
</nav>

<body>

  <div id="home">
    <div class="landing-text">
      <h1>WELCOME</h1>
      <h4>TO THE TEAM 15 LIBRARY DATABASE</h4>
      <br>
      <a href="<?php echo base_url(); ?>users/login" class="btn btn-default btn-lg">Login</a>
      <a href="<?php echo base_url(); ?>users/register" class="btn btn-default btn-lg">Register</a>
      <a href="<?php echo base_url(); ?>users/adminLogin" class="btn btn-default btn-lg">Admin Portal</a>
    </div>
  </div>
</body>

</html>