<?php include('header.php') ?>

<?php
// check if there is delete id
if(!empty($_GET['delid']))
{
    // delete the student from the database
    $delid = $_GET['delid'];
    $db->query("DELETE FROM students WHERE studentid='$delid'");
    
    // return to the students page
    echo '<script type="text/javascript">window.history.back();</script>';
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>&nbsp;Graduands List
            <?php if( $userrole==1 ): ?>
            <div class="pull-right">
                <a href="add_student.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i> New Graduand</a><br>
            </div>
            <?php endif ?>
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
                                    <th>Reg. No</th>
                                    <th>Full Name</th>
                                    <th>ID Number</th>
                                    <th>Email Address</th>
                                    <th>Mobile Phone</th>
                                    <th>Course</th>
                                    <th>Year</th>
                                    <th>Form Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $students=$db->query("SELECT * FROM students LEFT JOIN courses ON courseid=studCourse");
                            while($row = $students->fetch_array()){
                            ?>
                                <tr>
                                    <td>
                                        <?php if( $userrole==1 ): ?>
                                        <a href="students.php?delid=<?php echo $row['studentid'] ?>" style="color:red"><i class="fa fa-trash"></i> Delete&nbsp;</a>
                                        <a href="add_student.php?id=<?php echo $row['studentid'] ?>" style="color:orange"><i class="fa fa-pencil"></i> Edit</a>
                                        <?php endif ?>
                                    </td>
                                    <td><?php echo $row['regNumber'] ?></td>
                                    <td><?php echo $row['surname'].' '.$row['othernames'] ?></td>
                                    <td><?php echo $row['iDNumber'] ?> </td>
                                    <td><?php echo $row['studmail'] ?> </td>
                                    <td><?php echo $row['studPhone'] ?> </td>
                                    <td><?php echo $row['courseCode'] ?></td>
                                    <td><?php echo $row['joinYear'] ?></td>
                                    <td></td>
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