<?php include('header.php') ?>

<?php

$studname = '';
$formid = '';

// check if there is delete id
if( !empty($_GET['id']) )
{
    // General ID
    $id = explode("-", $_GET['id']);

    // student id
    $formid = $id[0];
    $studid = $id[1];

    // get Student Details
    $student = $db->query("SELECT * FROM students WHERE studentid='".$studid."'")->fetch_array();
    $studname = $student['surname'].' '.$student['othernames'];
}

// when save button is clicked
if(isset($_POST['save']))
{
    // student id and form id
    $formid = $_POST['formid'];
    $formstatus = $_POST['formStatus'];
    $formcommen = $_POST['formComments'];
    $formdate = date('d-m-Y');

    $db->query("UPDATE clearance SET formStatus='$formstatus', formComments='$formcommen', formDate='$formdate' WHERE formid='$formid'") or die($db->error);
    echo '<script>window.location="clearance_requests.php";</script>';
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 style="text-align: center;">Clear Student for Graduation
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-primary">
                    <form role="form" method="POST" action="clear.php">
                        <div class="box-body">
                            <input type="hidden" name="formid" class="form-control" value="<?php echo $formid ?>">
                            <div class="form-group">
                                <label>Student Name</label>
                                <input type="text" name="studame" class="form-control" value="<?php echo $studname ?>" autocomplete="off" readonly>
                            </div>
                            <div class="form-group">
                                <label>Accept Clearance?</label>
                                <select name="formStatus" class="form-control"  autocomplete="off" required="required">
                                    <option value=""></option>
                                    <option value="1">Accept</option>
                                    <option value="2">Reject</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Additional Comments</label>
                                <textarea class="form-control" name="formComments"></textarea>
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