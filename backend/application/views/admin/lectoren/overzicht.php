<table class="table table-striped">
    <tr>
        <th>naam</th>
        <th>aantal boekingen</th>
        <th>is studieadviseur</th>
        <th>lokaal</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($this->lectoren as $lector): ?>
    <tr>
        <td><?php echo $lector->naam ?> </td>
        <td><?php echo $lector->count ?></td>
        <td> <?php if ($lector->rol=='studieadviseur'):?>ja <?php else:?> neen<?php endif?></td>
        <td><?php echo $lector->lokaal?></td>
        <td><a href="veranderstudieadviseur/<?php echo $lector->login?>"> <?php if ($lector->rol=='studieadviseur'):?> geen studieadviseur meer<?php else:?> maak studieadviseur<?php endif?></a></td>
        <td><a href="resetpassword/<?php echo $lector->login?>">reset paswoord</a></td>
        <td><a href="bewerklector/<?php echo $lector->login?>">bewerk lector</a> </td>
    </tr>
    <?php endforeach ?>
</table>
<a class="btn" href="voegLectorToe"><i class="icon-gift"></i>voeg toe </a>
