<?php include('header.php') ?>


<style>
/* Center the buttons inside the table cells */
.modal-body table td button {
        display: block;
        margin: 0 auto;
    }

    
    /* Style for the Student Details modal header */
    .modal-header.panel-heading {
        background-color: #337ab7;
        color: #fff;
    }

    /* Style for the Student Details modal body */
    .modal-body .student-info {
        padding: 10px;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .modal-body .student-info h4 {
        margin-top: 0;
        margin-bottom: 10px;
        font-size: 18px;
        color: #337ab7;
    }

    .modal-body .student-info p {
        margin: 0;
    }
</style>



<div class="content-wrapper">
    <section class="content-header">
        <h1>&nbsp;Graduation Clearance Requests</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 8%"></th>
                                    <!-- <th>Reg. No</th> -->
                                    <th style="width: 20%">Full Name</th>
                                    <th>Course</th>
                                    <th>Form Sent</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="width: 14%">Form Cleared</th>
                                    <th>Clearance Comments</th>
                                    <th>Form</th> <!-- New column -->
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                            $students=$db->query("SELECT * FROM clearance LEFT JOIN students ON students.studentid=clearance.student_name LEFT JOIN courses ON courses.courseid=students.studCourse WHERE clearance.office='$useroffice'");
                            while($row = $students->fetch_array()){
                                $cleared = $row['formStatus'];
                                if( $cleared==1 ){
                                    $status = 'Cleared';
                                }elseif( $cleared==2 ){
                                    $status = 'Not Cleared';
                                }else{
                                    $status = 'Pending';
                                }
                            ?>
                                <tr>
                                    <td>
                                        <?php if( $row['formStatus'] !=1 && $row['formStatus'] !=2 ){ ?>
                                        <a href="clear.php?id=<?php echo $row['formid'].'-'.$row['studentid'] ?>" style="color:orange"><i class="fa fa-pencil"></i> Clear</a>
                                        <?php } ?>
                                    </td>
                                    <!-- <td><?php echo $row['regNumber'] ?></td> -->
                                    <td><?php echo $row['surname'].' '.$row['othernames'] ?></td>
                                    <td><?php echo $row['courseCode'] ?></td>
                                    <td style="text-align: center;"><?php echo $row['sendDate'] ?> </td>
                                    <td style="text-align: center;">
                                        <?php if ($cleared == 1) { ?>
                                            <button class="btn btn-success"><i class="fa fa-check"></i></button>
                                        <?php } elseif ($cleared == 2) { ?>
                                            <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                                        <?php } else { ?>
                                            <button class="btn btn-warning"><i class="fa fa-exclamation"></i></button>
                                        <?php } ?>
                                    </td>

                                    <td style="text-align: center;"><?php echo $row['formDate'] ?></td>
                                    <td><?php echo ($row['formStatus']==1 || $row['formStatus']==2) ? $row['formComments'] : '' ?></td>
                                    <td>
                                        <a href="" data-toggle="modal" data-target="#cleared_<?php echo $row['studentid'] ?>">
                                            <?php 
                                            $rows = $db->query("SELECT * FROM clearance WHERE student_name='".$row['studentid']."'")->num_rows;
                                            echo $rows > 0 ? $rows.' Office(s)' : '';
                                            ?>
                                        </a>

                                        <!-- View Offices Cleared Modal -->
                                        <!-- View Offices Cleared Modal -->
                                        <div id="cleared_<?php echo $row['studentid'] ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content panel-success">
                                                <div class="modal-header panel-heading">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" style="text-align: center;">Student Details</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="student-info">
                                                <h4>Name of student:</h4>
                                                <p><?php echo $row['surname'] . " " . $row['othernames']; ?></p>
                                            </div>
                                            <div class="student-info">
                                                <h4>Registration Number:</h4>
                                                <p><?php echo $row['regNumber']; ?></p>
                                            </div>
                                            <div class="student-info">
                                                <h4>Course:</h4>
                                                <p><?php echo $row['courseCode']; ?></p>
                                            </div>
                                        </div>


                                                    <div class="modal-body">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>SN</th>
                                                                    <th>Office Submitted to</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $sql = $db->query("SELECT * FROM clearance LEFT JOIN offices ON officeid=office WHERE student_name='".$row['studentid']."'");
                                                                $counter = 0;
                                                                while($rowl = $sql->fetch_array()){  
                                                                    $counter++;
                                                                    $cleared = $rowl['formStatus'];
                                                                    if($cleared == 1){
                                                                        $status_button_class = 'btn-success';
                                                                        $status_icon = 'fa fa-check';
                                                                    } elseif($cleared == 2){
                                                                        $status_button_class = 'btn-danger';
                                                                        $status_icon = 'fa fa-times';
                                                                    } else{
                                                                        $status_button_class = 'btn-warning';
                                                                        $status_icon = 'fa fa-hourglass-half';
                                                                    }
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $counter; ?></td>
                                                                    <td><?php echo $rowl['office_name']; ?></td>
                                                                    <td>
                                                                        <button class="btn <?php echo $status_button_class; ?>">
                                                                            <i class="<?php echo $status_icon; ?>"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer panel-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
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
