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

// Requests by Office
$officeDataQuery = "SELECT offices.office_name,
                           COUNT(clearance.formid) AS totalRequests,
                           SUM(CASE WHEN clearance.formStatus = 1 THEN 1 ELSE 0 END) AS acceptedRequests,
                           SUM(CASE WHEN clearance.formStatus = 2 THEN 1 ELSE 0 END) AS rejectedRequests,
                           SUM(CASE WHEN clearance.formStatus = '' THEN 1 ELSE 0 END) AS pendingRequests
                    FROM offices
                    LEFT JOIN clearance ON offices.officeid = clearance.office
                    GROUP BY offices.officeid
                    ORDER BY offices.officeid";

$officeDataResult = $db->query($officeDataQuery);
$officeData = [];

while ($row = $officeDataResult->fetch_assoc()) {
    $officeData[] = $row;
}
?>

<!-- html  -->
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
                        <p>Clearance Offices</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-university"></i>
                    </div>
                    <a href="offices.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h3><?php echo $courses < 10 ? '0'.$courses : $courses ?></h3>
                        <p>Courses</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-pencil"></i>
                    </div>
                    <a href="courses.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $students < 10 ? '0'.$students : $students ?></h3>
                        <p>Graduands</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-university"></i>
                    </div>
                    <a href="students.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $users < 10 ? '0'.$users : $users ?></h3>
                        <p>System Users</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-secret"></i>
                    </div>
                    <a href="users.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Display bar graph for clearances by office -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Requests by Office</h3>
                    </div>
                    <div class="box-body">
                        <canvas id="bar-chart" width="800" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<?php include('footer.php') ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Prepare data for the chart
    var officeNames = <?php echo json_encode(array_column($officeData, 'office_name')); ?>;
    var totalRequests = <?php echo json_encode(array_column($officeData, 'totalRequests')); ?>;
    var acceptedRequests = <?php echo json_encode(array_column($officeData, 'acceptedRequests')); ?>;
    var rejectedRequests = <?php echo json_encode(array_column($officeData, 'rejectedRequests')); ?>;
    var pendingRequests = <?php echo json_encode(array_column($officeData, 'pendingRequests')); ?>;


    // Create a bar chart using Chart.js
    var ctx = document.getElementById('bar-chart').getContext('2d');
    var barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: officeNames,
            datasets: [
                {
                    label: 'Sent Requests',
                    data: totalRequests,
                    backgroundColor: 'blue',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Accepted Requests',
                    data: acceptedRequests,
                    backgroundColor: 'green',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Rejected Requests',
                    data: rejectedRequests,
                    backgroundColor: 'red',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Pending Requests',
                    data: pendingRequests,
                    backgroundColor: 'yellow',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    console.log("DOMContentLoaded event fired");
});


</script>