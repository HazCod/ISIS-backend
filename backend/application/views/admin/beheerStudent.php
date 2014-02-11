<div class="row">

    <div class="pull-right">
        <p><a href="https://536729.webontwerp.khleuven.be/project/home/logout">Logout</a>&nbsp;&nbsp;&nbsp;Beheerder: <b><?= $this->user->voornaam . ' ' . $this->user->achternaam ?></b>.</p>
    </div>

    <div class="span12">
        <h3>Beheer studenten</h3>

        <? if ($this->students): ?>
            <table class="table table-striped">

                <thead>
                <tr>
                    <? foreach ($this->students[0] as $titel => $data): ?>
                        <th><?= $titel; ?></th>
                    <? endforeach; ?>
                </tr>
                </thead>

                <tbody>
                <? foreach ($this->students as $nr => $student): ?>
                    <tr>
                        <td><?= $student['Login']; ?></td>
                        <td><?= $student['Naam']; ?></td>
                        <td><? $resp = ($student['Aantal boekingen'] == 0) ?  '0' : $student['Aantal boekingen']; echo $resp; ?> boekingen</td>
                        <td>
                        <a href="https://536729.webontwerp.khleuven.be/project/beheerder/passReset/<?=$student['Login']; ?>"><i class="icon-refresh"></i>Reset wachtwoord</a>&nbsp;&nbsp;
                        <a href="https://536729.webontwerp.khleuven.be/project/beheerder/editStudent/<?= $student['Login']; ?>"><i class="icon-edit"></i>Pas student aan</a>
                        <a href="https://536729.webontwerp.khleuven.be/project/beheerder/verwijderStudent/<?= $student['Login']; ?>"><i class="icon-trash"></i>Verwijder student</a>
                        </td>
                    </tr>
                <? endforeach; ?>
                </tbody>

            </table>
        <? else: ?>
            <p><b>Geen studenten gevonden.</b></p>
        <? endif; ?>

        <div class="form-actions">
            <button type="submit" onclick="location.href='https://536729.webontwerp.khleuven.be/project/beheerder/addStudent'" class="btn btn-primary">Voeg student toe</button>
        </div>

    </div>
</div>