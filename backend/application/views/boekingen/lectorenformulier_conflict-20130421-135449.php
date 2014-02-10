<p>u bent de boeking om <?php echo $this->boeking->moment?> aan het bewerken</p>

<form class="form form-actions" method="post" action="">

    <div class="control-group">
        <label class="control-label" for="uur">tijd</label>
        <div class="controls">
            <select id="uur" name="uur">
                <?php for ($i=13; $i<=15; $i++):?>
                    <option value="<?php echo $i;?>"><?php echo $i?></option>
                <?php endfor?>
            </select>

            <select id="minuten" name="minuten">
                <?php for ($i=0; $i<=50; $i+=10):?>
                    <option value="<?php echo $i;?>"><?php echo $i?></option>
                <?php endfor?>
            </select>
        </div>
    </div>

    <div class="control-group <?php $this->form->getFieldStatus['opmkerkingen']?>">
        <label class="control-label" for="opmerkingen">reden</label>
        <div class="controls">
            <textarea name="opmerkingen" id="opmerkingen"></textarea>
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">Save</button> or <a href="<?php echo URL::base_uri(); ?>lector">cancel</a>
        </div>
    </div>

</form>