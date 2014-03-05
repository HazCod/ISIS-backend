<br><br><br>
<div class="bs-docs-section">
        <div class="row">
		<? $this->renderPartial('flashmessage'); ?>
        </div>
<div class="row">
    <div class="span12">
        <h2>Found passwords</h2>
		
		<? if ($this->passwords): ?>

            <table class="table table-striped">

                <thead>
                <tr>
                    <? foreach ($this->passwords[0] as $titel => $data): ?>
                        <th><?= ucfirst($titel); ?></th>
                    <? endforeach; ?>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <? foreach ($this->passwords as $nr => $data): ?>
				<tr>
					<? foreach ($data as $nrunit => $unit): ?>
					
                        <td><?= $unit; ?></td>
						
                 <? endforeach; ?>
				 </tr>
				 <? endforeach; ?>
				
                </tbody>
            </table>
			
        <? else: ?>
            <p><b>No found passwords.</b></p>
        <? endif; ?>
		
    </div>
	
    </div>

</div>