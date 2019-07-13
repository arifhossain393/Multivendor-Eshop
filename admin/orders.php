                <?php include 'inc/header.php'; ?>

                <?php 
                    if (isset($_GET['delData'])) {
                        $delData = $_GET['delData'];
                        $delquery = "delete from tbl_order where id='$delData'";
                        $deldata = $db->delete($delquery);
                        if ($deldata) {
                            //echo"<span style='color:green;'>Order Data Delete Successfully</span>";
                        }else{
                            //echo"<span style='color:red;'>Order Data not Delete</span>";
                        }
                    }

                ?>
                    <!-- Page content -->
                    <div id="page-content">
                        <!-- eCommerce Orders Header -->
                        <div class="content-header">
                            <ul class="nav-horizontal text-center">
                                <li>
                                    <a href="index.php"><i class="fa fa-bar-chart"></i> Dashboard</a>
                                </li>
                                <li class="active">
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
                        <!-- END eCommerce Orders Header -->

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

                        <!-- All Orders Block -->
                        <div class="block full">
                            <!-- All Orders Title -->
                            <div class="block-title">
                                <div class="block-options pull-right">
                                    <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a>
                                </div>
                                <h2><strong>All</strong> Orders</h2>
                            </div>
                            <!-- END All Orders Title -->

                            <!-- All Orders Content -->
                            <table id="ecom-orders" class="table table-bordered table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 100px;">ID</th>
                                        <th class="visible-lg">Product Id</th>
                                        <th class="text-center visible-lg">Product Name</th>
                                        <th class="hidden-xs">Price</th>
                                        <th class="text-right hidden-xs">Quantity</th>
                                        <th class="text-right hidden-xs">Date</th>
                                        <th>Image</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
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
                                        <td class="text-center"><a href="page_ecom_order_view.html"><strong><?php echo $i; ?></strong></a></td>
                                        <td class="visible-lg"><?php echo $result['productId']; ?></td>
                                        <td class="text-center visible-lg"><?php echo $result['productName']; ?></td>
                                        <td class="text-right hidden-xs"><strong>৳<?php echo $result['price']; ?></strong></td>
                                        <td><span class="label label-warning"><?php echo $result['quantity']; ?></span></td>
                                        <td class="hidden-xs text-center"><?php echo $result['date']; ?></td>
                                        <td class="hidden-xs text-center">
                                            <img style="height: 50px; width: 50px;" src="../admin/<?php echo $result['proImg']; ?>">
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-xs">
                                                <?php 
                                                    if ($result['status'] == 1) { ?>

                                                        <a href="?delData=<?php echo $result['id']; ?>" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>

                                                   <?php }

                                                 ?>
                                            </div>
                                        </td>
                                    </tr>
                                   <?php } } ?>
                                </tbody>
                            </table>
                            <!-- END All Orders Content -->
                        </div>
                        <!-- END All Orders Block -->
                    </div>
                    <!-- END Page Content -->

                   <?php include 'inc/footer.php'; ?>