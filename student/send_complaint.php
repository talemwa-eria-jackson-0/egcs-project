<?php
// Include the database connection file
include('connection.php');

// SQL query to select the desired columns from the 'users' table
$query = "SELECT u.Userid, u.Fullname, u.Userphone, u.Usermail, o.office_name 
          FROM users u
          INNER JOIN offices o ON u.position = o.officeid";

// Execute the query
$result = $db->query($query);

// Initialize a counter
$counter = 0;
?>
<?php include 'header.php' ?>

<aside class="main-sidebar">
    <!-- Sidebar content here -->
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <br>
            <li><a href="dashboard.php"><i class="fa fa-gauge"></i> Dashboard</a></li>
            <li><a href="profile.php"><i class="fa fa-user"></i> Personal Information</a></li>
            <li><a href="clearance_form.php"><i class="fa fa-laptop"></i> Clearance Form</a></li>
            <li><a href="accepted_requests.php"><i class="fa fa-regular fa-thumbs-up"></i> Accepted Requests</a></li>
            <li><a href="rejected_requests.php"><i class="fa fa-regular fa-thumbs-down"></i> Rejected Requests</a></li>
            <li class="active"><a href="send_complaint.php"><i class="fa fa-regular fa-message"></i> Send Complaint</a></li>
        </ul>
    </section>
</aside>

<div class="content-wrapper">
    <section class="content-header">
        <h1>&nbsp;Contact A Department Head
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
                                    <th style="width: 5%">#</th>
                                    <th style="width: 25%">Full Name</th>
                                    <th style="width: 15%; text-align: center;">Phone</th>
                                    <th style="width: 20%; text-align: center;">Email</th>
                                    <th style="width: 35%">Office Headed</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Loop through the result and display data in the table
                                while ($row = $result->fetch_assoc()) {
                                    $counter++;
                                    echo '<tr>';
                                    echo '<td>' . $counter . '</td>';
                                    echo '<td>' . $row['Fullname'] . '</td>';
                                    echo '<td style="text-align: center;">' . $row['Userphone'] . '</td>';
                                    echo '<td style="text-align: center;">
                                            <form action="https://mail.google.com/mail/" method="get" target="_blank">
                                                <input type="hidden" name="view" value="cm">
                                                <input type="hidden" name="to" value="' . $row['Usermail'] . '">
                                                <input type="submit" value="Send Email" class="btn btn-primary">
                                            </form>
                                        </td>';
                                    echo '<td>' . $row['office_name'] . '</td>';
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

<?php include 'footer.php' ?>

<?php
// Close the database connection
$db->close();
?>
