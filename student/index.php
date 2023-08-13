<?php
// Set initial error value
$error = '';

// Call the database connection file
include('connection.php');

// Wait for the user to click the login button
if(isset($_POST['login']))
{
    // store the post values as variables
    $username = $_POST['username'];
    $password = $_POST['password'];

    // encrypt the password
    $password = sha1($password);

    // ensure that username and password fields are not empty
    if(empty($username) || empty($password)){

        // If any field is empty, alert an error message
        $error = "All Fields are Required";
    }else{

        // Check to ensure that the username exists in the database
        $sql1 = $db->query("SELECT * FROM users WHERE Username='$username'");

        // Check to ensure that ensure that the username and the passwords match.
        $sql2 = $db->query("SELECT * FROM users WHERE Username='$username' AND Password='$password'");

        // If there is no such username, alert an error
        if( $sql1->num_rows < 1 ){
            $error = "This Username does not exist";

            // If the username does not match the password, then the password is wrong
        }elseif( $sql2->num_rows < 1 ){
            $error = "Wrong Password";

            // If the username matches the password, redirect the user to the dashboard
        }elseif( $sql2->num_rows == 1 ){

            // Fetch the row of this record
            $row = $sql2->fetch_array();

            // Start Session
            session_start();

            // Store the user id in a session
            $_SESSION['role'] = $row['Userrole'];
            $_SESSION['user'] = $row['Userid'];

            // Redirect the user to the dashboard
            if( $_SESSION['role'] !=1 ){
                header('location:profile.php');
            }else{
                header('location:dashboard.php');
            }  
        }else{
            $error = "Username or Password is Wrong";
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>EGCS | Log in</title>
        
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        
        <!-- Theme style -->
        <link rel="stylesheet" href="css/AdminLTE.min.css">
        
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>User Login Form</b></a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg" style="color:red"><?= $error; ?></p>
                <form action="index.php" method="POST">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Username" name="username" autocomplete="off">
                        <span class="fa fa-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <span class="fa fa-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat" name="login">Sign In</button>
                        </div>
                    </div>
                </form><br>
            </div>
        </div>
    </body>
</html>