<?php include('header.php') ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>&nbsp;Graduation Clearance Report</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Reg. No</th>
                                    <th>Full Name</th>
                                    <th>ID Number</th>
                                    <th>Email Address</th>
                                    <th>Mobile Phone</th>
                                    <th>Course</th>
                                    <th>Year</th>
                                    <th>Offices Submitted</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $students=$db->query("SELECT * FROM students LEFT JOIN clearance ON students.studentid=clearance.student_name LEFT JOIN courses ON courses.courseid=students.studCourse Group by students.studentid");
                            while($row = $students->fetch_array()){
                            ?>
                                <tr>                                    <td><?php echo $row['regNumber'] ?></td>
                                    <td><?php echo $row['surname'].' '.$row['othernames'] ?></td>
                                    <td><?php echo $row['iDNumber'] ?></td>
                                    <td><?php echo $row['studmail'] ?> </td>
                                    <td><?php echo $row['studPhone'] ?></td>
                                    <td><?php echo $row['courseCode'] ?></td>
                                    <td><?php echo $row['joinYear'] ?></td>
                                    <td>
<a href="" data-toggle="modal" data-target="#cleared_<?php echo $row['studentid'] ?>"><?php $rows = $db->query("SELECT * FROM clearance WHERE student_name='".$row['studentid']."'")->num_rows; echo $rows > 0 ? $rows.' Office(s)' : '' ?></a>

<!-- View Offices Cleared Modal -->
<div id="cleared_<?php echo $row['studentid'] ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content panel-success">
            <div class="modal-header panel-heading">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center;">Offices Requested for Clearance by [<?php echo $row['surname']." ".$row['othernames'] ?>]</h4>
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
                        <?php $sql = $db->query("SELECT * FROM clearance LEFT JOIN offices ON officeid=office WHERE student_name='".$row['studentid']."'");
                        $counter = 0;
                        while( $rowl = $sql->fetch_array()){  
                            $counter ++;
                            $cleared = $rowl['formStatus'];
                            if( $cleared==1 ){
                                $status = 'Cleared';
                            }elseif( $cleared==2 ){
                                $status = 'Not Cleared';
                            }else{
                                $status = 'Pending';
                            }
                        ?>
                        <tr>
                            <td><?php echo $counter; ?></td>
                            <td><?php echo $rowl['office_name']; ?></td>
                            <td><?php echo $status; ?></td>
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