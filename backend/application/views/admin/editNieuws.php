<div class="row">

    <div class="pull-right">
        <p><a href="https://536729.webontwerp.khleuven.be/project/home/logout">Logout</a>&nbsp;&nbsp;&nbsp;Beheerder: <b><?= $this->user->voornaam . ' ' . $this->user->achternaam ?></b>.</p>
    </div>

    <div class="span12">
        <h3>Edit Nieuws</h3>

        <form action="" method="post" class="form-horizontal">

            <div class="control-group <?php echo $this->form->getFieldStatus('titel'); ?>">
                <label class="control-label" for="titel">Titel</label>
                <div class="controls">
                    <input id="titel" name="titel" type="text" value="<? echo $this->nieuws->newstitle; ?>" />
                    <span class="help-inline"><?php echo $this->form->getFieldMessage('titel'); ?></span>
                </div>
            </div>

            <div class="control-group <?php echo $this->form->getFieldStatus('tekst'); ?>">
                <label class="control-label" for="tekst">Tekst</label>
                <div class="controls">
                    <input id="tekst" name="tekst" type="text" value="<? echo $this->nieuws->newstext; ?>" />
                    <span class="help-inline"><?php echo $this->form->getFieldMessage('tekst'); ?></span>
                </div>
            </div>

            <div class="control-group <?php echo $this->form->getFieldStatus('date'); ?>">
                <label class="control-label" for="date">Datum</label>
                <div class="controls">
                    <input id="date" name="date" type="text"  value="<? echo $this->nieuws->newsdate; ?>" />
                    <span class="help-inline"><?php echo $this->form->getFieldMessage('date'); ?></span>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Pas vak aan</button>
            </div>

        </form>
    </div>
</div>