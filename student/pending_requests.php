<!--  -->

<?php
include 'header.php';

// Fetch and display pending requests for the specific user
$sql = "SELECT c.*, o.office_name, u.Usermail AS office_head_email FROM clearance c
        LEFT JOIN offices o ON c.office = o.officeid
        LEFT JOIN users u ON c.office = u.position
        WHERE c.formStatus = '' AND c.student_name = '".$_SESSION['student']."'
        ORDER BY c.sendDate ASC";

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
            <li><a href="rejected_requests.php"><i class="fa fa-regular fa-thumbs-down"></i> Rejected Requests</a></li>
            <li class="active"><a href="pending_requests.php"><i class="fa fa-hourglass-half"></i> Pending Requests</a></li>
            <li><a href="send_complaint.php"><i class="fa fa-regular fa-message"></i> Send Complaint</a></li>
        </ul>
    </section>
</aside>

<div class="content-wrapper">
    <section class="content-header">
        <h1 style="text-align: center;">&nbsp;My Pending Requests
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
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 28%; text-align: left;">Department / Unit</th>
                                    <th style="width: 10%; text-align: center;">Status</th>
                                    <th style="width: 15%; text-align: center;">Date Sent</th>
                                    <th style="width: 10%; text-align: center;">Send Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $counter++;
                                    $status = '<button class="btn btn-warning btn-sm"><i class="fa fa-hourglass-half"></i></button>'; // Yellow button with hourglass icon

                                    // Calculate the difference between today's date and the sendDate in days
                                    $today = new DateTime();
                                    $sendDate = new DateTime($row['sendDate']);
                                    $dateDifference = $today->diff($sendDate)->days;

                                    $emailButton = '<td style="text-align: center;">';

                                    // Check if the difference is at least 2 days, then enable the button, otherwise disable it
                                    if ($dateDifference >= 2) {
                                        $emailButton .= '<form action="https://mail.google.com/mail/" method="get" target="_blank">
                                                            <input type="hidden" name="view" value="cm">
                                                            <input type="hidden" name="to" value="' . $row['office_head_email'] . '">
                                                            <input type="submit" value="Send Email" class="btn btn-primary">
                                                        </form>';
                                    } else {
                                        $emailButton .= '<button class="btn btn-primary" disabled>Send Email</button>';
                                    }
                                    $emailButton .= '</td>';

                                    echo '<tr>';
                                    echo '<td>' . $counter . '</td>';
                                    echo '<td>' . $row['office_name'] . '</td>'; // Display the office name
                                    echo '<td style="text-align: center;">' . $status . '</td>';
                                    echo '<td style="text-align: center;">' . $row['sendDate'] . '</td>'; // Display the date sent
                                    echo $emailButton;
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
