<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>All Student List</h2>
<a href="<?php echo route('curd/add'); ?>">Add New Stusent</a>
<br/><br/>

<?php
    if (empty($dataShow)){
        echo "There is no data";
    } 
    else {
        print_r($dataShow);
        ?>
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Id.." title="Type a Id">
        <br/><br/>
        <table id="myTable" class="table table-striped table-sm">
            <tr>
                <th>Student Id</th>
                <th>Student Name</th>
                <th>Student Roll</th>
                <th>Class</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php foreach ($dataShow as $row) { ?>
                <tr>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->roll; ?></td>
                    <td><?php echo $row->class; ?></td>
                    <td><a href="<?php echo route('curd/view/' . $row->id); ?>">View</a></td>
                    <td><a href="<?php echo route('curd/edit/' . $row->id); ?>">Edit</a></td>
                    <td>
                        <form action="<?php echo route('curd/delete/'. $row->id); ?>" method="post">
                            <input type="submit" onclick="return confirm('Are you sure you want to delete this item?');" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
<?php } ?>

<script>
function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }       
    }
}
</script>

</body>
</html>
