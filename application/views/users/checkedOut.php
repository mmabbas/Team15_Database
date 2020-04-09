<h2><?= $title ?></h2>

<?php foreach($items as $item) : ?>
	<h3><?php echo $item['title']; ?></h3>
	<div class="row">
		<div class="col-md-12">
        <small class="post-date">Book checked out: <?php echo $item['checkoutDate']; ?> <br> <strong>Due on: <?php echo $item['dueDate']; ?></strong></small><br>
		<br><br>
		</div>
	</div>
<?php endforeach; ?>
