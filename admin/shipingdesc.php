                    <?php include 'inc/header.php'; ?>

                    <?php 
                        if(!isset($_GET['cmrId']) || $_GET['cmrId'] == NULL){
                            echo "<script>window.location = 'order_view.php';</script>";
                        }else{
                            $cmrId = $_GET['cmrId'];
                        }

                    ?>

                    <!-- Page content -->
                    <div id="page-content">
                        <!-- eCommerce Order View Header -->
                        <div class="content-header">
                            <ul class="nav-horizontal text-center">
                                <li>
                                    <a href="index.php"><i class="fa fa-bar-chart"></i> Dashboard</a>
                                </li>
                                <li>
                                    <a href="orders.php"><i class="gi gi-shop_window"></i> Orders</a>
                                </li>
                                <li class="active">
                                    <a href="order_view.php"><i class="gi gi-shopping_cart"></i> Order View</a>
                                </li>
                                <li>
                                    <a href="products.php"><i class="gi gi-shopping_bag"></i> Products</a>
                                </li>
                                <li>
                                    <a href="product_edit.php"><i class="gi gi-pencil"></i> Product Edit</a>
                                </li>
                                <li>
                                    <a href="customer_view.php"><i class="gi gi-user"></i> Customer View</a>
                                </li>
                            </ul>
                        </div>
                        <!-- END eCommerce Order View Header -->

                        <!-- Quick Stats -->
                        <div class="row text-center">
                            <div class="col-sm-6 col-lg-4">
                                <a href="javascript:void(0)" class="widget widget-hover-effect2">
                                    <div class="widget-extra themed-background">
                                        <h4 class="widget-content-light"><strong>Total</strong> Orders</h4>
                                    </div>
                                    <div class="widget-extra-full"><span class="h2 animation-expandOpen">
                                         <?php
                                            $query = "SELECT * FROM tbl_order ORDER BY id DESC";
                                            $orders = $db->select($query);
                                            if ($orders) {
                                                $count = mysqli_num_rows($orders);
                                                echo $count; 
                                            }

                                        ?>
                                    </span></div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <a href="javascript:void(0)" class="widget widget-hover-effect2">
                                    <div class="widget-extra themed-background-dark">
                                        <h4 class="widget-content-light"><strong>Total</strong> Items</h4>
                                    </div>
                                    <div class="widget-extra-full"><span class="h2 themed-color-dark animation-expandOpen">
                                       <?php
                                            $query = "SELECT * FROM tbl_product ORDER BY id DESC";
                                            $product = $db->select($query);
                                            if ($product) {
                                                $count = mysqli_num_rows($product);
                                                echo $count; 
                                            }

                                        ?> 
                                    </span></div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-lg-4">
                                <a href="javascript:void(0)" class="widget widget-hover-effect2">
                                    <div class="widget-extra themed-background-dark">
                                        <h4 class="widget-content-light"><strong>Total</strong> Amount</h4>
                                    </div>
                                    <div class="widget-extra-full"><span class="h2 themed-color-dark animation-expandOpen">
                                    <?php
                                  $query = "SELECT price FROM tbl_order ORDER BY id";
                                  $cartpro = $db->select($query);
                                  if ($cartpro) {
                                    $sum = 0;
                                      while ($result = $cartpro->fetch_assoc()) {

                                        $sum = $sum + $result['price'];
                                         Session::set("sum", $sum);

                                      }
                                  }

                                 ?>
                                    ৳<?php echo Session::get("sum"); ?>

                                    </span></div>
                                </a>
                            </div>
                        </div>
                        <!-- END Quick Stats -->

                        <!-- Addresses -->
                        <div class="row">
    
                            <?php
                                $query = "SELECT * FROM tbl_user WHERE id='$cmrId'";
                                $viewaddress = $db->select($query);
                                if ($viewaddress) {
                                    while ($result = $viewaddress->fetch_assoc()) {
                             ?>
                            <div class="col-sm-6">
                                <!-- Billing Address Block -->
                                <div class="block">
                                    <!-- Billing Address Title -->
                                    <div class="block-title">
                                        <h2><i class="fa fa-building-o"></i> <strong>Billing</strong> Address</h2>
                                    </div>
                                    <!-- END Billing Address Title -->

                                    <!-- Billing Address Content -->
                                    <h4><strong><?php echo $result['user_name']; ?></strong></h4>
                                    <address>
                                        <?php echo $result['address']; ?><br>
                                       <?php echo $result['city']; ?>, <?php echo $result['zip']; ?><br>
                                        <?php echo $result['country']; ?><br><br>
                                        <i class="fa fa-phone"></i> <?php echo $result['phn']; ?><br>
                                        <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)"><?php echo $result['user_email']; ?></a>
                                    </address>
                                    <!-- END Billing Address Content -->
                                </div>
                                <!-- END Billing Address Block -->
                            </div>
                            <?php } } ?>

                            <div class="col-sm-6">
                                <!-- Shipping Address Block -->

                            <?php
                                $query = "SELECT * FROM tbl_shipping WHERE cmr_id='$cmrId' LIMIT 1";
                                $viewshipping = $db->select($query);
                                if ($viewshipping) {
                                    while ($result = $viewshipping->fetch_assoc()) {
                             ?>
                                <div class="block">
                                    <!-- Shipping Address Title -->
                                    <div class="block-title">
                                        <h2><i class="fa fa-building-o"></i> <strong>Shipping</strong> Address</h2>
                                    </div>
                                    <!-- END Shipping Address Title -->

                                    <!-- Shipping Address Content -->
                                    <h4><strong><?php echo $result['name']; ?></strong></h4>
                                    <address>
                                        <?php echo $result['address']; ?><br>
                                        <?php echo $result['city']; ?>, <?php echo $result['zip']; ?><br>
                                        <?php echo $result['country']; ?><br><br>
                                        <i class="fa fa-phone"></i> <?php echo $result['phone']; ?><br>
                                        <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)"><?php echo $result['email']; ?></a>
                                    </address>
                                    <!-- END Shipping Address Content -->
                                </div>
                                <!-- END Shipping Address Block -->
                                <?php } } ?>

                            </div>
                        </div>
                        <!-- END Addresses -->
                    </div>
                    <!-- END Page Content -->
                <?php include 'inc/footer.php'; ?>