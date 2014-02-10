 <!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->renderPartial('headermeta'); ?>
</head>

<body>

<?php $this->renderPartial('navbar'); ?>

<div class="container">
    <?php $this->renderPartial('flashmessage'); ?>

    <h1><?php echo $this->getPagetitle(); ?></h1>

    <?php $this->getContent(); ?>
    <hr>

</div> <!-- /container -->

<?php $this->renderPartial('footer'); ?>
<?php $this->renderPartial('scripts'); ?>

</body>
</html>