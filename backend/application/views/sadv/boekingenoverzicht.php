<table class="table table-striped">
    <tr>
        <th>student</th>
        <th>lector</th>
        <th>moment</th>
        <th>reeks</th>
    </tr>
    <?php foreach ($this->boekingen as $boeking):?>
        <tr>
            <td><?php echo $boeking->student?></td>
            <td><?php echo $boeking->lector?></td>
            <td><?php echo $boeking->moment?></td>
            <td><?php echo $boeking->reeks?></td>
        </tr>
    <?php endforeach?>
</table>