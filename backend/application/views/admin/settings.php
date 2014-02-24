<br><br><br>
<div class="bs-docs-section">
    <div class="row">
	<? $this->renderPartial('flashmessage'); ?>
    </div>
	<div class="row">
    	<div class="span12">
        <h2>Settings</h2>
			<div class="col-lg-4">
				<div class="panel panel-default">
	          		<div class="panel-heading">Change Password</div>
						<form method="post" action="<?= URL::base_uri(); ?>settings/password">
	          				<div class="panel-body">
								<div class="input-group">
				   					<input type="text" name="password" id="password" class="form-control">
				    					<span class="input-group-btn">
				      						<button class="btn btn-default" type="submit">Change</button>
					    				</span>
					  			</div>
	          				</div>
						</form>
					</div>
	        	</div>
			</div>
   	</div>
</div>

