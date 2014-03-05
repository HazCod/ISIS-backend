<?
    $parts = explode("|", $this->info);
    $timestamp = $parts[0];
    $data = $parts[1];
    $protocols = explode(";", $data);
?>
<br><br><br>
<div class="bs-docs-section">
        <div class="row">
		<? $this->renderPartial('flashmessage'); ?>
        </div>
<div class="row">
    <div class="span12">
        <h2>Device info for <?= $this->device; ?></h2>
        <p>Timestamp: <?= $timestamp; ?></p>
		<? if ($this->info): ?>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Protocol</th>
                    <th>Open port</th>
                </tr>
                </thead>

                <tbody>
                    <? foreach ($protocols as $proto): ?>
                        <? $protocol = explode("/", $proto)[0];
                           $ports = explode("/", $proto)[1]; ?>
                           <? foreach (explode(",", $ports) as $port): ?>
                            <td><?= $protocol; ?></td>  
                            <td><?= $port; ?></td>
                    <? endforeach; ?>    
                 <td>   
                 </tr>
                 <? endforeach; ?>  
                </tbody>
            </table>
			
        <? else: ?>
            <p><b>No information available for device <?= $this->device; ?>.</b></p>
        <? endif; ?>
		
    </div>
    </div>
</div>

