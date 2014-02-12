<br><br><br>
<div class="bs-docs-section">
        <div class="row">
		<? $this->renderPartial('flashmessage'); ?>
        </div>
<div class="row">
    <div class="span12">
        <h2>Unit Interface</h2>
		
		<? if ($this->units): ?>

            <table class="table table-striped">

                <thead>
                <tr>
                    <? foreach ($this->units[0] as $titel => $data): ?>
                        <th><?= ucfirst($titel); ?></th>
                    <? endforeach; ?>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <? foreach ($this->units as $nr => $data): ?>
				<tr>
					<? foreach ($data as $nrunit => $unit): ?>
					
                        <td><?= $unit; ?></td>
						
                 <? endforeach; ?>
				 <td>
				 <a href="<?= URL::base_uri(); ?>admin/editLocation/<?= $this->units[$nr]['caption']; ?>"><i class="icon-trash"></i>Edit location&nbsp&nbsp&nbsp </a>
				 <a href="<?= URL::base_uri(); ?>admin/units/<?= $this->units[$nr]['caption']; ?>"><i class="icon-trash"></i>Details&nbsp&nbsp&nbsp</a>
				 <a href="<?= URL::base_uri(); ?>admin/deleteUnit/<?= $this->units[$nr]['caption']; ?>"><i class="icon-trash"></i>Remove</a>
				 </td>
				 </tr>
				 <? endforeach; ?>
				
                </tbody>
            </table>
			
        <? else: ?>
            <p><b>No units added</b></p>
        <? endif; ?>
		
		<div class="form-actions">
            <button type="submit" onclick="location.href='<?= URL::base_uri(); ?>admin/addUnit'" class="btn btn-primary">New unit</button>
        </div>
		
		
    </div>




    </div>

</div>

