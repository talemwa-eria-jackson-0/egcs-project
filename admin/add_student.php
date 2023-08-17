

<?php include('header.php') ?>
<?php

$regNumber = '';
$iDNumber = '';
$othernames = '';
$surname = '';
$studmail = '';
$studphone = '';
$studCourse = '';
$joinYear = '';

$id = '';

$title = 'Add Graduand';

// Initialize the emailExists variable
$emailExists = false;

// check if there is an edit id
if (!empty($_GET['id'])) {
    // read the edit id
    $id = $_GET['id'];

    // fetch details of the student /graduand
    $student = $db->query("SELECT * FROM students LEFT JOIN courses ON courseid=studCourse WHERE studentid='$id'")->fetch_array();
    $regNumber = $student['regNumber'];
    $iDNumber = $student['iDNumber'];
    $othernames = $student['othernames'];
    $surname = $student['surname'];
    $studmail = $student['studmail'];
    $studphone = $student['studPhone'];
    $studCourse = $student['studCourse'];
    $joinYear = $student['joinYear'];

    $title = "Update Graduand";
}

// wait for submit button to be clicked
if (isset($_POST['save'])) {
    // get form values
        // get form values
        $regNumber = $_POST['regNumber'];
        $iDNumber = $_POST['iDNumber'];
        $othernames = $_POST['othernames'];
        $surname = $_POST['surname'];
        $studmail = $_POST['studmail'];
        $studphone = $_POST['studphone'];
        $studCourse = $_POST['studCourse'];
        $joinYear = $_POST['joinYear'];
    
        // id for updating
        $idname = $_POST['idname'];

    // Check if the email already exists
    $existingStudent = $db->query("SELECT * FROM students WHERE studmail = '$studmail'")->fetch_assoc();
    if ($existingStudent && ($existingStudent['studentid'] != $id)) {
        $emailExists = true;
    } else {
        $emailExists = false;
    }

    if ($emailExists) {
        echo "This email address is already in use.";
    } else {
        // If there is no key, insert
        if (empty($_POST['idname'])) {
            // Insert the records
            $db->query("INSERT INTO students (regNumber, iDNumber, othernames, surname, studmail, studPhone, studCourse, joinYear) VALUES ('$regNumber', '$iDNumber', '$othernames','$surname', '$studmail', '$studphone', '$studCourse',  '$joinYear')");
            echo "<script>window.location='students.php';</script>";
        } else {
            $db->query("UPDATE students SET regNumber='$regNumber', iDNumber='$iDNumber', surname='$surname', studmail='$studmail', othernames='$othernames', studCourse='$studCourse', joinYear='$joinYear', studPhone='$studphone' WHERE studentid='$idname'");
            echo "<script>window.location='students.php';</script>";
        }
    }
}

?>

<style>
    .error-message {
        color: red;
        margin-top: 2px;
    }
</style>













<div class="content-wrapper">
    <section class="content-header">
        <h1>&nbsp;<?php echo $title ?></h1>
    </section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form role="form" method="POST" action="add_student.php">
                    <div class="box-body">
                        <input type="hidden" name="idname" value="<?php echo $id ?>">
                        <div class="form-group col-md-6">
                            <label>Registration Number</label>
                            <input type="text" name="regNumber" class="form-control" value="<?php echo $regNumber ?>" required="required" autocomplete="off">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Student ID Number</label>
                            <input type="text" name="iDNumber" class="form-control" value="<?php echo $iDNumber ?>" required="required" autocomplete="off">
                        </div>

                        <div class="form-group col-md-6">
                            <label>First Name</label>
                            <input type="text" name="othernames" class="form-control" value="<?php echo $othernames ?>" required="required" autocomplete="off">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Surname </label>
                            <input type="text" name="surname" class="form-control" value="<?php echo $surname ?>" required="required" autocomplete="off">
                        </div>

                        <div class="form-group col-md-6">
    <label>Email Address</label>
    <input type="email" name="studmail" class="form-control" value="<?php echo $studmail ?>" required="required" autocomplete="off" pattern=".+@muni\.ac\.ug$" required placeholder="student@muni.ac.ug">
    
    <!-- Display the error message if email already exists -->
    <?php if ($emailExists && ($existingStudent['studentid'] != $id)) : ?>
        <div class="error-message">This email address is already in use.</div>
    <?php endif; ?>
</div>




                        <div class="form-group col-md-6">
                            <label>Mobile Phone Number</label>
                            <input type="text" name="studphone" class="form-control" value="<?php echo $studphone ?>" autocomplete="off">
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label>Course /Program Name</label>
                            <select class="form-control" name="studCourse" required="required">
                                <option value=""></option>
                            <?php while( $row=$courses->fetch_array()){
                                echo "<option value='".$row['courseid']."'";
                                if($row['courseid']==$studCourse) echo 'selected';
                                echo ">".$row['courseName']."</option>";
                            }?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Joining Year</label>
                            <input type="text" name="joinYear" class="form-control" value="<?php echo $joinYear ?>" required="required" autocomplete="off">
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