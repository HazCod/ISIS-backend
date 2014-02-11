<div class="row">

    <div class="pull-right">
        <p><a href="https://536729.webontwerp.khleuven.be/project/home/logout">Logout</a>&nbsp;&nbsp;&nbsp;Beheerder: <b><?= $this->user->voornaam . ' ' . $this->user->achternaam ?></b>.</p>
    </div>

    <div class="span12">
        <h3>Edit Vak</h3>

        <form action="" method="post" class="form-horizontal">

            <div class="control-group <?php echo $this->form->getFieldStatus('naam'); ?>">
                <label class="control-label" for="naam">Naam</label>
                <div class="controls">
                    <input id="naam" name="naam" type="text" value="<? echo $this->vak->naam; ?>" />
                    <span class="help-inline"><?php echo $this->form->getFieldMessage('naam'); ?></span>
                </div>
            </div>

            <div class="control-group <?php echo $this->form->getFieldStatus('verantwoordelijke'); ?>">
                <label class="control-label" for="verantwoordelijke">Verantwoordelijke</label>
                <div class="controls">
                    <input id="verantwoordelijke" name="verantwoordelijke" type="text" value="<? echo $this->vak->verantwoordelijke; ?>" />
                    <span class="help-inline"><?php echo $this->form->getFieldMessage('verantwoordelijke'); ?></span>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Pas vak aan</button>
            </div>

        </form>
    </div>
</div>