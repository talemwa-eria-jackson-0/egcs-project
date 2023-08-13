<?php include('header.php') ?>

<?php
// Accepted Requests
$acceptedRequests = $db->query("SELECT * FROM clearance WHERE formStatus = '1' AND student_name = '".$_SESSION['student']."'")->num_rows;

// Rejected Requests
$rejectedRequests = $db->query("SELECT * FROM clearance WHERE formStatus = '2' AND student_name = '".$_SESSION['student']."'")->num_rows;

// Pending Requests
$pendingRequests = $db->query("SELECT * FROM clearance WHERE formStatus = '' AND student_name = '".$_SESSION['student']."'")->num_rows;

// Departments
$departments = $db->query("SELECT * FROM offices")->num_rows;

// Sent Requests
$sentRequests = $db->query("SELECT COUNT(*) AS count FROM clearance WHERE sendStatus = 1 AND student_name = '".$_SESSION['student']."'")->fetch_assoc()['count'];

// Not Sent Requests
$notSentRequests = $departments - $sentRequests;

$upcomingGraduationDate = "2023-10-28";

// Calculate the number of days remaining to the graduation ceremony
$today = date('Y-m-d');
$daysRemaining = (strtotime($upcomingGraduationDate) - strtotime($today)) / (60 * 60 * 24);
$daysRemaining = max(0, ceil($daysRemaining)); // Ensure it's a positive integer or zero

// Calculate the percentage of cleared requests
$totalRequests = $acceptedRequests + $rejectedRequests + $pendingRequests;
$clearedPercentage = ($acceptedRequests / $totalRequests) * 100;
?>


<style>
/* CSS to style the upcoming graduation date box */
.bg-gradient-maroon {
    background: aqua;
    border: 2px solid aqua; /* Add border style */
}

.bg-gradient-maroon p {
    margin: 0;
    font-size: 24px;
    font-weight: bold;
    padding: 10px; /* Add some padding to the box */
    background-color: aqua; /* Add cool background color */
}

.text-white {
    color: #fff; /* Add text color for the box content */
}
</style>

<!-- ... Rest of the HTML and JavaScript code ... -->






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



            <!-- New column for the pie chart -->
            <div class="col-lg-6">
                <div class="box box-primary">
                    <div class="box-body">
                        <canvas id="requestsPieChart" width="400" height="250"></canvas>
                    </div>
                </div>
            </div>

            <!-- Existing columns for the small boxes -->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-
                ">
                <div class="inner">
                        <h3><?php echo $acceptedRequests < 10 ? '0' . $acceptedRequests : $acceptedRequests ?></h3>
                        <p>Accepted Requests</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                <div class="inner">
                        <h3><?php echo $rejectedRequests < 10 ? '0' . $rejectedRequests : $rejectedRequests ?></h3>
                        <p>Rejected Requests</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-times"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                <div class="inner">
                        <h3><?php echo $pendingRequests < 10 ? '0' . $pendingRequests : $pendingRequests ?></h3>
                        <p>Pending Requests</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-hourglass-half"></i>
                    </div>
                </div>
            </div>

            <!-- ... Existing column for departments ... -->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $departments < 10 ? '0' . $departments : $departments ?></h3>
                        <p>Departments</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-university"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
        </div>
        
<!-- Full-width row for the upcoming graduation date -->
        <div class="row bg-gradient-maroon text-center py-3">
            <div class="col">
                <p class="text-white" id="graduationDate"><?php echo $daysRemaining; ?> days remaining to graduation</p>
            </div>
        </div>



    </section>
</div>




<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// JavaScript code to create the pie chart
document.addEventListener('DOMContentLoaded', function () {
    // Your existing JavaScript code for the pie chart
    var acceptedRequests = <?php echo $acceptedRequests ?>;
    var rejectedRequests = <?php echo $rejectedRequests ?>;
    var pendingRequests = <?php echo $pendingRequests ?>;

    var ctx = document.getElementById('requestsPieChart').getContext('2d');
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Accepted', 'Rejected', 'Pending'],
            datasets: [{
                data: [acceptedRequests, rejectedRequests, pendingRequests],
                backgroundColor: ['#28a745', '#dc3545', '#ffc107'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom'
            }
        }
    });

 // JavaScript code to show/hide graduation box in a loop
 function toggleGraduationBox() {
        var graduationDate = document.getElementById('graduationDate');

        // Toggle the visibility of the box
        if (graduationDate.style.visibility === 'hidden') {
            graduationDate.style.visibility = 'visible';
        } else {
            graduationDate.style.visibility = 'hidden';
        }

        // Schedule the next toggle after 3 seconds
        setTimeout(toggleGraduationBox, 3000);
    }

    // Start the toggle loop
    toggleGraduationBox();

});
</script>

<?php include('footer.php') ?>
