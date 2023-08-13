<?php include('header.php') ?>

<?php
// check if there is delete id
if(!empty($_GET['delid']))
{
    // delete the office from the database
    $delid = $_GET['delid'];
    $db->query("DELETE FROM offices WHERE officeid='$delid'");
    
    // return to the offices page
    echo '<script type="text/javascript">window.history.back();</script>';
}

$office_acronym = '';
$office_name = '';

$id = '';

$title = 'Add New office';

// If the edit id is not empty
if(!empty($_GET['id']))
{
    // get the id to edit the office
    $id = $_GET['id'];
    $office = $db->query("SELECT * FROM offices WHERE officeid='$id'")->fetch_array();
    $office_acronym = $office['office_acronym'];
    $office_name = $office['office_name'];
    $title = "Update office";
}

// when save button is clicked
if(isset($_POST['save']))
{
    $office_acronym = $_POST['office_acronym'];
    $office_name = $_POST['office_name'];
    $idname = $_POST['idname'];

    // If there is no key, insert
    if(empty($_POST['idname']))
    {
        // Insert the records
        $db->query("INSERT INTO offices (office_acronym, office_name) VALUES ('$office_acronym', '$office_name')");
        echo '<script type="text/javascript">window.history.back();</script>';
    }else{

        // update the records
        $db->query("UPDATE offices SET office_acronym='$office_acronym', office_name='$office_name' WHERE officeid='$idname'");
        echo '<script type="text/javascript">window.history.back();</script>';
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>&nbsp;University Clearance Offices 
            <div class="pull-right">
                <a href="offices.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i> New office</a><br>
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
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $offices=$db->query("SELECT * FROM offices");
                            while($row = $offices->fetch_array()){
                            ?>
                                <tr>
                                    <td>
                                        <a href="offices.php?delid=<?php echo $row['officeid'] ?>" style="color:red"><i class="fa fa-trash"></i> Delete&nbsp;&nbsp;</a>
                                        <a href="offices.php?id=<?php echo $row['officeid'] ?>" style="color:orange"><i class="fa fa-pencil"></i> Edit</a>
                                    </td>
                                    <td><?php echo $row['office_acronym'] ?></td>
                                    <td><?php echo $row['office_name'] ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-primary">
                    <form role="form" method="POST" action="offices.php">
                        <div class="box-body">
                            <input type="hidden" name="idname" value="<?php echo $id ?>">
                            <div class="form-group">
                                <label>Office Code</label>
                                <input type="text" name="office_acronym" class="form-control" value="<?php echo $office_acronym ?>" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Office Name</label>
                                <input type="text" name="office_name" class="form-control" value="<?php echo $office_name ?>" autocomplete="off">
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