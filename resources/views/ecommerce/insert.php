<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php ?>
    <h2>Add New Item</h2>
    <a href="<?php echo URL?>ecommerce">Show All Item</a> || <a href="<?php echo route('ecommerce/stockin'); ?>">Stock In</a>|| <a href="<?php echo route('ecommerce/stockout'); ?>">Stock Out</a>
    <br /><br />

    <form action="<?php echo URL?>ecommerce/save" method="post" enctype="multipart/form-data">
        Item Name:<br>
        <input type="text" name="item_name" value="<?php echo old($inputs,'item_name');?>"> <br>
        <?php if(isset($errors['item_name'])):?>
            <span class="text-danger"><?php echo $errors['item_name'][0]; ?></span>
        <?php endif;?> <br />
        
        Category :<br>
        <select name="category_name" style="width:170px;" onchange="showUser(this.value)" id="main_cat">
            <option selected>Custom Select Menu</option>
            <?php foreach($category as $cat_item){?>
                <option value="<?php echo $cat_item['category_id'];?>"><?php echo $cat_item['category_name'];?></option>
            <?php } ?>
        </select> <br><br />

        Sub Category :<br>
        <div id="divIDClass">
            <select name="subcat_name" id="sub_cat" style="width:170px;">
                <option value="0">- Select -</option>
            </select> <br><br />
        </div>
        

        Brand :<br>
        <select name="brand_name" style="width:170px;">
            <option selected>Custom Select Menu</option>
            <?php foreach($brand as $brand_item){?>
                <option value="<?php echo $brand_item['brand_id'];?>"><?php echo $brand_item['brand_name'];?></option>
            <?php } ?>
        </select> <br>
        <?php if(isset($errors['class'])):?>
            <span class="text-danger"><?php echo $errors['class'][0]; ?></span>
        <?php endif;?> <br />

        Color :<br>
        <select name="color_name" style="width:170px;">
            <option selected>Custom Select Menu</option>
            <?php foreach($color as $color_item){?>
                <option value="<?php echo $color_item['color_id'];?>"><?php echo $color_item['color_name'];?></option>
            <?php } ?>
        </select> <br>
        <?php if(isset($errors['class'])):?>
            <span class="text-danger"><?php echo $errors['class'][0]; ?></span>
        <?php endif;?> <br />

        Size :<br>
        <select name="size_name" style="width:170px;">
            <option selected>Custom Select Menu</option>
            <?php foreach($size as $size_item){?>
                <option value="<?php echo $size_item['size_id'];?>"><?php echo $size_item['size_name'];?></option>
            <?php } ?>
        </select> <br>
        <?php if(isset($errors['class'])):?>
            <span class="text-danger"><?php echo $errors['class'][0]; ?></span>
        <?php endif;?> <br />

        Item price:<br>
        <input type="text" name="item_price" value="<?php echo old($inputs,'item_price');?>"> <br>
        <?php if(isset($errors['roll'])):?>
            <span class="text-danger"><?php echo $errors['item_price'][0]; ?></span>
        <?php endif;?> <br />

        <input type="submit" value="Submit">
    </form>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#main_cat").change(function(){
                var id = $(this).val();
                var id = $(this).val();
                if(id==0){
                    $("#divIDClass").hide();
                }
                else{
                    $("#divIDClass").show();
                }
                $('#sub_cat').find('option').remove();
                $.ajax({
                    url: "add/"+id,
                    type: 'get',
                    //data: {cat_id:id},
                    dataType: 'json',
                    success:function(response){
                        var len = response['selected_subcat'].length;
                        $("#sub_cat").empty();
                        for( var i = 0; i<len; i++){
                            var subcat_id = response['selected_subcat'][i].id;
                            var subcat_name = response['selected_subcat'][i].subcat_name;
                            $("#sub_cat").append("<option value='"+subcat_id+"'>"+subcat_name+"</option>");
                        }
                    }
                });
            });
        });
    </script>

</body>
</html>