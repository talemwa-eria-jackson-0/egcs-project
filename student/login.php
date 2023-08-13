<?php include('session.php') ?>
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title><?php echo $sitename ?></title>

    <!-- Site Icons -->
    <link href="/egcs/admin/imagesicon.jpg" rel="shortcut icon" type="image/vnd.microsoft.icon" />

    <!-- Theme style -->
    <link rel="stylesheet" href="/egcs/assets/css/AdminLTE.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/egcs/assets/css/bootstrap.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/egcs/admin/css/jquery.dataTables.min.css">
    
    <!-- Site CSS -->
    <link rel="stylesheet" href="/egcs/assets/css/style.css">
    
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="/egcs/admin/css/responsive.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/egcs/admin/css/custom.css">
    
    <!-- Font-awesome CSS -->
    <link rel="stylesheet" href="/egcs/admin/css/font-awesome.min.css">

    <!-- Ion Icons CSS -->
    <link rel="stylesheet" href="/egcs/admin/css/ionicons.min.css">

    <!-- Adding a link for the kit to the font awesome icons  -->
    <script src="https://kit.fontawesome.com/f178f4ea1c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


</head>

<?php

// Set initial error value
$error = '';

// Call the database connection file

// Wait for the user to click the login button
if(isset($_POST['login']))
{
    // store the post values as variables
    $username = $_POST['username'];

    // ensure that username field is not empty
    if(empty($username))
    {
        // If any field is empty, alert an error message
        $error = "Email Field is Required";
    }else{

        // Check to ensure that the email address exists in the database
        $sql = $db->query("SELECT * FROM students WHERE studmail='$username'");

        // If there is no such username, alert an error
        if( $sql->num_rows < 1 )
        {
            $error = "This Email Address does not exist";
        }elseif( $sql->num_rows == 1 )
        {
            // Fetch the row of this record
            $row = $sql->fetch_array();

            // Store the user id in a session
            $_SESSION['student'] = $row['studentid'];

            // Redirect the user to the dashboard
            echo "<script>window.location='dashboard.php'</script>";
        }else{
            $error = "Email Address is Wrong";
        }
    }
}
?>

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>Student Login Form</b></a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg" style="color:red"><?= $error; ?></p>
                <form action="login.php" method="POST">
                    <div class="form-group has-feedback">
                        <label> Enter Student Email Address</label>
                        <input type="email" class="form-control" placeholder="Username" name="username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat" name="login">Sign In</button>
                        </div>
                    </div>
                </form><br>
            </div>
        </div>
    </body>
</html>