<h2><?= $title ?></h2>

<?php foreach($reservations as $reservation) : ?>
	<h3><?php echo $reservation['itemName']; ?></h3>
	<div class="row">
		<div class="col-md-12">
        <small class="post-date">Reservation created on: <?php echo $reservation['reservationDate']; ?> <br> <strong>Reservation expires on: <?php echo $reservation['expirationDate']; ?></strong></small><br>
		<br><br>
		</div>
	</div>
<?php endforeach; ?>
