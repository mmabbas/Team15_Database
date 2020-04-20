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
          <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Manage the Library</h1>
        </div>
      </div>
    </div>
  </header>

  <section id="breadcrumb">
    <div class="container">
      <ol class="breadcrumb">
        <li class="active">Dashboard</li>
      </ol>
    </div>
  </section>

  <section id="main">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="list-group">
            <a href='<?php echo base_url('adminportal/adminDashboard'); ?>' class="list-group-item active main-color-bg">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
            </a>
            <a href='<?php echo base_url('adminportal/viewUsers'); ?>' class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge"><?php echo $userCount; ?></span></a>
            <a href='<?php echo base_url('adminportal/viewTitles'); ?>' class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Titles <span class="badge"><?php echo $totalTitles; ?></span></a>
            <a href='<?php echo base_url('adminportal/adminReports'); ?>' class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Reports <span class="badge"></span></a>
          
          </div>


        </div>
        <div class="col-md-9">
          <!-- Website Overview -->
          <div class="panel panel-default">
            <div class="panel-heading main-color-bg">
              <h3 class="panel-title">Library Overview</h3>
            </div>
            <div class="panel-body">
              <div class="col-md-3">
                <div class="well dash-box">
                  <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $userCount; ?></h2>
                  <h4>Users</h4>
                </div>
              </div>
              <div class="col-md-3">
                <div class="well dash-box">
                  <h2><span class="glyphicon glyphicon-book" aria-hidden="true"></span> <?php echo $totalTitles; ?></h2>
                  <h4>Titles</h4>
                </div>
              </div>
              <div class="col-md-3">
                <div class="well dash-box">
                  <h2><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> <?php echo $checkOuts; ?></h2>
                  <h4>Active Checkouts</h4>
                </div>
              </div>
              <div class="col-md-3">
                <div class="well dash-box">
                  <h2><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> <?php echo $reservations; ?></h2>
                  <h4>Pending Reservations</h4>
                </div>
              </div>
            </div>
          </div>

          <!-- Newest Reservations -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Newest Reservations</h3>
            </div>
            <div class="panel-body">
              <table class="table table-striped table-hover">
                <tr>
                  <th>Name</th>
                  <th>Requested By</th>
                  <th>Reservation Date</th>
                  <th>Expiration Date</th>
                  
                  <?php foreach ($latestReservations as $reservation) : ?>
                    <tr>
                    <td><?php echo $reservation['itemName']; ?></td>
                    <td>UserID #<?php echo $reservation['userID']; ?></td>
                    <td><?php echo $reservation['reservationDate']; ?></td>
                    <td><?php echo $reservation['expirationDate']; ?></td>
                    </tr>
                  <?php endforeach; ?>
                  
                </tr>

              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modals -->

  <!-- Add Page -->
  <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Page</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Page Title</label>
              <input type="text" class="form-control" placeholder="Page Title">
            </div>
            <div class="form-group">
              <label>Page Body</label>
              <textarea name="editor1" class="form-control" placeholder="Page Body"></textarea>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox"> Published
              </label>
            </div>
            <div class="form-group">
              <label>Meta Tags</label>
              <input type="text" class="form-control" placeholder="Add Some Tags...">
            </div>
            <div class="form-group">
              <label>Meta Description</label>
              <input type="text" class="form-control" placeholder="Add Meta Description...">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

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