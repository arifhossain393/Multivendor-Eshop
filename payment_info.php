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
        <div class="page-content checkout-page"><div class="page-title">
          <h2>Checkout</h2>
        </div>
            <h4 class="checkout-sep">1. Billing Infomations</h4>
            <h4 class="checkout-sep">2. Shipping Information</h4>
            <h4 class="checkout-sep">3. Payment Information</h4>
            <div class="box-border">
              <?php
                if (isset($_POST["paymentbtn"])) {
                  if (isset($_POST["payment"])) {
                  $answer = $_POST['payment'];
                     if($answer == "bkash") {
                         echo "<script>window.location='bkashpayment.php';</script>";
                     }    
                   elseif($answer == "dbbl"){
                     echo "<script>window.location='dbbl.php';</script>";
                  }
                }
              }
            ?>
              <form action="" method="post">
                <ul>
                    <li>
                        <label for="radio_button_6"><input type="radio" name="payment" id="radio_button_6" value="bkash">bKash</label>
                    </li>
                     <li>
                        <label for="radio_button_6"><input type="radio" name="payment" id="radio_button_6" value="dbbl">DBBL</label>
                    </li>

                  <button class="button" name="paymentbtn" type="submit"><i class="fa fa-angle-double-right"></i>&nbsp; <span>Continue</span></button>
                </ul>
               </form> 
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