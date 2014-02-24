<br><br><br>
<div class="bs-docs-section">
        <div class="row">
		<? $this->renderPartial('flashmessage'); ?>
        </div>
<div class="row">
    <div class="span12">
        <h2>Access Point <b><?= $this->ap; ?></b></h2>
        <p><strong>Manufacturer:</strong>&nbsp;<?= $this->manufac; ?></p>
        
		<h3>Wifi Networks active on this AP</h3>
		<? if ($this->wifis): ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <? foreach ($this->wifis[0] as $titel => $data): ?>
                        <th><?= ucfirst($titel); ?></th>
                    <? endforeach; ?>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <? foreach ($this->wifis as $nr => $data): ?>
				<tr>
					<? foreach ($data as $nrunit => $unit): ?>				
                        <td><?= $unit; ?></td>
                    <? endforeach; ?>
				 <td>
                 <a href="<?= URL::base_uri(); ?>targets/kickall/<?= $this->ap; ?>"><i class="icon-trash"></i>Kick All</a>  
				 </tr>
				 <? endforeach; ?>			
                </tbody>
            </table>			
        <? else: ?>
            <p><b>No wireless networks were found active on this AP. (Error?)</b></p>
        <? endif; ?>		

        <h3>Devices connected to this AP</h3>
        <? if ($this->devices): ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <? foreach ($this->devices[0] as $titel => $data): ?>
                        <th><?= ucfirst($titel); ?></th>
                    <? endforeach; ?>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <? foreach ($this->devices as $nr => $data): ?>
                <tr>
                    <? foreach ($data as $nrunit => $unit): ?>                 
                        <td><?= $unit; ?></td>                  
                 <? endforeach; ?>
                 <td>
                 </tr>
                 <? endforeach; ?>      
                </tbody>
            </table>      
        <? else: ?>
            <p><b>No devices are connected to this AP (yet).</b></p>
        <? endif; ?>
    </div>
    </div>
</div>

