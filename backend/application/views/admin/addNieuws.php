<div class="row">

    <div class="pull-right">
        <p><a href="https://536729.webontwerp.khleuven.be/project/home/logout">Logout</a>&nbsp;&nbsp;&nbsp;Beheerder: <b><?= $this->user->voornaam . ' ' . $this->user->achternaam ?></b>.</p>
    </div>

    <div class="span12">
        <h3>Nieuw nieuws</h3>

        <form class="form-horizontal" method="post" action="">


            <div class="control-group <?php echo $this->form->getFieldStatus('titel'); ?>">
                <label class="control-label" for="titel">Titel</label>
                <div class="controls">
                    <input id="titel" name="titel" type="text" value="" />
                    <span class="help-inline"><?php echo $this->form->getFieldMessage('titel'); ?></span>
                </div>
            </div>

            <div class="control-group <?php echo $this->form->getFieldStatus('tekst'); ?>">
                <label class="control-label" for="tekst">Tekst</label>
                <div class="controls">
                    <input id="tekst" name="tekst" type="text" value="" />
                    <span class="help-inline"><?php echo $this->form->getFieldMessage('tekst'); ?></span>
                </div>
            </div>

            <div class="control-group <?php echo $this->form->getFieldStatus('date'); ?>">
                <label class="control-label" for="date">Datum</label>
                <div class="controls">
                    <input id="date" name="date" placeholder="yyyy-mm-dd" type="text"  value="" />
                    <span class="help-inline"><?php echo $this->form->getFieldMessage('date'); ?></span>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Maak nieuwsitem aan</button>
            </div>

        </form>
    </div>
</div>