<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Stock Out</h2>
<a href="<?php echo route('ecommerce/add'); ?>">Insert Item</a> || <a href="<?php echo route('ecommerce/stockin'); ?>">Stock In</a>|| <a href="<?php echo route('ecommerce/stockout'); ?>">Stock Out</a>
<br/><br/>

    <form action="<?php echo URL?>ecommerce/updatestock" method="post" enctype="multipart/form-data">
        Item Name:<br>
        <select name="item_name" style="width:170px;">
            <option selected>Custom Select Menu</option>
            <?php foreach($all_item as $item){?>
                <option value="<?php echo $item['item_id'];?>"><?php echo $item['item_name'];?></option>
            <?php } ?>
        </select> <br>
        <?php if(isset($errors['class'])):?>
            <span class="text-danger"><?php echo $errors['class'][0]; ?></span>
        <?php endif;?> <br />
        
        Quantity :<br>
        <input type="text" name="item_name" value="<?php echo old($inputs,'item_name');?>"> <br>
        <?php if(isset($errors['item_name'])):?>
            <span class="text-danger"><?php echo $errors['item_name'][0]; ?></span>
        <?php endif;?> <br />

        <input type="submit" value="Submit">
    </form>

</body>
</html>
