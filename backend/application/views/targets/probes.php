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
                    <th>Probed Networks</th>
                </tr>
                </thead>

                <tbody>
                <? foreach ($this->probes as $data): ?>
                    <td><?= $data; ?></td>		
                 <td>   
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

