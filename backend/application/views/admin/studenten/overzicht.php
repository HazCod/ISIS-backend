<table class="table table-striped">
    <tr>
        <th>naam</th>
        <th>aantal boekingen</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($this->studenten as $student): ?>
        <tr>
            <td><?php echo $student->naam ?> </td>
            <td> <?php echo $student->count ?></td>
            <td><a href="<?php echo URL::base_uri()?>admin/verwijderstudent/<?php echo $student->login?>" >verwijder</a></td>
            <td><a href="<?php echo URL::base_uri()?>admin/resetpassword/<?php echo $student->login?>">reset wachtwoord</a> </td>
            <td><a href="<?php echo URL::base_uri()?>admin/bewerkstudent/<?php echo $student->login?>">bewerk student</a> </td>
        </tr>
    <?php endforeach ?>
</table>

<a class="btn" href="voegstudenttoe"><i class="icon-gift"></i>voeg toe </a>
