<?php include('header.php') ?>
<?php

$firstName = '';
$lastName = '';
$phoneNumber = '';
$emailAddress = '';
$idNumber = '';
$staffPosition = '';
$username = '';
$password = '';

$id = '';

$title = 'Add Staff';

// check if there is an edit id
if(!empty($_GET['id']))
{
    // read the edit id
    $id = $_GET['id'];

    // fetch details of the staff /graduand
    $staff = $db->query("SELECT * FROM staff LEFT JOIN departments ON departid=department WHERE id='$id'")->fetch_array();
    $firstName = $staff['firstName'];
    $lastName = $staff['lastName'];
    $phoneNumber = $staff['phoneNumber'];
    $emailAddress = $staff['emailAddress'];
    $idNumber = $staff['idNumber'];
    $staffPosition = $staff['staffPosition'];
    $username = $staff['username'];
    $password = $staff['password'];
    
    $title = "Update Staff";
}

// wait for submit button to be clicked
if(isset($_POST['save']))
{
    // get form values
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $emailAddress = $_POST['emailAddress'];
    $idNumber = $_POST['idNumber'];
    $staffPosition = $_POST['staffPosition'];
    $username = $_POST['username'];
    $password = sha1($_POST['password']);

    // id for updating
    $idname = $_POST['idname'];

    $db->query("UPDATE staff SET firstName='$firstName', lastName='$lastName', emailAddress='$emailAddress', idNumber='$idNumber', phoneNumber='$phoneNumber', staffPosition='$staffPosition' WHERE id='$idname'");
    echo "<script>window.location='staff.php';</script>";
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>&nbsp;<?php echo $title ?></h1>
    </section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form role="form" method="POST" action="edit_staff.php">
                    <div class="box-body">
                        <input type="hidden" name="idname" value="<?php echo $id ?>">
                        <div class="form-group col-md-6">
                            <label>First Name</label>
                            <input type="text" name="firstName" class="form-control" value="<?php echo $firstName ?>" required="required" autocomplete="off">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Last Name(s)</label>
                            <input type="text" name="lastName" class="form-control" value="<?php echo $lastName ?>" required="required" autocomplete="off">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Phone Number</label>
                            <input type="text" name="phoneNumber" class="form-control" value="<?php echo $phoneNumber ?>" required="required" onkeyup="this.value=this.value.replace(/[^\d\d]+/g, '');" autocomplete="off">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Email Address </label>
                            <input type="email" name="emailAddress" class="form-control" value="<?php echo $emailAddress ?>" required="required">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Staff ID</label>
                            <input type="text" name="idNumber" class="form-control" value="<?php echo $idNumber ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Staff Position</label>
                            <input type="text" name="staffPosition" class="form-control" value="<?php echo $staffPosition ?>" autocomplete="off">
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