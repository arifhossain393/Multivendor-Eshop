                <?php include 'inc/header.php'; ?>

                    <!-- Page content -->
                    <div id="page-content">
                        <!-- eCommerce Products Header -->
                        <div class="content-header">
                            <ul class="nav-horizontal text-center">
                                <li>
                                    <a href="index.php"><i class="fa fa-bar-chart"></i> Dashboard</a>
                                </li>
                                <li>
                                    <a href="orders.php"><i class="gi gi-shop_window"></i> Orders</a>
                                </li>
                                <li>
                                    <a href="order_view.php"><i class="gi gi-shopping_cart"></i> Order View</a>
                                </li>
                                <li class="active">
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
                        <!-- END eCommerce Products Header -->

                        <!-- Quick Stats -->
                        <div class="row text-center">
                            <div class="col-sm-6 col-lg-3">
                                <a href="addproduct.php" class="widget widget-hover-effect2">
                                    <div class="widget-extra themed-background-success">
                                        <h4 class="widget-content-light"><strong>Add New</strong> Product</h4>
                                    </div>
                                    <div class="widget-extra-full"><span class="h2 text-success animation-expandOpen"><i class="fa fa-plus"></i></span></div>
                                </a>
                            </div>
                            <!-- Quick Stats -->
                       
                            <div class="col-sm-6 col-lg-3">
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
                            <div class="col-sm-6 col-lg-3">
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
                            
                            <div class="col-sm-6 col-lg-3">
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

                        <!-- All Products Block -->
                        <div class="block full">
                            <!-- All Products Title -->
                            <div class="block-title">
                                <div class="block-options pull-right">
                                    <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a>
                                </div>
                                <h2><strong>All</strong> Products</h2>
                            </div>
                            <!-- END All Products Title -->
                            
                            <!-- All Products Content -->
                            <table id="ecom-products" class="table table-bordered table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 70px;">ID</th>
                                        <th>Product Name</th>
                                        <th>Product Image</th>
                                        <th class="text-right hidden-xs">Price</th>
                                        <th class="hidden-xs">Status</th>
                                        <th class="hidden-xs text-center">Type</th>
                                        <th>Added</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM tbl_product ORDER BY id";
                                        $viewproduct = $db->select($query);
                                        if ($viewproduct) {
                                            $i = 0;
                                            while ($result = $viewproduct->fetch_assoc()) {
                                             $i++;   
                                     ?>
                                    <tr>
                                        <td class="text-center"><a href="page_ecom_product_edit.html"><strong><?php echo $i; ?></strong></a></td>
                                        <td><?php echo $result['title']; ?></td>
                                        <td><img style="height: 50px; width: 50px;" src="../admin/<?php echo $result['product_img']; ?>"></td>
                                        <td class="text-right hidden-xs"><strong><?php echo $result['regular_price']; ?></strong></td>
                                        <td class="hidden-xs">
                                            
                                                <?php
                                                  if ($result['status'] == '0') {
                                                      echo '<span class="label label-success">Abailable</span>';
                                                  }else {
                                                       echo '<span class="label label-danger">Out of Stock</span>';
                                                  }

                                                ?>
                                                    
                                            
                                        </td>
                                        <td class="hidden-xs text-center">
                                        <?php
                                          if ($result['type'] == '0') {
                                              echo "Hot Deal";
                                          }elseif($result['type'] == '1') {
                                               echo "Top Rated";
                                          }elseif($result['type'] == '2') {
                                               echo "Freatures";
                                          }elseif($result['type'] == '3') {
                                               echo "On Sale";
                                          }
                                         ?>
                                         
                                        </td>
                                        <td><?php echo $fm->formatDate($result['up_date']); ?></td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-xs">
                                                <a href="product_edit.php?proId=<?php echo $result['id']; ?>" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                                <a href="delproduct.php?delId=<?php echo $result['id']; ?>" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
                            <!-- END All Products Content -->

                        </div>
                        <!-- END All Products Block -->
                    </div>
                    <!-- END Page Content -->

                   <?php include 'inc/footer.php'; ?>