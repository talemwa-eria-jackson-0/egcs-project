<?php include 'header.php' ?>
<?php 

// wait for the submit button to be clicked
if( isset($_POST['update']) )
{
    // get the form input values
    $fname = $_POST['othernames'];
    $lname = $_POST['surname'];
    $regnum = $_POST['regNumber'];
    $phone = $_POST['studPhone'];
    $joinYear = $_POST['joinYear'];
    $complete = $_POST['dateOfCompletion'];

    // Run an update query
    $db->query("UPDATE students SET surname='$lname', othernames='$fname', regNumber='$regnum', studPhone='$phone', joinYear='$joinYear', dateOfCompletion='$complete' WHERE studentid='".$_SESSION['student']."'");
}
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <br>
            <li><a href="dashboard.php"><i class="fa fa-regular fa-gauge"></i> Dashboard</a></li>
            <li class="active"><a href="profile.php"><i class="fa fa-user"></i> Personal Information</a></li>
            <li><a href="clearance_form.php"><i class="fa fa-laptop"></i> Clearance Form</a></li>
            <li><a href="accepted_requests.php"><i class="fa fa-regular fa-thumbs-up"></i> Accepted Requests</a></li>
            <li><a href="rejected_requests.php"><i class="fa fa-regular fa-thumbs-down"></i> Rejected Requests</a></li>
            <li><a href="send_complaint.php"><i class="fa fa-regular fa-message"></i> Send Complaint</a></li>
        </ul>
    </section>
</aside>

<div class="content-wrapper">
    <section class="content-header">
        <h1>&nbsp;My Personal Information
            <div class="pull-right"></div> 
        </h1>
    </section>

    <section class="content">
        <form action="profile.php" method="POST">
            <div class="box box-primary">
                <div class="box-body col-lg-12">
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label>Registration Number</label>
                            <input type="text" class="form-control" name="regNumber" value="<?php echo $regnum ?>" readonly>
                        </div>

                        <div class="form-group col-sm-4">
                            <label>Surname</label>
                            <input type="text" class="form-control" name="surname" value="<?php echo $surname ?>">
                        </div>
                            
                        <div class="form-group col-sm-4">
                            <label>Other Names</label>
                            <input type="text" class="form-control" name="othernames" value="<?php echo $firstname ?>">
                        </div>

                        <div class="form-group col-sm-4">
                            <label>Email Address</label>
                            <input type="text" class="form-control" value="<?php echo $email ?>" readonly>
                        </div>

                        <div class="form-group col-sm-4">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" required="required" name="studPhone" value="<?php echo $phone ?>">
                        </div>

                        <div class="form-group col-sm-4">
                            <label>Course /Program</label>
                            <input type="text" class="form-control" value="<?php echo $courseCode ?>" readonly>
                        </div>

                        <div class="form-group col-sm-4">
                            <label>Year of Joining</label>
                            <input type="text" class="form-control" name="joinYear" value="<?php echo $joinYear ?>" readonly>
                        </div>

                        <div class="form-group col-sm-4">
                            <label>Date of Completion</label>
                            <input type="date" class="form-control" name="dateOfCompletion" value="<?php echo $dateOfComp ?>">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" name="update" class="btn btn-primary col-md-12">Update Profile</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
<?php include 'footer.php' ?>