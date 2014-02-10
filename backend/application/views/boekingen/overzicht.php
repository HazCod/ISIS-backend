<table class="table table-striped">
    <tr>
        <th></th>
        <th>OOD</th>
        <th>reeks</th>
        <th><?php if ($_SESSION['rol']=='student'):?>lector<?php else:?>student<?php endif?></th>
        <th>opmerkingen</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($this->boekingen as $boeking):?>
        <tr>
            <td><?php echo $boeking->moment?></td>
            <td><?php echo $boeking->naam ?></td>
            <td><?php echo $boeking->reeks?></td>
            <td><?php if ($_SESSION['rol']=="student"){echo $boeking->lector;} else{echo $boeking->student;} ?></td>
            <td><?php echo $boeking->opmerkingen?></td>
            <?php if ($_SESSION['rol']=='student'):?>
                <td><a href="student/verwijderBoeking/<?php echo $boeking->boekingsnr ?>">verwijder</a> </td>
                <td><a href="student/bewerkboeking/<?php echo $boeking->boekingsnr ?>">bewerk</a> </td>
            <?php else: ?>
                <td><a href="lector/bewerkBoeking/<?php echo $boeking->boekingsnr ?>">bewerk</a> </td>
            <?php endif?>
        </tr>
    <?php endforeach ?>
</table>
<?php if ($_SESSION['rol']=='student'):?>
<a class="btn" href="student/addBoeking"><i class="icon-gift"></i>voeg toe </a>
<?php endif ?>