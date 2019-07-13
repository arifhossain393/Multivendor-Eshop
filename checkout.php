<?php include 'inc/header.php'; ?>
<?php
    $login = Session::get("cuslogin");
    if ($login == false) {
        echo "<script>window.location='login.php';</script>";
    }

 ?>
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
           
            <li><strong>Checkout</strong></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumbs End --> 
  
<!-- Main Container -->
<section class="main-container col2-right-layout">
  <div class="main container">
    <div class="row">
      <div class="col-main col-sm-9 col-xs-12">
 
        
        <div class="page-content checkout-page"><div class="page-title">
          <h2>Checkout</h2>
        </div>
            <h4 class="checkout-sep">1. Billing Infomations</h4>
            <div class="box-border">
            <?php 
              if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                  $user_name = $fm->validation($_POST['user_name']);
                  $user_email = $fm->validation($_POST['user_email']);
                  $address = $fm->validation($_POST['address']);
                  $city = $fm->validation($_POST['city']);
                  $zip = $fm->validation($_POST['zip']);
                  $country = $fm->validation($_POST['country']);
                  $phn = $fm->validation($_POST['phn']);

                  $user_name = mysqli_real_escape_string($db->link, $user_name);
                  $user_email = mysqli_real_escape_string($db->link, $user_email);
                  $address = mysqli_real_escape_string($db->link, $address);
                  $city = mysqli_real_escape_string($db->link, $city);
                  $zip = mysqli_real_escape_string($db->link, $zip);
                  $country = mysqli_real_escape_string($db->link, $country);
                  $phn = mysqli_real_escape_string($db->link, $phn);
                  
                if (empty($user_name) || empty($user_email) || empty($address) || empty($city) || empty($zip) || empty($country) || empty($phn)) {
                    echo"<span style='color:red;'>Field must not be Empty!</span>";
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
                    $query = "UPDATE tbl_user
                        SET
                         user_name = '$user_name',
                         user_email = '$user_email',
                         address = '$address',
                         city = '$city',
                         zip = '$zip',
                         country = '$country',
                         phn = '$phn'
                        WHERE id ='$cmrId'";
                    $update_user = $db->update($query);

                    if ($update_user) {
                        echo "<script>window.location='shipping_info.php';</script>";
                    }else {
                        echo "<script>window.location='checkout.php';</script>";
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
                <ul>
                    <li class="row">
                        <div class="col-sm-6">
                            <label for="user_name" class="required">Name</label>
                            <input type="text" class="input form-control" name="user_name" id="user_name" value="<?php echo $result['user_name']; ?>">
                        </div><!--/ [col] -->
                        <div class="col-sm-6">
                            <label for="user_email" class="required">Email</label>
                            <input type="email" name="user_email" class="input form-control" id="user_email" value="<?php echo $result['user_email']; ?>">
                        </div><!--/ [col] -->
                    </li><!--/ .row -->
                    <li class="row">
                        <div class="col-sm-6">
                            <label for="city">City</label>
                            <input type="text" name="city" class="input form-control" id="city" value="<?php echo $result['city']; ?>">
                        </div><!--/ [col] -->
                        <div class="col-sm-6">
                            <label for="zip" class="required">Zip</label>
                            <input type="text" class="input form-control" name="zip" id="zip" value="<?php echo $result['zip']; ?>">
                        </div><!--/ [col] -->
                    </li><!--/ .row -->
                    <li class="row"> 
                        <div class="col-sm-6">

                            <label for="address" class="required">Address</label>
                            <textarea  class="input form-control" name="address" id="address"><?php echo $result['address']; ?></textarea>

                        </div><!--/ [col] -->
                        <div class="col-sm-6">

                            <label for="country" class="required">Country</label>
                            <input type="text" class="input form-control" name="country" id="country" value="<?php echo $result['country']; ?>">

                        </div><!--/ [col] -->

                    </li><!-- / .row -->

                    <li class="row">

                        <div class="col-sm-6">
                            
                            <label for="phn" class="required">Phone</label>
                            <input class="input form-control" type="text" name="phn" id="phn" value="<?php echo $result['phn']; ?>">

                        </div><!--/ [col] -->

                    </li><!--/ .row -->

                    <li>
                        <button class="button" type="submit"><i class="fa fa-angle-double-right"></i>&nbsp; <span>Continue</span></button>
                    </li>
                </ul>
                </form>
                <?php } } ?>
            </div>
            <h4 class="checkout-sep">2. Shipping Information</h4>
            <h4 class="checkout-sep">3. Payment Information</h4>
        </div>
      </div>
      <aside class="right sidebar col-sm-3 col-xs-12">
        <div class="sidebar-checkout block">
         <div class="sidebar-bar-title">
              <h3>Your Checkout</h3>
            </div>
        <div class="block-content">
        <?php
              $sId = session_id();
              $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
              $cartpro = $db->select($query);
              if ($cartpro) {
                 $qun = 0;
                $sum = 0;
                  while ($result = $cartpro->fetch_assoc()) {

             ?>
            <dl>
              <dt class="complete"><?php echo $result['ProName']; ?></dt>
              <dd class="complete">
                <span class="price">৳ <?php echo $result['price']; ?> <span>X</span>
                    <?php echo $result['quantity']; ?> = ৳ <?php
                       $total = $result['price'] * $result['quantity']; 
                       echo $total;
                       ?>
                </span> </dd>
                
            </dl>
            <?php
              $sum = $sum + $total;
              Session::set("sum", $sum);

            ?>
            <?php } } ?>
            <hr>
            <?php
                      $sId = session_id();
                      $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
                      $cartpro = $db->select($query);
                      if ($cartpro) {
                    ?>
                  <tfoot>
                    <tr>
                      <td colspan="2" rowspan="2"></td>
                      <td colspan="3">Tax 5%</td>
                      <td colspan="3"> = </td>
                      <td colspan="2"><?php
                        $vat = $sum * 0.05;
                        echo $vat;
                       ?></td>
                    </tr>
                    <br>
                    <tr>
                      <td colspan="3"><strong>Total</strong></td>
                      <td colspan="3"><strong> = </strong></td>
                      <td colspan="2"><strong><?php
                        $total = $sum + $vat;
                        echo $total;
                       ?></strong></td>
                    </tr>
                  </tfoot>
                  <?php } ?>
          </div>

        </div>
        </aside>
    </div>
  </div>
  </section>
  <!-- Main Container End -->
  <!-- Footer -->
  <?php include 'inc/footer.php'; ?>