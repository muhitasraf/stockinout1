<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>All Item List</h2>
<a href="<?php echo route('ecommerce/add'); ?>">Insert Item</a> || <a href="<?php echo route('ecommerce/stockin'); ?>">Stock In</a>|| <a href="<?php echo route('ecommerce/stockout'); ?>">Stock Out</a>
<br/><br/>

<?php
    if(!empty($err)){
        echo $err."<br/>";
    }
    if (empty($all_item))
        echo "There is no data";
    else {
        //print_r($all_item);
        ?>
        <table class="table table-striped table-sm">
            <tr>
                <th>item_id</th>
                <th>item_name</th>
                <th>item_price</th>
                <th>brand_id</th>
                <th>category_id</th>
                <th>color_id</th>
                <th>size_id</th>
            </tr>
            <?php foreach ($all_item as $row) { ?>
                <tr>
                    <td><?php echo $row['item_id']; ?></td>
                    <td><?php echo $row['item_name']; ?></td>
                    <td><?php echo $row['item_price']; ?></td>
                    <td><?php echo $row['brand_id']; ?></td>
                    <td><?php echo $row['category_id']; ?></td>
                    <td><?php echo $row['color_id']; ?></td>
                    <td><?php echo $row['size_id']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>


</body>
</html>
