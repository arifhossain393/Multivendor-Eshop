<?php include 'inc/header.php'; ?>
<?php
    $login = Session::get("cuslogin");
    if ($login == false) {
        echo "<script>window.location='login.php';</script>";
    }

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
        <?php 
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          
          $name = $fm->validation($_POST['name']);
          $email = $fm->validation($_POST['email']);
          $address = $fm->validation($_POST['address']);
          $city = $fm->validation($_POST['city']);
          $zip = $fm->validation($_POST['zip']);
          $country = $fm->validation($_POST['country']);
          $phone = $fm->validation($_POST['phone']);
         
          $cmrId =Session::get('cmrId');
          $name = mysqli_real_escape_string($db->link, $name);
          $email = mysqli_real_escape_string($db->link, $email);
          $address = mysqli_real_escape_string($db->link, $address);
          $city = mysqli_real_escape_string($db->link, $city);
          $zip = mysqli_real_escape_string($db->link, $zip);
          $country = mysqli_real_escape_string($db->link, $country);
          $phone = mysqli_real_escape_string($db->link, $phone);
          

          if (empty($name) || empty($email) || empty($address) || empty($city) || empty($zip) || empty($country) || empty($phone)) {
              echo"<div class='alert alert-danger'><strong>Error!</strong>Field must not be Empty!</div>";
          }else if(strlen($name) < 5){
                    echo"<div class='alert alert-danger'>Your Name Too much Short!!</div>";
                  }
                  else if(!preg_match("/^[a-zA-Z ]*$/",$name)){
                    echo"<div class='alert alert-danger'><strong>Error!</strong> UserName must only contain ulphanumirical, dashes and underscore.</div>";
                  }
                   else if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
                    echo"<div class='alert alert-danger'><strong>Error !</strong>Invalide Email</div>";
                  }
                  else if(strlen($phone) < 10){
                    echo"<div class='alert alert-danger'>Your Phone Number are not valid!!</div>";
                  }else{

              $query = "INSERT INTO  tbl_shipping(cmr_id, name, email, city, zip, address, country, phone) VALUES('$cmrId', '$name', '$email', '$city', '$zip', '$address', '$country', '$phone')";
              $userinsert = $db->insert($query);

              if ($userinsert) {
                  echo "<script>window.location='payment_info.php';</script>";
              }else {
                   echo "<script>window.location='shipping_info.php';</script>";
              }
        }
      }

    ?>
        
        <div class="page-content checkout-page"><div class="page-title">
          <h2>Checkout</h2>
        </div>
            <h4 class="checkout-sep">1. Billing Infomations</h4>
            <h4 class="checkout-sep">2. Shipping Information</h4>
            <div class="box-border">
                <form action="" method="post">
                <ul>
                    <li class="row">
                        <div class="col-sm-6">
                            <label for="user_name" class="required">Name</label>
                            <input type="text" class="input form-control" name="name" id="user_name" value="">
                        </div><!--/ [col] -->
                        <div class="col-sm-6">
                            <label for="user_email" class="required">Email</label>
                            <input type="email" name="email" class="input form-control" id="user_email" value="">
                        </div><!--/ [col] -->
                    </li><!--/ .row -->
                    <li class="row">
                        <div class="col-sm-6">
                            <label for="city">City</label>
                            <input type="text" name="city" class="input form-control" id="city" value="">
                        </div><!--/ [col] -->
                        <div class="col-sm-6">
                            <label for="zip" class="required">Zip Code</label>
                            <input type="text" class="input form-control" name="zip" id="zip" value="">
                        </div><!--/ [col] -->
                    </li><!--/ .row -->
                    <li class="row"> 
                        <div class="col-sm-6">

                            <label for="address" class="required">Address</label>
                            <textarea  class="input form-control" name="address" id="address"></textarea>

                        </div><!--/ [col] -->
                        <div class="col-sm-6">

                            <label for="country" class="required">Country</label>
                            <input type="text" class="input form-control" name="country" id="country" value="">

                        </div><!--/ [col] -->

                    </li><!-- / .row -->

                    <li class="row">

                        <div class="col-sm-6">
                            
                            <label for="phn" class="required">Phone</label>
                            <input class="input form-control" type="text" name="phone" id="phn" value="">

                        </div><!--/ [col] -->

                    </li><!--/ .row -->

                    <li>
                        <button class="button" type="submit"><i class="fa fa-angle-double-right"></i>&nbsp; <span>Continue</span></button>
                    </li>
                </ul>
                </form>
                
            </div>
            <h4 class="checkout-sep">3. Payment Information</h4>
            <div class="box-border" style="display:none;">
                <ul>
                    <li>
                        <label for="radio_button_5"><input type="radio" checked name="radio_4" id="radio_button_5"> Check / Money order</label>
                    </li>

                    <li>
            
                        <label for="radio_button_6"><input type="radio" name="radio_4" id="radio_button_6"> Credit card (saved)</label>
                    </li>

                </ul>
                <button class="button"><i class="fa fa-angle-double-right"></i>&nbsp; <span>Continue</span></button>
            </div>
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