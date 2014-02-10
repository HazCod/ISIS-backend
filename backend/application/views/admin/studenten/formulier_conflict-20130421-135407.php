<form class="form-actions" method="post" action="">
    <div class="control-group <?php echo $this->form->getFieldStatus('voornaam');?>">
        <label class="control-label" for="voornaam">voornaam</label>
        <div class="controls">
            <input id="voornaam" type="text" name="voornaam" value="<?php echo $this->student->voornaam?>">
            <span class="help-inline"><?php echo $this->form->getFieldMessage('voornaam')?></span>
        </div>
    </div>

    <div class="control-group <?php echo $this->form->getFieldStatus('naam');?>">
        <label class="control-label" for="voornaam"> naam</label>
        <div class="controls">
            <input id="naam" type="text" name="naam" value="<?php echo $this->student->naam ?>">
            <span class="help-inline"><?php echo $this->form->getFieldMessage('naam')?></span>
        </div>
    </div>

    <div class="control-group <?php echo $this->form->getFieldStatus('login')?>">
        <label class="control-label" for="login">login</label>
        <div class="controls">
            <input id="login" name="login" type="text" value="<?php echo $this->student->login?>" <?php if ($this->bewerk):?> readonly="readonly" <?php endif?>>
            <span class="help-inline"><?php echo $this->form->getFieldMessage('login')?></span>
        </div>
    </div>

    <div class="control-group <?php echo $this->form->getFieldStatus('email') ?>">
        <label class="control-label" for="email">email-adres</label>
        <div class="controls">
            <input id="email" name="email" type="text" value="<?php echo $this->student->email?>">
            <span class="help-inline"><?php echo $this->form->getFieldMessage('email')?></span>
        </div>
    </div>

    <div class="control-group <?php echo $this->form->getFieldStatus('reeks')?>">
        <label class="control-label" for="reeks">reeks</label>
        <div class="controls">
            <input id="reeks" name="reeks" type="text" value="<?php echo $this->student->reeks?>">
            <span class="help-inline"><?php echo $this->form->getFieldMessage('reeks')?></span>
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <button type="voeg student toe" class="btn btn-primary">Save</button> or <a href="<?php echo URL::base_uri(); ?>admin">cancel</a>
        </div>
    </div>

</form>
