<br><br><br>
<div class="bs-docs-section">
        <div class="row">
		<? $this->renderPartial('flashmessage'); ?>
        </div>
<div class="row">
    <div class="span12">
        <h2>Probe list for <?= $this->device; ?></h2>
		<? if ($this->probes): ?>

            <table class="table table-striped">
                <thead>
                <tr>
                    <? foreach ($this->probes[0] as $titel => $data): ?>
                        <th><?= ucfirst($titel); ?></th>
                    <? endforeach; ?>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <? foreach ($this->probes as $nr => $data): ?>
				<tr>
					<? foreach ($data as $nrunit => $unit): ?>
                    <td><?= $unit; ?></td>		
                    <? endforeach; ?>
                 <td>   
                 </tr>
                 </tr>
				 <? endforeach; ?>			
                </tbody>
            </table>
			
        <? else: ?>
            <p><b>Device <?= $this->device; ?> has not been probing yet.</b></p>
        <? endif; ?>
		
    </div>
    </div>
</div>

