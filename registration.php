 <?php include 'inc/header.php'; ?>
  <!-- Breadcrumbs -->
  
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="Go to Home Page" href="index.html">Home</a><span>&raquo;</span></li>
            <li><strong>Registration Page</strong></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumbs End --> 
  
  <!-- Main Container -->
  <section class="main-container col1-layout">
    <div class="main container">
      
        
        <div class="page-content">
          
            <div class="account-login">
              <?php 
                  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                  $user_name = $fm->validation($_POST['user_name']);
                  $user_email = $fm->validation($_POST['user_email']);
                  $address = $fm->validation($_POST['address']);
                  $city = $fm->validation($_POST['city']);
                  $zip = $fm->validation($_POST['zip']);
                  $country = $fm->validation($_POST['country']);
                  $phn = $fm->validation($_POST['phn']);
                  $password = $fm->validation(md5($_POST['password']));

                  $user_name = mysqli_real_escape_string($db->link, $user_name);
                  $user_email = mysqli_real_escape_string($db->link, $user_email);
                  $address = mysqli_real_escape_string($db->link, $address);
                  $city = mysqli_real_escape_string($db->link, $city);
                  $zip = mysqli_real_escape_string($db->link, $zip);
                  $country = mysqli_real_escape_string($db->link, $country);
                  $phn = mysqli_real_escape_string($db->link, $phn);
                  $password = mysqli_real_escape_string($db->link, $password);

                  if (empty($user_name) || empty($user_email) || empty($address) || empty($city) || empty($zip) || empty($country) || empty($phn) || empty($password)) {
                      echo"<div class='alert alert-danger'>Field must not be Empty!</div>";
                  }
                  else if(strlen($user_name) < 5){
                    echo"<div class='alert alert-danger'>Your Name Too much Short!!</div>";
                  }
                  else if(!preg_match("/^[a-zA-Z ]*$/",$user_name)){
                    echo"<div class='alert alert-danger'><strong>Error!</strong> UserName must only contain ulphanumirical, dashes and underscore.</div>";
                  }
                   else if(filter_var($user_email, FILTER_VALIDATE_EMAIL) == false){
                    echo"<div class='alert alert-danger'><strong>Error !</strong>Invalide Email</div>";
                  }
                  else if(strlen($phn) < 10){
                    echo"<div class='alert alert-danger'>Your Phone Number are not valid!!</div>";
                  }else{
                      $mailquery = "SELECT * FROM tbl_user WHERE user_email='$user_email' LIMIT 1";
                      $mailchk = $db->select($mailquery);
                      if($mailchk!=false){
                        echo"<div class='alert alert-danger'><strong>Error !</strong>Mail Already Exist</div>";
                      }else{
                      $query = "INSERT INTO  tbl_user(user_name, user_email, address, city, zip, country, phn, password ) VALUES('$user_name', '$user_email', '$address', '$city', '$zip', '$country', '$phn', '$password')";
                      $userinsert = $db->insert($query);

                      if ($userinsert) {
                          echo"<div class='alert alert-success'>Registration Successfully</div>";
                      }else {
                           echo"<div class='alert alert-danger'><strong>Error !</strong>Registration Not Successfully!!</div>";
                      }
                  }
                }
              }

            ?>
            <form action="" method="post">
              <div class="box-authentication">
                <h4>Registration Form</h4>
                <label for="user_name">
                  Name<span class="required">*</span>
                </label>
                <input id="user_name" name="user_name" type="text" class="form-control">

                <label for="user_email">
                  Email<span class="required">*</span>
                </label>
                <input id="user_email" name="user_email" type="text" class="form-control">

                <label for="address">
                  Address<span class="required">*</span>
                </label>
                <textarea id="address" name="address" class="form-control"></textarea>
                
               <label for="city">
                  City<span class="required">*</span>
                </label>
                <input id="city" name="city" type="text" class="form-control">

              </div>
              <div class="box-authentication">
                											
                <label for="zip">Zip-Code<span class="required">*</span></label>
                <input id="zip" name="zip" type="text" class="form-control">

                <label for="country">Country<span class="required">*</span></label>
                <input id="country" name="country" type="text" class="form-control">

                <label for="phn">Phone<span class="required">*</span></label>
                <input id="phn" name="phn" type="text" class="form-control">

                 <label for="password">Password<span class="required">*</span></label>
                <input id="password" name="password" type="password" class="form-control">


                <button class="button" type="submit"><i class="fa fa-user"></i>&nbsp; <span>Register</span></button>
                
              </div>
         </form>
        </div>
      </div>

    </div>
  </section>
  <!-- Main Container End --> 
  <!-- Footer -->
 <?php include 'inc/footer.php'; ?>