<?php include('header.php') ?>

<?php
// check if there is delete id
if(!empty($_GET['delid']))
{
    // delete the department from the database
    $delid = $_GET['delid'];
    $db->query("DELETE FROM courses WHERE courseid='$delid'");
    
    // return to the courses page
    echo '<script type="text/javascript">window.history.back();</script>';
}

$courseCode = '';
$courseName = '';
$courseDuration = '';
$courseDescription = '';

$id = '';

$title = 'Add New Course';

// If the edit id is not empty
if(!empty($_GET['id']))
{
    // get the id to edit the department
    $id = $_GET['id'];
    $course = $db->query("SELECT * FROM courses WHERE courseid='$id'")->fetch_array();
    $courseCode = $course['courseCode'];
    $courseName = $course['courseName'];
    $courseDuration = $course['courseDuration'];
    $courseDescription = $course['courseDescription'];
    $title = "Update Course";
}

// when save button is clicked
if(isset($_POST['save']))
{
    $courseCode = $_POST['courseCode'];
    $courseName = $_POST['courseName'];
    $courseDuration = $_POST['courseDuration'];
    $courseDescription = $_POST['courseDescription'];
    $idname = $_POST['idname'];

    // If there is no key, insert
    if(empty($_POST['idname']))
    {
        // Insert the records
        $db->query("INSERT INTO courses (courseCode, courseName, courseDuration, courseDescription) VALUES ('$courseCode', '$courseName', '$courseDuration', '$courseDescription')");
        echo '<script type="text/javascript">window.history.back();</script>';
    }else{

        // update the records
        $db->query("UPDATE courses SET courseCode='$courseCode', courseName='$courseName', courseDuration='$courseDuration', courseDescription='$courseDescription' WHERE courseid='$idname'");
        echo '<script type="text/javascript">window.history.back();</script>';
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>&nbsp;Available Courses
            <div class="pull-right">
                <a href="courses.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i> New Course</a><br>
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
                                    <th style="width: 20%"></th>
                                    <th>Code</th>
                                    <th>Course Name</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $courses=$db->query("SELECT * FROM courses");
                            while($row = $courses->fetch_array()){
                            ?>
                                <tr>
                                    <td>
                                        <a href="courses.php?delid=<?php echo $row['courseid'] ?>" style="color:red"><i class="fa fa-trash"></i> Delete&nbsp;</a>
                                        <a href="courses.php?id=<?php echo $row['courseid'] ?>" style="color:orange"><i class="fa fa-pencil"></i> Edit</a>
                                    </td>
                                    <td><?php echo $row['courseCode'] ?></td>
                                    <td><?php echo $row['courseName'] ?></td>
                                    <td><?php echo $row['courseDuration'] ?> Year(s)</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-primary">
                    <form role="form" method="POST" action="courses.php">
                        <div class="box-body">
                            <input type="hidden" name="idname" value="<?php echo $id ?>">
                            <div class="form-group">
                                <label>Course Code</label>
                                <input type="text" name="courseCode" class="form-control" value="<?php echo $courseCode ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Course Name</label>
                                <input type="text" name="courseName" class="form-control" value="<?php echo $courseName ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Course Duration (Years) </label>
                                <input type="number" name="courseDuration" class="form-control" value="<?php echo $courseDuration ?>" step="0.5">
                            </div>
                            <div class="form-group">
                                <label>Course Description</label>
                                <textarea class="form-control" name="courseDescription"><?php echo $courseDescription ?></textarea>
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