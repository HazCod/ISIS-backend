<br><br><br>
<div class="bs-docs-section">
        <div class="row">
		<? $this->renderPartial('flashmessage'); ?>
        </div>
<div class="row">
    <div class="span12">
        <h2>Found targets: </h2>
		<? if ($this->targets): ?>

            <table class="table table-striped">
                <thead>
                <tr>
                    <? foreach ($this->targets[0] as $titel => $data): ?>
                        <th><?= ucfirst($titel); ?></th>
                    <? endforeach; ?>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <? foreach ($this->targets as $nr => $data): ?>
				<tr>
					<? foreach ($data as $nrunit => $unit): ?>
                    <? if ($nrunit == 'Verbonden Access Point'): ?>
                    <td><a href="<?= URL::base_uri(); ?>admin/ap/<?= ltrim($unit); ?>"><?= $unit; ?></a></td>
                    <? else: ?>
                    <td><?= $unit; ?></td>
                    <? endif; ?>	
                    <? endforeach; ?>
                 <td>   
                 <? if ($data['Verbonden Access Point']): ?>
                 <a href="<?= URL::base_uri(); ?>targets/kickunit/<?= $data['location']; ?>/<?= $data['MAC'] ?>/<?= ltrim($data['Verbonden Access Point']); ?>"><i class="icon-trash"></i>Kick from AP&nbsp;&nbsp;</a>
                 <? endif; ?>
                 <a href="<?= URL::base_uri(); ?>targets/probes/<?= $data['MAC'] ?>"><i class="icon-trash"></i>Probing list</a>
                 </tr>
                 </tr>
				 <? endforeach; ?>			
                </tbody>
            </table>
			
        <? else: ?>
            <p><b>No targets found</b></p>
        <? endif; ?>
		
    </div>
    </div>
</div>

