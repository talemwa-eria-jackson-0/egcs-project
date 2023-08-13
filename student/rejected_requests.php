<?php
include 'header.php';

// Fetch and display rejected requests for the specific user
$sql = "SELECT c.*, o.office_name FROM clearance c
        LEFT JOIN offices o ON c.office = o.officeid
        WHERE c.formStatus = '2' AND c.student_name = '".$_SESSION['student']."'
        ORDER BY c.formDate ASC";

$result = $db->query($sql);
?>

<!-- Rest of the HTML and PHP code remains unchanged -->


<aside class="main-sidebar">
<section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <br>
            <li><a href="dashboard.php"><i class="fa fa-gauge"></i> Dashboard</a></li>
            <li><a href="profile.php"><i class="fa fa-user"></i> Personal Information</a></li>
            <li><a href="clearance_form.php"><i class="fa fa-laptop"></i> Clearance Form</a></li>
            <li><a href="accepted_requests.php"><i class="fa fa-regular fa-thumbs-up"></i> Accepted Requests</a></li>
            <li class="active"><a href="rejected_requests.php"><i class="fa fa-regular fa-thumbs-down"></i> Rejected Requests</a></li>
            <li><a href="pending_requests.php"><i class="fa fa-hourglass-half"></i> Pending Requests</a></li>
            <li><a href="send_complaint.php"><i class="fa fa-regular fa-message"></i> Send Complaint</a></li>
        </ul>
    </section>
</aside>

<div class="content-wrapper">
    <section class="content-header">
        <h1 style="text-align: center;">&nbsp;My Rejected Requests
            <div class="pull-right"></div>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 4%; text-align: center;">#</th>
                                    <th style="width: 22%; text-align: left;">Department / Unit</th>
                                    <th style="width: 8%; text-align: center;">Status</th>
                                    <th style="width: 21%; text-align: center;">Comments</th>
                                    <th style="width: 9%; text-align: center;">Date</th>
                                    <th style="width: 10%; text-align: center;">Form</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $counter++;
                                    $status = '<button class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>'; // Green button with checkmark icon
                                    $btn = '<a href="clearance_form.php?formid=' . $row['office'] . '" class="btn btn-sm btn-primary">Resend</a>'; // Resend Request button

                                    echo '<tr>';
                                    echo '<td>' . $counter . '</td>';
                                    echo '<td>' . $row['office_name'] . '</td>'; // Display the office name
                                    echo '<td style="text-align: center;">' . $status . '</td>';
                                    echo '<td style="text-align: center;">' . $row['formComments'] . '</td>';
                                    echo '<td style="text-align: center;">' . $row['formDate'] . '</td>';
                                    echo '<td style="text-align: center;">' . $btn . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include 'footer.php'; ?>
