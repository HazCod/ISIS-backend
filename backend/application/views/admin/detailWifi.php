<br><br><br>
<div class="bs-docs-section">
        <div class="row">
		<? $this->renderPartial('flashmessage'); ?>
        </div>
<div class="row">
    <div class="span12">
        <h2>Connection <b><?= $this->connection; ?></b> details:</h2>
		
		<? if ($this->detailswifi): ?>

            <table class="table table-striped">

                <thead>
                <tr>
                    <? foreach ($this->detailswifi[0] as $titel => $data): ?>
                        <th><?= ucfirst($titel); ?></th>
                    <? endforeach; ?>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <? foreach ($this->detailswifi as $nr => $data): ?>
				<tr>
					<? foreach ($data as $nrunit => $unit): ?>
					
                        <td><?= $unit; ?></td>
						
                 <? endforeach; ?>
				 </tr>
				 <? endforeach; ?>
				
                </tbody>
            </table>
			
        <? else: ?>
            <p><b>No details for this network found yet.</b></p>
        <? endif; ?>
		
    </div>
	
    </div>

</div>

