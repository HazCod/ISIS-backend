<br><br>
<div class="bs-docs-section">
	<div class="row">
	<? $this->renderPartial('flashmessage'); ?>
    </div>
	<div class="row">
		<div class="span12">
        <h2>Add unit:</h2>			
		<form class="form-horizontal" method="post" action="<?= URL::base_uri(); ?>admin/addUnit">	
		
			<div class="control-group <?php echo $this->form->getFieldStatus('caption'); ?>">
			<label class="control-label" for="caption">Caption</label>
                <div class="controls">
                    <input id="caption" name="caption" type="text" value="" />
                    <span class="help-inline"></span>
                </div>
            </div>
			
			<div class="control-group <?php echo $this->form->getFieldStatus('location'); ?>">
			<label class="control-label" for="location">Location</label>
                <div class="controls">
                    <input id="location" name="location" type="text" value="" />
                    <span class="help-inline"></span>
                </div>
            </div>
		
	<br>
	<div class="form-actions">
        <button type="submit" class="btn btn-primonclick="history.go(-1);"ary">Deploy Unit</button>
     </div>
	 
	 </form>
		
    </div>
	
    </div>

</div>

