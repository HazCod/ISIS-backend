<form class="form-actions" method="post" action="">
    <div class="control-group <?php echo $this->form->getFieldStatus('voornaam');?>">
        <label class="control-label" for="voornaam">voornaam</label>
        <div class="controls">
            <input id="voornaam" type="text" name="voornaam" value="<?php echo $this->lector->voornaam?>">
            <span class="help-inline"><?php echo $this->form->getFieldMessage('voornaam')?></span>
        </div>
    </div>

    <div class="control-group <?php echo $this->form->getFieldStatus('naam');?>">
        <label class="control-label" for="voornaam"> naam</label>
        <div class="controls">
            <input id="naam" type="text" name="naam" value="<?php echo $this->lector->naam ?>">
            <span class="help-inline"><?php echo $this->form->getFieldMessage('naam')?></span>
        </div>
    </div>

    <div class="control-group <?php echo $this->form->getFieldStatus('login')?>">
        <label class="control-label" for="login">login</label>
        <div class="controls">
            <input id="login" name="login" type="text" value="<?php echo $this->lector->login?>" <?php if ($this->bewerk):?> readonly="readonly" <?php endif?>>
            <span class="help-inline"><?php echo $this->form->getFieldMessage('login')?></span>
        </div>
    </div>

    <div class="control-group <?php echo $this->form->getFieldStatus('email') ?>">
        <label class="control-label" for="email">email-adres</label>
        <div class="controls">
            <input id="email" name="email" type="text" value="<?php echo $this->lector->email?>">
            <span class="help-inline"><?php echo $this->form->getFieldMessage('email')?></span>
        </div>
    </div>

    <div class="control-group <?php echo $this->form->getFieldStatus('lokaal')?>">
        <label class="control-label" for="lokaal">lokaal</label>
        <div class="controls">
            <input id="lokaal" name="lokaal" type="text" value="<?php echo $this->lector->lokaal?>">
            <span class="help-inline"><?php echo $this->form->getFieldMessage('lokaal')?></span>
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">Save</button> or <a href="<?php echo URL::base_uri(); ?>admin">cancel</a>
        </div>
    </div>

</form>
