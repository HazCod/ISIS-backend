<?php if ($this->flashmessage): ?>
    <div class="alert alert-<?php echo $this->flashmessage->status; ?>">
        <?php echo $this->flashmessage->message; ?>
    </div>
<?php endif; ?>