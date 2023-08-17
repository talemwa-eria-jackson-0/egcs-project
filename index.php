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
    <link href="admin/imagesicon.jpg" rel="shortcut icon" type="image/vnd.microsoft.icon" />

    <!-- Theme style -->
    <link rel="stylesheet" href="assets/css/AdminLTE.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="admin/css/jquery.dataTables.min.css">
    
    <!-- Site CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="admin/css/responsive.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="admin/css/custom.css">
    
    <!-- Font-awesome CSS -->
    <link rel="stylesheet" href="admin/css/font-awesome.min.css">

    <!-- Ion Icons CSS -->
    <link rel="stylesheet" href="admin/css/ionicons.min.css">

    <!-- Adding a link for the kit to the font awesome icons  -->
    <script src="https://kit.fontawesome.com/f178f4ea1c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

 <!-- my custom css  -->
    <link rel="stylesheet" href="css-custom/style.css">

    <style>
body {
  /* Set the background image for the whole page */
  background-image: url('muni-school.jpeg');
  background-size: cover;
  background-position: center;
  position: relative;
  height: 100vh; /* full viewport height */
  margin: 0;
  padding: 0;
}

.overlay {
  /* Create a full-page overlay with opacity */
  background-color: rgba(0, 0, 0, 0.8); /* Black overlay with 50% opacity */
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.img-opacity {
  opacity: 0.9;
}

.text-blue {
  color: blue;
}

</style>

</head>

<body>
  <div class="overlay"></div>
    <!-- inserting tje university logo  -->
    <div class="container d-flex justify-content-center">
        <div class="m-5">
            <img src="admin/images/muni-logo.png" alt="University Logo" class="shadow-lg rounded img-opacity">
        </div>
    </div>

    <hr>

    <div class="container d-flex justify-content-center">
        <h1 class="display-3 text-gray">ELECTRONIC GRADUATION CLEARANCE SYSTEM</h1>
    </div>

    <div class="my-3 ml-5 d-flex justify-content-center">
        <div>
            <p class="fa fa-user fw-extrabold text-blue display-4 d-none">&nbsp; LOGIN TO THE SYSTEM</p>
        </div>
    </div>


<div class="container">
  <div class="row">
    <div class="col-md-4">
    <div>
        <button class="btn btn-secondary">Login</button>
        <a href="student/login.php"><button type="button" class="btn btn-outline-primary mt-2 mb-2">As A Student</button></a>
      </div>
    </div>
    <div class="col-md-4">
      <div>
        <button class="btn btn-secondary">Login</button>
        <a href="admin/index.php"><button type="button" class="btn btn-outline-primary mt-2 mb-2">As A Departmental Head</button></a>
      </div>
    </div>
    <div class="col-md-4">
      <div>
        <button class="btn btn-secondary">Login:</button>
        <a href="admin/index.php"><button type="button" class="btn btn-outline-primary mt-2 mb-2">As An Admin</button></a>
      </div>
    </div>
  </div>
</div>

</body>