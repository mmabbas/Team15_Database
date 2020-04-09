<h2><?= $title ?></h2>
<br>
<?php foreach ($reservations as $reservation) : ?>
    <h3><?php echo $reservation['itemName']; ?></h3>
    <div class="row">
        <div class="col-md-12">
            <small class="post-date">
                <strong>Requested By <?php echo $reservation['userID']; ?></strong> <br>
                Reservation created on: <?php echo $reservation['reservationDate']; ?><br>
                Reservation expires on: <?php echo $reservation['expirationDate']; ?>
            </small>
            <br> <br><br>
        </div>
    </div>
<?php endforeach; ?>