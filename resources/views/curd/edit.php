<!DOCTYPE html>
<html>
    <body>
        <h2>Update data</h2>
        <a href="<?php echo route('curd') ;?>">All Stusents</a> | <a href="<?php echo route('curd/add');?>">Add New Student</a>
        <br/><br/>

        <form action="<?php echo route('curd/update/'. $student->id);?>" method="POST" enctype="multipart/form-data">
            Name:<br>
            <input type="text" name="name" value="<?php echo $student->name; ?>"> <br>
            <?php if(isset($errors['name'])):?>
                <span class="text-danger"><?php echo $errors['name'][0]; ?></span>
            <?php endif;?> <br/>

            Roll No:<br>
            <input type="text" name="roll" value="<?php echo $student->roll; ?>"> <br>
            <?php if(isset($errors['roll'])):?>
                <span class="text-danger"><?php echo $errors['roll'][0]; ?></span>
            <?php endif;?> <br/>
            
            Class:<br>
            <input type="text" name="class" value="<?php echo $student->class; ?>"> <br><br>
            <?php if(isset($errors['class'])):?>
                <span class="text-danger"><?php echo $errors['class'][0]; ?></span>
            <?php endif;?> <br/>

            <input type="submit" value="Update">
        </form>
    </body>
</html>
