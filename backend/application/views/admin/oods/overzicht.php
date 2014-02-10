<table class="table table-striped">
    <tr>
        <th>naam</th>
        <th>aantal boekingen</th>
        <th></th>
    </tr>
    <?php foreach ($this->oods as $ood) :?>
    <tr>
        <td><?php echo $ood->naam?></td>
        <td><?php echo $ood->aantalboekingen?></td>
        <td><a href="bewerkood/<?php echo $ood->oodnr?>">bewerk ood</a> </td>
    </tr>
    <?php endforeach?>
</table>
<a class="btn" href="voegOodToe"><i class="icon-gift"></i>voeg toe </a>
