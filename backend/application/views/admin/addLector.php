<div class="row">

    <div class="pull-right">
        <p><a href="https://536729.webontwerp.khleuven.be/project/home/logout">Logout</a>&nbsp;&nbsp;&nbsp;Beheerder: <b><?= $this->user->voornaam . ' ' . $this->user->achternaam ?></b>.</p>
    </div>

    <div class="span12">
        <h3>Nieuwe Lector</h3>

        <form class="form-horizontal" method="post" action="">

            <div class="control-group <?php echo $this->form->getFieldStatus('login'); ?>">
                <label class="control-label" for="login">Login</label>
                <div class="controls">
                    <input id="login" name="login" type="text" value="" />
                    <span class="help-inline"><?php echo $this->form->getFieldMessage('login'); ?></span>
                </div>
            </div>

            <div class="control-group <?php echo $this->form->getFieldStatus('voornaam'); ?>">
                <label class="control-label" for="voornaam">Voornaam</label>
                <div class="controls">
                    <input id="voornaam" name="voornaam" type="text" value="" />
                    <span class="help-inline"><?php echo $this->form->getFieldMessage('voornaam'); ?></span>
                </div>
            </div>

            <div class="control-group <?php echo $this->form->getFieldStatus('achternaam'); ?>">
                <label class="control-label" for="achternaam">Achternaam</label>
                <div class="controls">
                    <input id="achternaam" name="achternaam" type="text" value="" />
                    <span class="help-inline"><?php echo $this->form->getFieldMessage('achternaam'); ?></span>
                </div>
            </div>

            <div class="control-group <?php echo $this->form->getFieldStatus('email'); ?>">
                <label class="control-label" for="email">Email</label>
                <div class="controls">
                    <input id="email" name="email" type="text" value="" />
                    <span class="help-inline"><?php echo $this->form->getFieldMessage('email'); ?></span>
                </div>
            </div>

            <div class="control-group <?php echo $this->form->getFieldStatus('lokaal'); ?>">
                <label class="control-label" for="lokaal">Lokaal</label>
                <div class="controls">
                    <input id="lokaal" name="lokaal" type="text" value="" />
                    <span class="help-inline"><?php echo $this->form->getFieldMessage('lokaal'); ?></span>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Maak lector aan</button>
            </div>

        </form>
    </div>
</div>