<br><br><br>
<div class="bs-docs-section">
        <div class="row">
		<? $this->renderPartial('flashmessage'); ?>
        </div>
<div class="row">
    <div class="span12">
        <h2>Unit <b><?= $this->unit; ?></b>
		<? if ($this->assignments[0]['assignment'] == "rogue" AND $this->assignments[0]['status'] == "busy"): ?>		
		is going rogue 
		<? endif; ?>
		</h2>
		<? if ($this->assignments[0]['assignment'] == "rogue" AND $this->assignments[0]['status'] == "busy"): ?>
		<h5>
		<a href="<?= URL::base_uri(); ?>admin/stopRogue/<?= $this->unit; ?>"><i class="icon-trash"></i>Stop Rogue</a>&nbsp&nbsp&nbsp 
		</h5>
		<? endif; ?>
		
        <p><strong>Last seen:</strong>&nbsp;<?= $this->lastseen; ?></p>
        
		<h3>Found WiFi connections</h3>
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
				 <a href="<?= URL::base_uri(); ?>admin/connectWifiUnit/<?= $this->unit; ?>/<?= $this->wifis[$nr]['wifi_network']; ?>"><i class="icon-trash"></i>Connect</a>&nbsp;&nbsp;&nbsp;
				 <? if ($data['encryption'] != "open"): ?>
				 <a href="<?= URL::base_uri(); ?>admin/crackWifiUnit/<?= $this->unit; ?>/<?= $this->wifis[$nr]['wifi_network']; ?>"><i class="icon-trash"></i>Crack</a>&nbsp;&nbsp;&nbsp;
				 <? endif; ?>
				 <a href="<?= URL::base_uri(); ?>admin/detailWifi/<?= $this->unit; ?>/<?= $this->wifis[$nr]['wifi_network']; ?>"><i class="icon-trash"></i>Details</a>&nbsp;&nbsp;&nbsp;
				 <? if ($data['encryption'] == "open"): ?>
                 <a href="<?= URL::base_uri(); ?>admin/rogueAP/<?= $this->unit; ?>/<?= $this->wifis[$nr]['wifi_network']; ?>"><i class="icon-trash"></i>Go Rogue</a>&nbsp;&nbsp;&nbsp;
                 <? endif; ?>
                 <? if (($data['encryption'] == "open") or ($data['wifi_key'])): ?>
                 <a href="<?= URL::base_uri(); ?>admin/nmap/<?= $this->wifis[$nr]['wifi_network']; ?>" title="Note: Nmap can take long time to complete."><i class="icon-trash"></i>Nmap</a></td> 
                 <? endif; ?>              
				 </tr>
				 <? endforeach; ?>
				
                </tbody>
            </table>
			
        <? else: ?>
            <p><b>No wireless networks found yet</b></p>
        <? endif; ?>
		
    </div>
    </div>
	
	
	<div class="row">
    <div class="span12">
		<h3>Last 10 assignments</h3>
		
		<? if ($this->assignments): ?>

            <table class="table table-striped">

                <thead>
                <tr>
                    <? foreach ($this->assignments[0] as $titel2 => $data2): ?>
                        <th><?= ucfirst($titel2); ?></th>
                    <? endforeach; ?>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <? foreach ($this->assignments as $nr => $data2): ?>
				<tr>
					<? foreach ($data2 as $nrunit2 => $unit2): ?>
					    <? if ($unit2 == 'executed'): ?>
                        <td style="color:green;">
                        <? elseif ($unit2 == 'new'): ?>
                        <td style="color:orange;">
                        <? elseif ($unit2 == 'error'): ?>
                        <td style="color:red;">
                        <? else: ?><td><? endif; ?>
                        <?= $unit2; ?></td>
						
                 <? endforeach; ?>
				 <td>
				 <a href="<?= URL::base_uri(); ?>admin/removeAssignment/<?= $this->unit; ?>/<?= $this->assignments[$nr]['assignments_id']; ?>; ?>"><i class="icon-trash"></i>Remove Assignment</a>&nbsp&nbsp&nbsp 
				</td>													
				</tr>
				 <? endforeach; ?>
				
                </tbody>
            </table>
			
        <? else: ?>
            <p><b>No assignments yet</b></p>
        <? endif; ?>
		
	</div>
	</div>
	
	<div class="row">
    <div class="span12">
		<h3>Last Snap</h3>
		<img src="../../../img/Afbeeldingen/image.jpg" alt="test" height="400" width="500">
	</div>
	</div>

</div>

