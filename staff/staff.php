<?php include('header.php') ?>

<?php
// check if there is delete id
if(!empty($_GET['delid']))
{
    // delete the staff from the database
    $delid = $_GET['delid'];
    $db->query("DELETE FROM staff WHERE id='$delid'");
    
    // return to the students page
    echo '<script type="text/javascript">window.history.back();</script>';
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>&nbsp;Staff List
            <div class="pull-right">
                <a href="add_staff.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i> New Staff</a><br>
            </div> 
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Staff ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email Address</th>
                                    <th>Mobile Phone</th>
                                    <th>Position</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $staffs=$db->query("SELECT * FROM staff LEFT JOIN departments ON departid=department");
                            while($row = $staffs->fetch_array()){
                            ?>
                                <tr>
                                    <td>
                                        <a href="staff.php?delid=<?php echo $row['id'] ?>" style="color:red"><i class="fa fa-trash"></i> Delete&nbsp;</a>
                                        <a href="edit_staff.php?id=<?php echo $row['id'] ?>" style="color:orange"><i class="fa fa-pencil"></i> Edit</a>
                                    </td>
                                    <td><?php echo $row['idNumber'] ?></td>
                                    <td><?php echo $row['lastName'] ?></td>
                                    <td><?php echo $row['firstName'] ?> </td>
                                    <td><?php echo $row['emailAddress'] ?> </td>
                                    <td><?php echo $row['phoneNumber'] ?> </td>
                                    <td><?php echo $row['staffPosition'] ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('footer.php') ?>