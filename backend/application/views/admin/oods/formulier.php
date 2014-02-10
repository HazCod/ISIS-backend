
<form class="form-actions" method="post" action="">

    <div class="control-group <?php echo $this->form->getFieldStatus("oodnr")?>">
        <label class="control-label" for="oodnr">oodnr</label>

        <div class="controls">
            <input type="text" name="oodnr" id="oodnr" value="<?php echo $this->ood->oodnr?>" <?php if ($this->bewerk):?>readonly="readonly" <?php endif?> >
            <span class="help-inline"><?php echo $this->form->getFieldMessage("oodnr")?></span>
        </div>
    </div>


    <div class="control-group <?php echo $this->form->getFieldStatus("naam")?>">
        <label class="control-label" for='naam'>naam</label>

        <div class="controls">
            <input type="text" name="naam" id="naam" value="<?php echo $this->ood->naam?>">
            <span class="help-inline"><?php echo $this->form->getFieldMessage("naam")?></span>
        </div>
    </div>

    <div class="control-group <?php echo $this->form->getFieldStatus("studiepunten")?>">
        <label class="control-label" for="studiepunten">studiepunten</label>

        <div class="controls">
            <input type="text" name="studiepunten" id="studiepunten" value="<?php echo $this->ood->studiepunten?>">
            <span class="help-inline"><?php echo $this->form->getFieldMessage("studiepunten")?></span>
        </div>
    </div>


    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">Save</button>
            or <a href="<?php echo URL::base_uri(); ?>admin">cancel</a>
        </div>
    </div>

</form>