<?php include('header.php') ?>

<?php
// check if send request is clicked
if (!empty($_GET['formid'])) {
    // update the form link
    $formid = $_GET['formid'];
    $date = date('Y-m-d H:i:s');

    // Check if the form had been previously sent by the user
    $sql = $db->query("SELECT * FROM clearance WHERE office='$formid' AND student_name='" . $_SESSION['student'] . "'");
    if ($sql->num_rows == 0) {
        // Insert a new record with the user_id
        $user_id = $_SESSION['student']; // Assuming the session variable holds the user_id
        $db->query("INSERT INTO clearance (student_name, office, sendStatus, sendDate, user_id) VALUES ('" . $_SESSION['student'] . "', '$formid', 1, '" . date('d-m-Y') . "', '$user_id')");
    } else {
        // Update the existing record for the user
        $db->query("UPDATE clearance SET formStatus='' WHERE office='$formid' AND student_name='" . $_SESSION['student'] . "'");
    }
    echo "<script>window.history.back();</script>";
}
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <br>
            <li><a href="dashboard.php"><i class="fa fa-gauge"></i> Dashboard</a></li>
            <li><a href="profile.php"><i class="fa fa-user"></i> Personal Information</a></li>
            <li class="active"><a href="clearance_form.php"><i class="fa fa-laptop"></i> Clearance Form</a></li>
            <li><a href="accepted_requests.php"><i class="fa fa-regular fa-thumbs-up"></i> Accepted Requests</a></li>
            <li><a href="rejected_requests.php"><i class="fa fa-regular fa-thumbs-down"></i> Rejected Requests</a></li>
            <li><a href="send_complaint.php"><i class="fa fa-regular fa-message"></i> Send Complaint</a></li>
        </ul>
    </section>
</aside>

<div class="content-wrapper">
    <section class="content-header">
        <h1>&nbsp;My Clearance Form</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5%"></th>
                                    <th style="width: 35%">Department /Unit</th>
                                    <th style="width: 10%">Status</th>
                                    <th style="width: 38%">Comments</th>
                                    <th>Form</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 0;
                                $sql = $db->query("SELECT * FROM offices LEFT JOIN clearance ON clearance.office=offices.officeid LEFT JOIN students ON students.studentid = clearance.student_name WHERE user_id='" . $_SESSION['student'] . "' ORDER BY officeid ASC");
                                while ($row = $sql->fetch_array()) {
                                    $cleared = $row['formStatus'];
                                    if ($cleared == 1) {
                                        $status = 'Cleared';
                                    } elseif ($cleared == 2) {
                                        $status = 'Not Cleared';
                                    } elseif ($row['sendStatus'] == 1) {
                                        $status = 'Pending';
                                    } else {
                                        $status = 'Not Sent';
                                    }

                                    if ($row['formStatus'] == 2 && $row['sendStatus'] == 1) {
                                        $btn = '<a href="clearance_form.php?formid=' . $row['officeid'] . '" class="btn btn-sm btn-primary">Resend Request</a>';
                                    } elseif ($row['sendStatus'] == 1) {
                                        $btn = 'Form Sent';
                                    } else {
                                        $btn = '<a href="clearance_form.php?formid=' . $row['officeid'] . '" class="btn btn-sm btn-primary">Send Request</a>';
                                    }
                                    $counter++; ?>
                                    <tr>
                                        <td><?php echo $counter ?></td>
                                        <td><?php echo $row['office_name']; ?></td>
                                        <td><?php echo $status ?></td>
                                        <td><?php echo ($row['formStatus'] == 1 || $row['formStatus'] == 2) ? $row['formComments'] : '' ?></td>
                                        <td><?php echo $btn ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('footer.php') ?>
