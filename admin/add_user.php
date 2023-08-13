<?php include('header.php') ?>

<?php
$fullname = '';
$role = '';
$status = '';
$userphone = '';
$usermail = '';
$username = '';
$position = '';
$password = '';
$text1 = 'text';
$text2 = 'password';
$label1 = 'Username';
$label2 = 'Password';

$id = '';

$title = 'Add New User';

// check if there is an edit id
if(!empty($_GET['id']))
{
    // get the edit id
    $id = $_GET['id'];

    // get details of the user to update
    $user = $db->query("SELECT * FROM users WHERE Userid='$id'")->fetch_array();

    $fullname = $user['Fullname'];
    $role = $user['Userrole'];
    $status = $user['User_status'];
    $position = $user['Position'];
    $userphone = $user['Userphone'];
    $usermail = $user['Usermail'];
    $username = $user['Username'];

    // reset the form title and other dynamic variables
    $title = "Update User Data";
    $text1 = 'hidden';
    $text2 = 'hidden';
    $label1 = '';
    $label2 = '';
}

// when the save button is clicked
if(isset($_POST['save']))
{
    // get the form values
    $fullname = $_POST['fullname'];
    $role = $_POST['user_role'];
    $status = $_POST['status'];
    $adminid = $_SESSION['user'];
    $idname = $_POST['idname'];
    $userphone = $_POST['userphone'];
    $position = $_POST['position'];
    $usermail = $_POST['usermail'];
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $userdate = date('d-m-Y');

    // If there is edit key, insert
    if(empty($_POST['idname']))
    {  
        // ensure that phone number is only 10 digits
        if( strlen($userphone) !=10 )
        {
            $error = "Phone number should be 10 characters";
        }

        // ensure username and password are both filled
        elseif(empty($username) || empty($_POST['password']))
        {
            $error = "Username or Password cannot be empty";
        } else{
            // Insert the records
            $db->query("INSERT INTO users (Username, Password, Fullname, Userphone, Usermail, Position, Userrole, User_status) VALUES ('$username', '$password', '$fullname', '$userphone', '$usermail', '$position', '$role', '$status')");
            echo "<script>window.location='users.php';</script>";
        }
    }else{
        if( strlen($userphone) !=10 )
        {
            $id = $_POST['idname'];
            $error = "Phone number should be 10 characters";
        } else{
            $db->query("UPDATE users SET Fullname='$fullname', Userphone='$userphone', Usermail='$usermail', Userrole='$role', Position='$position', User_status='$status' WHERE Userid='$idname'") or die($db->error);
            echo "<script>window.location='users.php';</script>";
        }
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>&nbsp;<?php echo $title ?></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <span style="color: red"><?php if(isset($error)){ echo $error; } ?></span>
                <div class="box box-primary">
                    <form role="form" method="POST" action="add_user.php">
                        <div class="box-body">
                            <input type="hidden" name="idname" value="<?php echo $id ?>">
                            <div class="form-group col-md-6">
                                <label>Fullname</label>
                                <input type="text" name="fullname" class="form-control" value="<?php echo $fullname ?>" autocomplete="off" required="required">
                            </div>
                            <div class="form-group col-md-6">
                                <label>User Position</label>
                                <select name="position" class="form-control col-md-6" required="required">
                                    <option value=""></option>
                                <?php
                                while($row = $offices->fetch_array()){
                                    echo "<option value='".$row['officeid']."'";
                                    if($position==$row['officeid']) echo 'selected';
                                    echo ">".$row['office_name']."</option>";
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>User Role</label>
                                <select name="user_role" class="form-control col-md-6">
                                    <option value=""></option>
                                <?php
                                $roles=['1'=>'Admin User', '2'=>'Standard User'];
                                foreach($roles as $key=>$value){
                                    echo "<option value='".$key."'";
                                    if($role==$key) echo 'selected';
                                    echo ">".$value."</option>";
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>User Status</label>
                                <select name="status" class="form-control col-md-6">
                                    <option value=""></option>
                                <?php
                                $ustatus = ['1'=>'Active', '2'=>'In Active'];
                                foreach($ustatus as $key=>$value){
                                    echo "<option value='".$key."'";
                                    if($status==$key) echo 'selected';
                                    echo ">".$value."</option>";
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Phone Number</label>
                                <input type="text" name="userphone" class="form-control" value="<?php echo $userphone ?>" autocomplete="off" onkeyup="this.value=this.value.replace(/[^\d\d]+/g, '');">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email Address</label>
                                <input type="text" name="usermail" class="form-control" value="<?php echo $usermail ?>" autocomplete="off" required="required">
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label><?php echo $label1 ?></label>
                                <input type="<?php echo $text1 ?>" name="username" class="form-control" value="<?php echo $username ?>" autocomplete="off">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $label2 ?></label>
                                <input type="<?php echo $text2 ?>" name="password" class="form-control" value="<?php echo $password ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="save" class="btn btn-primary col-md-12">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('footer.php') ?>