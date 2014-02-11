<div class="row">

    <div class="pull-right">
        <p><a href="https://536729.webontwerp.khleuven.be/project/home/logout">Logout</a>&nbsp;&nbsp;&nbsp;Beheerder: <b><?= $this->user->voornaam . ' ' . $this->user->achternaam ?></b>.</p>
    </div>

    <div class="span12">
        <h3>Beheer vakken</h3>

        <? if ($this->vakken): ?>
            <table class="table table-striped">

                <thead>
                <tr>
                    <? foreach ($this->vakken[0] as $titel => $data): ?>
                        <th><?= $titel; ?></th>
                    <? endforeach; ?>
                </tr>
                </thead>

                <tbody>
                <? foreach ($this->vakken as $vak): ?>
                    <tr>
                        <td><?= $vak['Naam']; ?></td>
                        <td><?= $vak['Verantwoordelijke']; ?></td>
                        <td>
                            <a href="https://536729.webontwerp.khleuven.be/project/beheerder/editVak/<?=$vak['Naam']; ?>"><i class="icon-edit"></i>Pas vak aan</a>&nbsp;&nbsp;
                            <a href="https://536729.webontwerp.khleuven.be/project/beheerder/verwijderVak/<?= $vak['Naam']; ?>"><i class="icon-trash"></i>Verwijder vak</a>
                        </td>
                    </tr>
                <? endforeach; ?>
                </tbody>

            </table>
        <? else: ?>
            <p><b>Geen vakken gevonden.</b></p>
        <? endif; ?>

        <div class="form-actions">
            <button type="submit" onclick="location.href='https://536729.webontwerp.khleuven.be/project/beheerder/addVak'" class="btn btn-primary">Voeg vak toe</button>
        </div>

    </div>
</div>