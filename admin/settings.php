<?php 
include('header.php');
$setting = $db->query("SELECT * FROM settings")->fetch_array();
$msg = "";
$msg_class = "";

// when submit button is clicked
if(isset($_POST['save_data']))
{
    // get the settings id
    $id = $_POST['id'];

    //General Settings
    $name = $_POST['name'];
    $sname = $_POST['shortname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $fax = $_POST['fax'];
    $footer_text = $_POST['footer_text'];

    // Get image name
    $image_name = time().'-'.$_FILES["logo"]["name"];

    // For image upload
    $target_dir = "uploads/";
    $target_file = $target_dir.basename($image_name);

    // validate image size. Size is calculated in Bytes
    if($_FILES['logo']['size'] > 2000000) 
    {
        $msg = "Image size should not be greated than 2MB";
        $msg_class = "alert-danger";
    }

    // Upload image only if no errors
    if (empty($error)) {
        if(move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) 
        {
            $sql = $db->query("UPDATE settings SET logo='$image_name' WHERE id='$id'");
            if($sql){
                $msg = "Image uploaded and saved in the Database";
                $msg_class = "alert-success";
            } else {
                $msg = "There was an error in the database";
                $msg_class = "alert-danger";
            }
        } else {
            $error = "There was an erro uploading the file";
            $msg = "alert-danger";
        }
    }

    //Social Media Settings
    $facebook_link = $_POST['facebook_link'];
    $twitter_link = $_POST['twitter_link'];
    $google_plus_link = $_POST['google_plus_link'];
    $whatsapp_link = $_POST['whatsapp_link'];
    $linkedin_link = $_POST['linkedin_link'];
    $instagram_link = $_POST['instagram_link'];

    //Update query
    $query = $db->query("UPDATE settings SET name='$name', shortname='$sname', address='$address', email='$email', phone='$phone', fax='$fax', footer_text='$footer_text', facebook_link='$facebook_link', twitter_link='$twitter_link', google_plus_link='$google_plus_link', whatsapp_link='$whatsapp_link', linkedin_link='$linkedin_link', instagram_link='$instagram_link'");
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>&nbsp;Website Settings </h1>
    </section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <form method="post" enctype="multipart/form-data" action="settings.php">  
                        <input type="hidden" name="id" value="<?php echo $setting['id'] ?>" />
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#general" aria-controls="home" role="tab" data-toggle="tab">General Settings</a>
                            </li>
                            <li role="presentation">
                                <a href="#social" aria-controls="profile" role="tab" data-toggle="tab">Social Settings</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="general">
                                <h3></h3>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-sm-4">Site Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="name" class="form-control" value="<?php echo $setting['name'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="col-sm-4">Site Abbeviation</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="shortname" class="form-control" value="<?php echo $setting['shortname'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="col-sm-4">Site Logo</label>
                                        <div class="col-sm-8">
                                            <input type="file" name="logo" class="form-control" />
                                            <input type="hidden" name="old_logo" value="<?php echo $setting['logo'];?>" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-sm-4">
                                        <?php if(!empty($setting['logo'])){?>
                                        <img src="images/<?php echo $setting['logo'] ?>" height="70" width="90" />
                                        <?php }?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="col-sm-4">Site Address</label>
                                        <div class="col-sm-8">
                                            <textarea name="address" class="form-control"><?php echo $setting['address']?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="col-sm-4">Site Email</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="email" class="form-control" value="<?php echo $setting['email'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="col-sm-4">Phone Number</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="phone" class="form-control" value="<?php echo $setting['phone'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="col-sm-4">Fax Mail</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="fax" class="form-control" value="<?php echo $setting['fax'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="col-sm-4">Footer Text</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="footer_text" class="form-control" value="<?php echo $setting['footer_text'] ?>">
                                        </div> 
                                    </div>        
                                </div>
                            </div>
                            <!-- /. General settings -->

                            <!-- Social Media settings -->
                            <div role="tabpanel" class="tab-pane" id="social">
                                <h3></h3>
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label class="col-sm-3">Facebook Link</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="facebook_link" value="<?php echo $setting['facebook_link'] ?>" class="form-control" />
                                            
                                        </div>
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label class="col-sm-3">Twitter</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="twitter_link" value="<?php echo $setting['twitter_link'] ?>" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label class="col-sm-3">Google Plus</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="google_plus_link" value="<?php echo $setting['google_plus_link'] ?>" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label class="col-sm-3">Linkdin</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="linkedin_link" value="<?php echo $setting['linkedin_link'] ?>" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label class="col-sm-3">WhatsApp</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="whatsapp_link" value="<?php echo $setting['whatsapp_link'] ?>" class="form-control" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-md-8">
                                        <label class="col-sm-3">Instagram</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="instagram_link" value="<?php echo $setting['instagram_link'] ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <input class="btn btn-primary" name="save_data" type="submit" value="Save"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('footer.php') ?>