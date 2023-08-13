<?php include('header.php') ?>

<?php
// check if there is delete id
if(!empty($_GET['delid']))
{
    // delete the department from the database
    $delid = $_GET['delid'];
    $db->query("DELETE FROM departments WHERE departid='$delid'");
    
    // return to the departments page
    echo '<script type="text/javascript">window.history.back();</script>';
}

$departCode = '';
$departName = '';
$departHead = '';

$id = '';

$title = 'Add New Department';

// If the edit id is not empty
if(!empty($_GET['id']))
{
    // get the id to edit the department
    $id = $_GET['id'];
    $department = $db->query("SELECT * FROM departments WHERE departid='$id'")->fetch_array();
    $departCode = $department['departCode'];
    $departName = $department['departName'];
    $departHead = $department['departHead'];
    $title = "Update Department";
}

// when save button is clicked
if(isset($_POST['save']))
{
    $departCode = $_POST['departCode'];
    $departName = $_POST['departName'];
    $departHead = $_POST['departHead'];
    $idname = $_POST['idname'];

    // If there is no key, insert
    if(empty($_POST['idname']))
    {
        // Insert the records
        $db->query("INSERT INTO departments (departCode, departName, departHead) VALUES ('$departCode', '$departName', '$departHead')");
        echo '<script type="text/javascript">window.history.back();</script>';
    }else{

        // update the records
        $db->query("UPDATE departments SET departCode='$departCode', departName='$departName', departHead='$departHead' WHERE departid='$idname'");
        echo '<script type="text/javascript">window.history.back();</script>';
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>&nbsp;University Departments 
            <div class="pull-right">
                <a href="departments.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i> New Department</a><br>
            </div> 
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-8">
                <div class="box box-primary">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Dept. Code</th>
                                    <th>Dept. Name</th>
                                    <th>Dept. Head</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $departments=$db->query("SELECT * FROM departments");
                            while($row = $departments->fetch_array()){
                            ?>
                                <tr>
                                    <td>
                                        <a href="departments.php?delid=<?php echo $row['departid'] ?>" style="color:red"><i class="fa fa-trash"></i> Delete&nbsp;&nbsp;</a>
                                        <a href="departments.php?id=<?php echo $row['departid'] ?>" style="color:orange"><i class="fa fa-pencil"></i> Edit</a>
                                    </td>
                                    <td><?php echo $row['departCode'] ?></td>
                                    <td><?php echo $row['departName'] ?></td>
                                    <td><?php echo $row['departHead'] ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-primary">
                    <form role="form" method="POST" action="departments.php">
                        <div class="box-body">
                            <input type="hidden" name="idname" value="<?php echo $id ?>">
                            <div class="form-group">
                                <label>Department Code</label>
                                <input type="text" name="departCode" class="form-control" value="<?php echo $departCode ?>">
                            </div>
                            <div class="form-group">
                                <label>Department Name</label>
                                <input type="text" name="departName" class="form-control" value="<?php echo $departName ?>">
                            </div>
                            <div class="form-group">
                                <label>Department Head</label>
                                <input type="text" name="departHead" class="form-control" value="<?php echo $departHead ?>">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="save" class="btn btn-primary col-md-12">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('footer.php') ?>