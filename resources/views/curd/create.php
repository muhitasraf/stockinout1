<h2>Add New Student</h2>
<a href="<?php echo URL?>curd">Show All Student</a>
<br /><br />

<form action="<?php echo URL?>curd/save" method="post" enctype="multipart/form-data">
    Name:<br>
    <input type="text" name="name" value="<?php echo old($inputs,'name');?>"> <br>
    <?php if(isset($errors['name'])):?>
        <span class="text-danger"><?php echo $errors['name'][0]; ?></span>
    <?php endif;?> <br />

    Roll No:<br>
    <input type="text" name="roll" value="<?php echo old($inputs,'roll');?>"> <br>
    <?php if(isset($errors['roll'])):?>
        <span class="text-danger"><?php echo $errors['roll'][0]; ?></span>
    <?php endif;?> <br />
    
    CLass:<br>
    <input type="text" name="class" value="<?php echo old($inputs,'class');?>"> <br>
    <?php if(isset($errors['class'])):?>
        <span class="text-danger"><?php echo $errors['class'][0]; ?></span>
    <?php endif;?> <br />

    <input type="submit" value="Submit">
</form>