 <?php include 'inc/header.php'; ?>
 <?php
    $cmrId =Session::get('cmrId');

?>
  <!-- Breadcrumbs -->
  
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="Go to Home Page" href="index.html">Home</a><span>&raquo;</span></li>
            <li><strong>Profile Update</strong></li>
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
                    echo"<span style='color:red;'>Field must not be Empty!</span>";
                }else{
                    $query = "UPDATE tbl_user
                        SET
                         user_name = '$user_name',
                         user_email = '$user_email',
                         address = '$address',
                         city = '$city',
                         zip = '$zip',
                         country = '$country',
                         phn = '$phn',
                         password = '$password'
                        WHERE id ='$cmrId'";
                    $update_user = $db->update($query);

                    if ($update_user) {
                        echo"<span style='color:green;'>User Update Successfully</span>";
                    }else {
                         echo"<span style='color:red;'>User not Update</span>";
                    }
                }
              }
            ?>
            
            <?php
              $query = "SELECT * FROM tbl_user WHERE id ='$cmrId'";
              $getuser = $db->select($query);
              if ($getuser) {
                   while ($result = $getuser->fetch_assoc()) {

             ?>
            <form action="" method="post">
              <div class="box-authentication">
                <h4>Registration Form</h4>
                <label for="user_name">
                  Name<span class="required"></span>
                </label>
                <input id="user_name" name="user_name" type="text" value="<?php echo $result['user_name']; ?>" class="form-control">

                <label for="user_email">
                  Email<span class="required"></span>
                </label>
                <input id="user_email" name="user_email" value="<?php echo $result['user_email']; ?>" type="text" class="form-control">

                <label for="address">
                  Address<span class="required"></span>
                </label>
                <textarea id="address" name="address" class="form-control"><?php echo $result['address']; ?></textarea>
                
               <label for="city">
                  City<span class="required"></span>
                </label>
                <input id="city" name="city" value="<?php echo $result['city']; ?>" type="text" class="form-control">

              </div>
              <div class="box-authentication">
                											
                <label for="zip">Zip-Code<span class="required">*</span></label>
                <input id="zip" name="zip" value="<?php echo $result['zip']; ?>" type="text" class="form-control">

                <label for="country">Country<span class="required">*</span></label>
                <input id="country" name="country" value="<?php echo $result['country']; ?>" type="text" class="form-control">

                <label for="phn">Phone<span class="required"></span></label>
                <input id="phn" name="phn" value="<?php echo $result['phn']; ?>" type="text" class="form-control">

                 <label for="password">Password<span class="required">*</span></label>
                <input id="password" name="password" type="password" class="form-control">


                <button class="button" type="submit"><i class="fa fa-user"></i>&nbsp; <span>Update</span></button>
                
              </div>
         </form>
         <?php } } ?>
        </div>
      </div>

    </div>
  </section>
  <!-- Main Container End --> 
  <!-- Footer -->
 <?php include 'inc/footer.php'; ?>