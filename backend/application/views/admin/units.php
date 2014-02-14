<br><br><br>
<div class="bs-docs-section">
        <div class="row">
		<? $this->renderPartial('flashmessage'); ?>
        </div>
<div class="row">
    <div class="span12">
        <h2>Unit <b><?= $this->unit; ?></b></h2>	
		<h3>Found wifi connections: </h3>
		
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
				 <a href="<?= URL::base_uri(); ?>admin/connectWifiUnit/<?= $this->unit; ?>/<?= $this->wifis[$nr]['wifi_network']; ?>"><i class="icon-trash"></i>Connect</a>&nbsp&nbsp&nbsp 
				 <a href="<?= URL::base_uri(); ?>admin/crackWifiUnit/<?= $this->unit; ?>/<?= $this->wifis[$nr]['wifi_network']; ?>"><i class="icon-trash"></i>Crack&nbsp&nbsp&nbsp </a>
				 <a href="<?= URL::base_uri(); ?>admin/detailWifi/<?= $this->unit; ?>/<?= $this->wifis[$nr]['wifi_network']; ?>"><i class="icon-trash"></i>Details</a></td>
				 </tr>
				 <? endforeach; ?>
				
                </tbody>
            </table>
			
        <? else: ?>
            <p><b>No wireless networks found yet</b></p>
        <? endif; ?>
		
    </div>
	
    </div>

</div>

