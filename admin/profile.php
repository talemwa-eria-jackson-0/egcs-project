<?php include('header.php') ?>

<?php
$error = '';

// Wait for the user to click the update profile button
if(isset($_POST['update']))
{
    // Get the input values
    $fullname = $_POST['Fullname'];
    $phone = $_POST['Userphone'];
    $mail = $_POST['Usermail'];
    $uname = $_POST['Username'];

    // Update the user profile
    $db->query("UPDATE users SET Fullname='$fullname', Userphone='$phone', Usermail='$mail', Username='$uname' WHERE Userid='".$_SESSION['user']."'");
}

// Change User password
if(isset($_POST['reset']))
{
    $oldPassword = $_POST['password1'];
    $newPassword = $_POST['password2'];

    //Encrypt the passwords
    $pwd1 = sha1($oldPassword);
    $pwd2 = sha1($newPassword);

    // Check to see if the old password matches what is stored
    $sql=$db->query("SELECT Password FROM users WHERE Userid='".$_SESSION['user']."'")->fetch_array();

    // If the old password is correct, reset the password
    if($sql['password']==$pwd1){
        $db->query("UPDATE users SET Password='$pwd2' WHERE Userid='".$_SESSION['user']."'");
        $error = "Your Password has been changed";
    }else{
        // If no match, return an error
        $error = 'Wrong Password';
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <form role="form" action="profile.php" method="POST">
                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label>Full name</label>
                                <input type="text" class="form-control" name="Fullname" value="<?php echo $fullname ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>User Position</label>
                                <input type="text" class="form-control" name="Position" value="<?php echo $position ?>" readonly>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>Mobile Phone</label>
                                <input type="text" class="form-control" name="Userphone" value="<?php echo $userphone ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email Address</label>
                                <input type="email" class="form-control" name="Usermail" value="<?php echo $usermail ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Username</label>
                                <input type="text" class="form-control" required="required" name="Username" value="<?php echo $username ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>User Role</label>
                                <input type="text" class="form-control" name="Userrole" value="<?php echo $userrole=='1' ? 'Admin User' : 'Standard User'?>" readonly>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" name="update" class="btn btn-primary col-md-12">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-primary">
                    <span style="color: red"><?php echo $error; ?></span>
                    <form role="form" method="POST" action="profile.php">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Old Password</label>
                                <input type="password" name="password1" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="Password" name="password2" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="reset" class="btn btn-primary col-md-12">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('footer.php') ?>