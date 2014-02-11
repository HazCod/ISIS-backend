<div class="row">

    <div class="pull-right">
        <p><a href="https://536729.webontwerp.khleuven.be/project/home/logout">Logout</a>&nbsp;&nbsp;&nbsp;Beheerder: <b><?= $this->user->voornaam . ' ' . $this->user->achternaam ?></b>.</p>
    </div>

    <div class="span12">
        <h3>Beheer lectoren</h3>

        <? if ($this->lectoren): ?>
            <table class="table table-striped">

                <thead>
                <tr>
                    <? foreach ($this->lectoren[0] as $titel => $data): ?>
                        <th><?= $titel; ?></th>
                    <? endforeach; ?>
                </tr>
                </thead>

                <tbody>
                <? foreach ($this->lectoren as $nr => $lector): ?>
                    <tr>
                        <td><?= $lector['Naam']; ?></td>
                        <td><? $resp = ($lector['Aantal boekingen'] == 0) ?  '0' : $lector['Aantal boekingen']; echo $resp; ?> boekingen</td>
                        <td><?= $lector['Studieadviseur']; ?></td>
                        <td><?= $lector['Lokaal']; ?></td>
                        <td>
                        <?php if($lector['Studieadviseur'] == 'Ja') { ?>
                            <a href="https://536729.webontwerp.khleuven.be/project/beheerder/maakLector/<?=$lector['Acties']; ?>"><i class="icon-ok-circle"></i> Geen studieadviseur</a>
                        <?php } else { ?>
                            <a href="https://536729.webontwerp.khleuven.be/project/beheerder/maakStudieadviseur/<?=$lector['Acties']; ?>"><i class="icon-remove-circle"></i> Maak studieadviseur</a>
                        <?php }  ?>
                            <a href="https://536729.webontwerp.khleuven.be/project/beheerder/passReset/<?=$lector['Acties']; ?>"><i class="icon-refresh"></i>Reset wachtwoord</a>&nbsp;&nbsp;
                            <a href="https://536729.webontwerp.khleuven.be/project/beheerder/editlector/<?= $lector['Acties']; ?>"><i class="icon-edit"></i>Pas lector aan</a>
                            <a href="https://536729.webontwerp.khleuven.be/project/beheerder/verwijderLector/<?= $lector['Acties']; ?>"><i class="icon-trash"></i>Verwijder lector</a>
                        </td>
                    </tr>
                <? endforeach; ?>
                </tbody>

            </table>
        <? else: ?>
            <p><b>Geen lectoren gevonden.</b></p>
        <? endif; ?>

        <div class="form-actions">
            <button type="submit" onclick="location.href='https://536729.webontwerp.khleuven.be/project/beheerder/addlector'" class="btn btn-primary">Voeg lector toe</button>
        </div>

    </div>
</div>