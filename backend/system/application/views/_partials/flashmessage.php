<?php if ($this->flashmessage): ?>
    <div class="alert alert-dismissable alert-<?= $this->flashmessage->status; ?>">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo $this->flashmessage->message; ?>
    </div>
<?php endif; ?>
