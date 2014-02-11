<div class="row">

    <div class="pull-right">
        <p><a href="https://536729.webontwerp.khleuven.be/project/home/logout">Logout</a>&nbsp;&nbsp;&nbsp;Beheerder: <b><?= $this->user->voornaam . ' ' . $this->user->achternaam ?></b>.</p>
    </div>

    <div class="span12">
        <h3>Nieuwe Student</h3>

        <form class="form-horizontal" method="post" action="">


            <div class="control-group <?php echo $this->form->getFieldStatus('vak'); ?>">
                <label class="control-label" for="vak">Vak</label>
                <div class="controls">
                    <input id="vak" name="vak" type="text" value="" />
                    <span class="help-inline"><?php echo $this->form->getFieldMessage('vak'); ?></span>
                </div>
            </div>

            <div class="control-group <?php echo $this->form->getFieldStatus('verantwoordelijke'); ?>">
                <label class="control-label" for="verantwoordelijke">Verantwoordelijke</label>
                <div class="controls">
                    <input id="verantwoordelijke" name="verantwoordelijke" type="text" value="" />
                    <span class="help-inline"><?php echo $this->form->getFieldMessage('verantwoordelijke'); ?></span>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Maak vak aan</button>
            </div>

        </form>
    </div>
</div>