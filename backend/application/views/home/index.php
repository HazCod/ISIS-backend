<br><br><br>
<div class="bs-docs-section">
        <div class="row">
		<? $this->renderPartial('flashmessage'); ?>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="well">
              <form class="bs-example form-horizontal" method="post" action="<?= URL::base_uri(); ?>home/login">
                <fieldset>
                  <legend>Login</legend>
                  <div class="form-group <?= $this->form->getFieldStatus('username'); ?>">
                    <label for="inputEmail" class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="username" id="username" placeholder="Login" value="<? if (isset($this->formdata)) echo $this->formdata->username; ?>">
		      <? if ($this->formdata): ?>
		      <span class="help-inline"><?= $this->form->getFieldMessage('username'); ?></span>
		      <? endif; ?>
                    </div>
                  </div>
                  <div class="form-group <?= $this->form->getFieldStatus('password'); ?>">
                    <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                      <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="<? if (isset($this->formdata)) echo $this->formdata->password; ?>">
		      <? if ($this->formdata): ?>
		      <span class="help-inline"><?= $this->form->getFieldMessage('username'); ?></span>
		      <? endif; ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                      <button type="submit" class="btn btn-primary">Login</button> 
                      <button type="reset" class="btn btn-default">Cancel</button>
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>

        </div>
      </div>
