<!DOCTYPE html>
<html>
    <body>
        <h2>Single data</h2>
        <a href="<?php echo route('curd') ;?>">All Stusents</a> | <a href="<?php echo route('curd/add');?>">Add New Student</a>
        <br/><br/>
        <p>Name: <?php echo $student->name; ?></p> <br>
        <p>Roll No: <?php echo $student->roll; ?></p> <br>
        <p>Class: <?php echo $student->class; ?></p> <br>
    </body>
</html>
