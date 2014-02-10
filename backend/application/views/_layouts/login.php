<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->renderPartial('loginheader'); ?>
</head>

<body>
<div class="container">
    <?php $this->renderPartial('flashmessage'); ?>
    <?php $this->getContent(); ?>
    <hr>

</div> <!-- /container -->
<?php $this->renderPartial('scripts'); ?>

</body>
</html>