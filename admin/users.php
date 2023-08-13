<?php include('header.php') ?>

<?php
// check if there is delete id
if(!empty($_GET['delid']))
{
    // get the userid
    $delid = $_GET['delid'];

    // delete the user from the users table
    $db->query("DELETE FROM users WHERE Userid='$delid'");

    // return to the users page
    echo '<script type="text/javascript">window.history.back();</script>';
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>&nbsp;Admin Users
            <div class="pull-right">
                <a href="add_user.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i> New User</a><!--&nbsp;
                <a href="users_pdf.php" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> PDF Report</a>&nbsp;--><br>
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
                                    <th>Username</th>
                                    <th>Full name</th>
                                    <th>User Position (office)</th>
                                    <th>Phone No.</th>
                                    <th>Email Addr.</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $users = $db->query("SELECT * FROM users LEFT JOIN offices ON users.Position=offices.officeid");
                            while($row = $users->fetch_array()){
                            ?>
                                <tr>
                                    <td>
                                        <a href="users.php?delid=<?php echo $row['Userid'] ?>" style="color:red"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;
                                        <a href="add_user.php?id=<?php echo $row['Userid'] ?>" style="color:orange"><i class="fa fa-pencil"></i> Edit</a>
                                    </td>
                                    <td><?php echo $row['Username'] ?></td>
                                    <td><?php echo $row['Fullname'] ?></td>
                                    <td><?php echo $row['office_name'] ?></td>
                                    <td><?php echo $row['Userphone'] ?></td>
                                    <td><?php echo $row['Usermail'] ?></td>
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