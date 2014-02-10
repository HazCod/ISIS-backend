<form class="form-inline" method="post" action="">

        <select name="oodnr" id="oodnr">
            <?php foreach ($this->OODs as $OOD): ?>
            <option value="<?php echo $OOD->oodnr?>" <?php if ($OOD->oodnr==$this->oodnr):?> selected="selected" <?php endif?>><?php echo $OOD->naam?></option>
            <?php endforeach?>
        </select>



        <button class="btn btn-primary" type="submit">OK</button>

</form>

<?php if ($this->gekozen):?>
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
<?php endif?>