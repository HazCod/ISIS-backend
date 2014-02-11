<div class="row">
    <div class="span12">
        <h3>Login</h3>

        <form method="post" action="<?= URL::base_uri(); ?>/home/login">

            <div class="control-group <?= $this->form->getFieldStatus('username'); ?>">
                <label for="username">Username</label>
                <input id="username" name="username" type="text" value="<? if ($this->formdata) echo $this->formdata->username; ?>"/>
                <span class="help-inline"><?= $this->form->getFieldMessage('username'); ?></span>
            </div>

            <div class="control-group <?= $this->form->getFieldStatus('password'); ?>">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" value="<? if ($this->formdata) echo $this->formdata->password; ?>"/>
                <span class="help-inline"><?= $this->form->getFieldMessage('password'); ?></span>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Login</button>
                <button type="button" class="btn">Cancel</button>
            </div>
        </form>

    </div>
</div>
