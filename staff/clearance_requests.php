<?php include('header.php') ?>

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
                                    <th>Reg. No</th>
                                    <th>Full Name</th>
                                    <th>Course</th>
                                    <th>Form Sent On</th>
                                    <th>Clearance Status</th>
                                    <th>Clearance Date</th>
                                    <th>Clearance Comments</th>
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
                                    <td><?php echo $row['regNumber'] ?></td>
                                    <td><?php echo $row['surname'].' '.$row['othernames'] ?></td>
                                    <td><?php echo $row['courseCode'] ?></td>
                                    <td><?php echo $row['sendDate'] ?> </td>
                                    <td><?php echo $status ?></td>
                                    <td><?php echo $row['formDate'] ?></td>
                                    <td><?php echo ($row['formStatus']==1 || $row['formStatus']==2) ? $row['formComments'] : '' ?></td>
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