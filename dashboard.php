<?php include('header.php') ?>

<?php
// Users
$users = $db->query("SELECT * FROM users WHERE User_status='1'")->num_rows;

// Departments
$offices = $db->query("SELECT * FROM offices")->num_rows;

// Students
$students = $db->query("SELECT * FROM students")->num_rows;

// courses
$courses = $db->query("SELECT * FROM courses")->num_rows;
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Dashboard <small>Control panel</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $offices < 10 ? '0'.$offices : $offices ?></h3>
                        <p>Approved Requests</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-thumbs-up"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h3><?php echo $courses < 10 ? '0'.$courses : $courses ?></h3>
                        <p>Rejected Requests</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-thumbs-down"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $students < 10 ? '0'.$students : $students ?></h3>
                        <p>Departments</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-university"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $users < 10 ? '0'.$users : $users ?></h3>
                        <p>Connect With Departmental Head</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-message"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('footer.php') ?>