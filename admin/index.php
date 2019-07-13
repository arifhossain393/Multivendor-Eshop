                <?php include 'inc/header.php'; ?>

                    <!-- Page content -->
                    <div id="page-content">
                        <!-- eCommerce Dashboard Header -->
                        <div class="content-header">
                            <ul class="nav-horizontal text-center">
                                <li class="active">
                                    <a href="index.php"><i class="fa fa-bar-chart"></i> Dashboard</a>
                                </li>
                                <li>
                                    <a href="orders.php"><i class="gi gi-shop_window"></i> Orders</a>
                                </li>
                                <li>
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
                        <!-- END eCommerce Dashboard Header -->

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

                        <!-- eShop Overview Block -->
                        <div class="block full">
                            <!-- eShop Overview Title -->
                            <div class="block-title">
                                <!-- <div class="block-options pull-right">
                                    <div class="btn-group btn-group-sm">
                                        <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default dropdown-toggle" data-toggle="dropdown">Last Year <span class="caret"></span></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li class="active">
                                                <a href="javascript:void(0)">Last Year</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Last Month</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">This Month</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Today</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a>
                                </div> -->
                                <h2><strong>eShop</strong> Overview</h2>
                            </div>
                            <!-- END eShop Overview Title -->

                            <!-- eShop Overview Content -->
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="row push">
                                        <div class="col-xs-6">
                                            <h3><strong class="animation-fadeInQuick">
                                        <?php
                                            $query = "SELECT * FROM tbl_order ORDER BY id DESC";
                                            $orders = $db->select($query);
                                            if ($orders) {
                                                $count = mysqli_num_rows($orders);
                                                echo $count; 
                                            }

                                        ?>
                                            </strong><br><small class="text-uppercase animation-fadeInQuickInv"><a href="javascript:void(0)">Total Orders</a></small></h3>
                                        </div>
                                        <div class="col-xs-6">
                                            <h3><strong class="animation-fadeInQuick">
                                        <?php
                                            $query = "SELECT * FROM tbl_product ORDER BY id DESC";
                                            $product = $db->select($query);
                                            if ($product) {
                                                $count = mysqli_num_rows($product);
                                                echo $count; 
                                            }

                                        ?> 
                                            </strong><br><small class="text-uppercase animation-fadeInQuickInv"><a href="javascript:void(0)">Items</a></small></h3>
                                        </div>
                                        <div class="col-xs-6">
                                            <h3><strong class="animation-fadeInQuick">
                                         <?php
                                            $query = "SELECT * FROM tbl_order WHERE status = '0' ORDER BY id DESC";
                                            $porders = $db->select($query);
                                            if ($porders) {
                                                $count = mysqli_num_rows($porders);
                                                echo $count; 
                                            }else{
                                                echo "0";
                                            }

                                        ?>
                                            </strong><br><small class="text-uppercase animation-fadeInQuickInv"><a href="javascript:void(0)">Order Processing</a></small></h3>
                                        </div>
                                        <div class="col-xs-6">
                                            <h3><strong class="animation-fadeInQuick">
                                        <?php
                                            $query = "SELECT * FROM tbl_user ORDER BY id DESC";
                                            $usr = $db->select($query);
                                            if ($usr) {
                                                $count = mysqli_num_rows($usr);
                                                echo $count; 
                                            }

                                        ?> 
                                            </strong><br><small class="text-uppercase animation-fadeInQuickInv"><a href="javascript:void(0)">Customers</a></small></h3>
                                        </div>
                                        <div class="col-xs-6">
                                            <h3><strong class="animation-fadeInQuick">5.0%</strong><br><small class="text-uppercase animation-fadeInQuickInv"><a href="javascript:void(0)">Vat</a></small></h3>
                                        </div>
                                        <div class="col-xs-6">
                                            <h3><strong class="animation-fadeInQuick">
                                                ৳<?php
                                                  $vat = Session::get("sum") * 0.05;
                                                    echo $vat;
                                                    Session::set("vat", $vat);
                                                  ?>
                                            </strong><br><small class="text-uppercase animation-fadeInQuickInv"><a href="javascript:void(0)">Total Vat</a></small></h3>
                                        </div>
                                        <!-- <div class="col-xs-6">
                                            <h3><strong class="animation-fadeInQuick">৳ 
                                              //  <?php
                                                 // $net = Session::get("sum") - Session::get("vat");
                                                 //   echo $net;
                                                   
                                                //  ?>
                                            </strong><br><small class="text-uppercase animation-fadeInQuickInv"><a href="javascript:void(0)">Net Profit</a></small></h3>
                                        </div> -->
                                        <div class="col-xs-6">
                                            <h3><strong class="animation-fadeInQuick">
                                                ৳ <?php echo Session::get("sum"); ?>
                                            </strong><br><small class="text-uppercase animation-fadeInQuickInv"><a href="javascript:void(0)">Total Amount</a></small></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-8">
                                    <!-- Flot Charts (initialized in js/pages/ecomDashboard.js), for more examples you can check out http://www.flotcharts.org/ -->
                                    <div id="chart-overview" style="height: 350px;"></div>
                                </div>
                            </div>
                            <!-- END eShop Overview Content -->
                        </div>
                        <!-- END eShop Overview Block -->

                        <!-- Orders and Products -->
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Latest Orders Block -->
                                <div class="block">
                                    <!-- Latest Orders Title -->
                                    <div class="block-title">
                                        <div class="block-options pull-right">
                                            <a href="" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Show All"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a>
                                        </div>
                                        <h2><strong>Latest</strong> Orders</h2>
                                    </div>
                                    <!-- END Latest Orders Title -->

                                    <!-- Latest Orders Content -->
                                    <table class="table table-borderless table-striped table-vcenter table-bordered">
                                        <tbody>
                                            <?php
                                                $query = "SELECT * FROM tbl_order ORDER BY id";
                                                $vieworder = $db->select($query);
                                                if ($vieworder) {
                                                    $i = 0;
                                                    while ($result = $vieworder->fetch_assoc()) {
                                                     $i++;   
                                             ?>

                                            <tr>
                                                <td class="text-center" style="width: 100px;"><a href="javascript:void(0)"><strong><?php echo $result['id']; ?></strong></a></td>
                                                <td class="hidden-xs"><a href="javascript:void(0)"><?php echo $result['productName']; ?></a></td>
                                                <td class="hidden-xs"><?php echo $result['quantity']; ?></td>
                                                <td class="text-right"><strong>৳<?php echo $result['price']; ?></strong></td>
                                                <td class="text-right">
                                                    <?php
                                                        if ($result['status'] == 0) { ?>
                                                            <span class="label label-warning">Processing</span>
                                                       <?php }else { ?>
                                                           <span class="label label-success">Delivered</span>
                                                     <?php  }

                                                     ?>
                                                   
                                                </td>
                                            </tr>
                                            <?php } } ?>
                                           
                                        </tbody>
                                    </table>
                                    <!-- END Latest Orders Content -->
                                </div>
                                <!-- END Latest Orders Block -->
                            </div>
                          
                        </div>
                        <!-- END Orders and Products -->
                    </div>
                    <!-- END Page Content -->

                    <?php include 'inc/footer.php'; ?>