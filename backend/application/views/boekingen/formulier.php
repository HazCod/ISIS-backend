<?php if ($this->bewerk):?>
    <p>je bent een boeking aan het bewerken op <?php echo $this->boeking->moment?></p>
<?php endif?>

<form class="form form-actions" method="post" action="">

    <div class="control-group <?php echo $this->form->getFieldStatus('lector')?>">
        <label class="control-label" for="lector">lector</label>
        <div class="controls">
            <select id= "lector" name="lector" <?php if ($this->bewerk):?> disabled="disabled" <?php endif?>>
                <?php foreach ($this->lectoren as $lector):?>
                    <option value="<?php echo $lector->login?>" <?php if (trim ($lector->login)==trim ($this->boeking->lector)): ?>selected <?php endif?>><?php echo $lector->naam?></option>
                <?php endforeach?>
            </select>
            <span class="help-inline"><?php echo $this->form->getFieldMessage('lector')?></span>
        </div>
    </div>

    <div class="control-group <?php echo $this->form->getFieldStatus('oodnr')?>">
        <label class="control-label" for="oodnr">OOD</label>
        <div class="controls">
            <select name="oodnr" id="oodnr" <?php if ($this->bewerk):?> disabled="disabled" <?php endif?>>
                <?php foreach ($this->OODs as $OOD):?>
                    <option value="<?php echo $OOD->oodnr?>" <?php if ($OOD->oodnr==$this->boeking->oodnr):?> selected<?php endif?>><?php echo $OOD->naam?></option>
                <?php endforeach?>
            </select>
            <span class="help-inline"><?php echo $this->form->getFieldMessage('oodnr')?></span>
        </div>
    </div>

    <div class="control-group <?php echo $this->form->getFieldStatus('reeks')?>">
        <label class="control-label" for="reeks">reeks</label>
        <div class="controls">
            <input type="text" name="reeks" id="reeks" value="<?php echo $this->boeking->reeks ?>">
            <span class="help-inline"><?php echo $this->form->getFieldMessage('reeks')?></span>
        </div>
    </div>

    <div class="control-group <?php echo $this->form->getFieldStatus('opmerkingen')?>">
        <label class="control-label" for="opmerkingen">opmerkingen</label>
        <div class="controls">
            <textarea cols="50" rows="10" name="opmerkingen" id="opmerkingen" ><?php echo $this->boeking->opmerkingen?></textarea>
            <span class="help-inline"><?php echo $this->form->getFieldMessage('opmerkingen')?></span>
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">Save</button> or <a href="<?php echo URL::base_uri(); ?>student">cancel</a>
        </div>
    </div>

</form>