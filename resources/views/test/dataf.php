<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Data Input</h1>
<br /><br />

<form action="<?php echo URL?>demo/save" method="post" enctype="multipart/form-data">
  First Name:<br>
  <input type="text" name="name" value="<?php echo old($inputs,'name');?>"> <br>
    <?php if(isset($errors['name'])):?>
    <span class="text-danger"><?php echo $errors['name'][0]; ?></span>
    <?php endif;?> <br />
  Last name:<br>
  <input type="text" name="firstname" value="<?php echo old($inputs,'firstname');?>"> <br>
    <?php if(isset($errors['firstname'])):?>
        <span class="text-danger"><?php echo $errors['firstname'][0]; ?></span>
    <?php endif;?>       <br />
  Street:<br>
  <input type="text" name="street" value="<?php echo old($inputs,'street');?>"> <br>
    <?php if(isset($errors['street'])):?>
        <span class="text-danger"><?php echo $errors['street'][0]; ?></span>
    <?php endif;?>       <br />
  Zip Code:<br>
  <input type="text" name="zip_code" value="<?php echo old($inputs,'zip_code');?>"> <br>
    <?php if(isset($errors['zip_code'])):?>
    <span class="text-danger"><?php echo $errors['zip_code'][0]; ?></span>
    <?php endif;?>       <br />
  City:<br>
  <input type="text" name="city" value="<?php echo old($inputs,'city');?>"> <br>
    <?php if(isset($errors['city'])):?>
    <span class="text-danger"><?php echo $errors['city'][0]; ?></span>
    <?php endif;?>       <br />


  <input type="submit" value="Submit">
</form>
    
</body>
</html>