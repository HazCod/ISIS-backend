<div class="row">

    <div class="pull-right">
        <p><a href="https://536729.webontwerp.khleuven.be/project/home/logout">Logout</a>&nbsp;&nbsp;&nbsp;Beheerder: <b><?= $this->user->voornaam . ' ' . $this->user->achternaam ?></b>.</p>
    </div>

    <div class="span12">
        <h3>Beheer nieuwsitems</h3>

        <? if ($this->nieuwsitems): ?>
            <table class="table table-striped">

                <thead>
                <tr>
                    <? foreach ($this->nieuwsitems[0] as $titel => $data): ?>
                        <th><?= $titel; ?></th>
                    <? endforeach; ?>
                </tr>
                </thead>

                <tbody>
                <? foreach ($this->nieuwsitems as $nieuws): ?>
                    <tr>
                        <td><?= $nieuws['Titel']; ?></td>
                        <td><?= $nieuws['Tekst']; ?></td>
                        <td><?= $nieuws['Datum']; ?></td>
                        <td>
                            <a href="https://536729.webontwerp.khleuven.be/project/beheerder/editNieuws/<?=$nieuws['Acties']; ?>"><i class="icon-edit"></i>Pas nieuwsitem aan</a>&nbsp;&nbsp;
                            <a href="https://536729.webontwerp.khleuven.be/project/beheerder/verwijderNieuws/<?= $nieuws['Acties']; ?>"><i class="icon-trash"></i>Verwijder nieuws</a>
                        </td>
                    </tr>
                <? endforeach; ?>
                </tbody>

            </table>
        <? else: ?>
            <p><b>Geen nieuws gevonden.</b></p>
        <? endif; ?>

        <div class="form-actions">
            <button type="submit" onclick="location.href='https://536729.webontwerp.khleuven.be/project/beheerder/addNieuws'" class="btn btn-primary">Voeg nieuws toe</button>
        </div>

    </div>
</div>