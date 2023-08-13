<?php include('header.php') ?>
<?php

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

    // Insert the records
    $db->query("INSERT INTO staff (firstName, lastName, phoneNumber, emailAddress, idNumber, staffPosition, username, password) VALUES ('$firstName', '$lastName', '$phoneNumber','$emailAddress', '$idNumber', '$staffPosition', '$username',  '$password')");
    echo "<script>window.location='staff.php';</script>";
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>&nbsp;Add New Staff</h1>
    </section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form role="form" method="POST" action="add_staff.php">
                    <div class="box-body">
                        <div class="form-group col-md-6">
                            <label>First Name</label>
                            <input type="text" name="firstName" class="form-control" required="required" autocomplete="off">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Last Name(s)</label>
                            <input type="text" name="lastName" class="form-control" required="required" autocomplete="off">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Phone Number</label>
                            <input type="text" name="phoneNumber" class="form-control" required="required" onkeyup="this.value=this.value.replace(/[^\d\d]+/g, '');" autocomplete="off">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Email Address </label>
                            <input type="email" name="emailAddress" class="form-control" required="required">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Staff ID</label>
                            <input type="text" name="idNumber" class="form-control">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Staff Position</label>
                            <input type="text" name="staffPosition" class="form-control" autocomplete="off">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control"  autocomplete="off">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Password </label>
                            <input type="password" name="password" class="form-control" autocomplete="off">
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