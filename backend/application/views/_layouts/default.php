<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->renderPartial('headermeta'); ?>
</head>

<body>
	<?php $this->renderPartial('navbar'); ?>
	<div class="container">
    		<h2 class="display:none;"><?php echo $this->getPagetitle(); ?></h2>
    		<?php $this->getContent(); ?>
    		<hr>
    		<?php $this->renderPartial('footer'); ?>
	</div> <!-- /container -->
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="<?= URL::base_uri(); ?>js/bootstrap.min.js"></script>
	<script src="<?= URL::base_uri(); ?>js/bootswatch.js"></script>
</body>
</html>
