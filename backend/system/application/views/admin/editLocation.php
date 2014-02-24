<br><br>
<div class="bs-docs-section">
	<div class="row">
	<? $this->renderPartial('flashmessage'); ?>
    </div>
	<div class="row">
		<div class="span12">
        <h2>Edit location from unit: <b><?= $this->unit; ?></b></h2>			
		<form class="form-horizontal" method="post" action="<?= URL::base_uri(); ?>admin/editLocation/<?= $this->unit; ?>">	
		
			<div class="control-group <?php echo $this->form->getFieldStatus('location'); ?>">
			<label class="control-label" for="location">New Location</label>
                <div class="controls">
                    <input id="location" name="location" type="text" value="" />
                    <span class="help-inline"></span>
                </div>
            </div>
			
		
	<br>
	<div class="form-actions">
        <button type="submit" class="btn btn-primary">Change Unit Location</button>
     </div>
	 
	 </form>
		
    </div>
	
    </div>

</div>

