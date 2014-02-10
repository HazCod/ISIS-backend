<table class="table table-striped">
    <tr>
        <th></th>
        <th>aantal boekingen</th>
        <th></th>
        <th></th>
    </tr>

    <?php foreach ($this->studenten as $student): ?>
        <tr>
            <td><?php echo $student->voornaam?> <?php echo $student->naam?></td>
            <td><?php echo $student->count ?></td>
            <td><a href="studieadviseur/boekvoorstudent/<?php echo $student->login?>">maak boeking</a> </td>
            <td><a href="studieadviseur/doealsstudent/<?php echo $student->login?>">doe als student</a> </td>
        </tr>
     <?php endforeach?>
</table>