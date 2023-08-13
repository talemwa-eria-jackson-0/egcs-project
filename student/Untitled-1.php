<?php include('header.php') ?>

<?php 
    // check if send request is clicked
    if( !empty($_GET['formid']) )
    {
        // update the form link
        $formid = $_GET['formid'];
        $date = date('Y-m-d H:i:s');

        // check if the form had been previously sent
        $sql = $db->query("SELECT * FROM clearance WHERE office='$formid' AND student_name='".$_SESSION['student']."'");
        if( $sql->num_rows == 0){
            $db->query("INSERT INTO clearance(student_name, office, sendStatus, sendDate) VALUES ('".$_SESSION['student']."', '".$formid."', 1, '".date('d-m-Y')."')");
        }else{
            $db->query("UPDATE clearance SET formStatus='' WHERE office='$formid' AND student_name='".$_SESSION['student']."'");
        }
        echo "<script>window.history.back();</script>";
    }

    // Function to check if the previous request has been accepted (cleared)
    function isPreviousRequestAccepted($formid, $student_name) {
        global $db;
        $prevFormId = $formid - 1;
        $sql = $db->query("SELECT formStatus FROM clearance WHERE office='$prevFormId' AND student_name='$student_name'");
        if ($sql->num_rows > 0) {
            $row = $sql->fetch_array();
            return $row['formStatus'] == 1; // Return true if the previous request is cleared
        }
        return false; // Return false if there is no previous request or it's not cleared
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
            <li><a href="pending_requests.php"><i class="fa fa-hourglass-half"></i> Pending Requests</a></li>
            <li><a href="send_complaint.php"><i class="fa fa-regular fa-message"></i> Send Complaint</a></li>
        </ul>
    </section>
</aside>

<div class="content-wrapper">
    <section class="content-header">
        <h1>&nbsp;My Clearance Form </h1>
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
                                    $sql = $db->query("SELECT * FROM offices LEFT JOIN clearance ON clearance.office = offices.officeid LEFT JOIN students ON students.studentid = clearance.student_name ORDER BY officeid ASC");
                                    while ($row = $sql->fetch_array()) {
                                        $cleared = $row['formStatus'];
                                        if ($cleared == 1) {
                                            $statusButton = '<button class="btn btn-success btn-sm btn-block"><i class="fa fa-check"></i> Cleared</button>';
                                        } elseif ($cleared == 2) {
                                            $statusButton = '<button class="btn btn-danger btn-sm btn-block"><i class="fa fa-times"></i> Not Cleared</button>';
                                        } elseif ($row['sendStatus'] == 1) {
                                            $statusButton = '<button class="btn btn-warning btn-sm btn-block"><i class="fa fa-hourglass-half"></i> Pending</button>';
                                        } else {
                                            $statusButton = '<button class="btn btn-default btn-sm btn-block">Not Sent</button>';
                                        }

                                        if ($row['formStatus'] == 2 && $row['sendStatus'] == 1) {
                                            $btn = '<a href="clearance_form.php?formid=' . $row['officeid'] . '" class="btn btn-primary btn-sm btn-block"><i class="fa fa-redo"></i> Resend Request</a>';
                                        } elseif ($row['sendStatus'] == 1) {
                                            $btn = '<button class="btn btn-info btn-sm btn-block"><i class="fa fa-envelope"></i> Form Sent</button>';
                                        } else {
                                            $btn = '<a href="clearance_form.php?formid=' . $row['officeid'] . '" class="btn btn-primary btn-sm btn-block"><i class="fa fa-paper-plane"></i> Send Request</a>';
                                        }
                                        $counter++;
                                ?>
                                    <tr>
                                        <td><?php echo $counter ?></td>
                                        <td><?php echo $row['office_name']; ?></td>
                                        <td style="text-align: center;"><?php echo $statusButton; ?></td>
                                        <td><?php echo ($row['formStatus'] == 1 || $row['formStatus'] == 2) ? $row['formComments'] : ''; ?></td>
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