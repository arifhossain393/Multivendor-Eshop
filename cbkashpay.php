<?php include 'inc/header.php'; ?>
<?php
    
    $cmrId = Session::get("cmrId");
    $login = Session::get("cuslogin");
    if ($login == false) {
        echo "<script>window.location='login.php';</script>";
    }

 ?>
<?php 
  if (isset($_GET['orderId']) && $_GET['orderId'] == 'order') {

          $sId = session_id();
          $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
          $cartData = $db->select($query);
          if ($cartData) {
           while ($result = $cartData->fetch_assoc()) {
            $proId = $result['proId'];
            $proName = $result['ProName'];
            $quantity = $result['quantity'];
            $price = $result['price'];
            $qnprice = $result['quantity'] * $result['price'];
            $vat = $qnprice * 0.05;
            $totalPrice = $qnprice + $vat;
            $image = $result['image'];

            $inquery = "INSERT INTO  tbl_order (cmrId, productId, productName, quantity, price, proImg) VALUES('$cmrId', '$proId', '$proName', '$quantity', '$totalPrice', '$image')";
          $userinsert = $db->insert($inquery);
        }
      }
        $delquary = "DELETE FROM tbl_cart WHERE sId = '$sId'";
        $delbook = $db->delete($delquary);
         echo "<script>window.location='successorder.php';</script>";
  }

 ?> 

<!-- Breadcrumbs -->
  
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="Go to Home Page" href="index.html">Home</a><span>&raquo;</span></li>
           
            <li><strong>Payment Page</strong></li>
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
          <h2>Order Page</h2>
        </div>
            <div class="box-border">
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
                <ul>
                    
                    <li class="row">

                        <div class="col-sm-6">
                            <label for="phn" class="required" style="color: green;">Confirm bKash Payment</label>
                        </div><!--/ [col] -->

                    </li><!--/ .row -->

                    <li class="orderbutton"><i class="fa fa-angle-double-right"></i>&nbsp; <a href="?orderId=order"><span>Order</span></a></li>
                </ul>
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