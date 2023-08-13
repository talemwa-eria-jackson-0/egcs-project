<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <?php if( $userrole !='1'){ ?>
            <li><a href="profile.php"><i class="fa fa-user"></i> Profile</a></li>
            <?php } ?>
            <?php if( $userrole=='1'){ ?>
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="courses.php"><i class="fa fa-pencil"></i> Courses</a></li>
            <?php } ?>
            <li><a href="students.php"><i class="ion ion-university"></i> Graduands</a></li>
            <?php if($userrole=='1'){ ?>
            <li><a href="offices.php"><i class="fa fa-building"></i> Clearance Offices</a></li>
            <?php } ?>
            <li><a href="clearance_requests.php"><i class="fa fa-files-o"></i> Clearance Requests</a></li>
            <?php if( $userrole=='1'){ ?>
            <li><a href="forms.php"><i class="fa fa-files-o"></i> Clearance Forms</a></li>
            <?php } ?>
            <?php if($userrole=='1'){ ?>
            <li><a href="users.php"><i class="fa fa-user-plus"></i> Users</a></li>
            <?php } ?>
        </ul>
    </section>
</aside>