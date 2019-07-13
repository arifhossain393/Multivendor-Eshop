                    <?php include 'inc/header.php'; ?>

                    <?php 
                        if (isset($_GET['delviId'])) {
                            $id = $_GET['delviId'];
                            $id = mysqli_real_escape_string($db->link, $id);
                           
                            $query = "UPDATE tbl_order
                                SET status = '1'
                                WHERE id = '$id'
                            ";
                            $update_status = $db->update($query);

                            if ($update_status) {
                                echo"<span style='color:green;'>Delivary Your Product</span>";
                            }else {
                                 echo"<span style='color:red;'>Product not Delivary</span>";
                            }
                        }

                    ?>
                    <?php 
                    if (isset($_GET['delorder'])) {
                        $delorder = $_GET['delorder'];
                        $delquery = "delete from tbl_order where id='$delorder'";
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

                        <!-- Products Block -->
                        <div class="block">
                            <!-- Products Title -->
                            <div class="block-title">
                                <h2><i class="fa fa-shopping-cart"></i> <strong>Products</strong></h2>
                            </div>
                            <!-- END Products Title -->

                            <!-- Products Content -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th>Product Name</th>
                                            <th class="text-center">QTY</th>
                                            <th class="text-center">PRICE</th>
                                            <th class="text-right" style="width: 10%;">Customar Id</th>
                                            <th class="text-right" style="width: 10%;">Shipping Details</th>
                                            <th class="text-right" style="width: 10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = "SELECT * FROM tbl_order ORDER BY id";
                                            $vieworder = $db->select($query);
                                            if ($vieworder) {
                                                while ($result = $vieworder->fetch_assoc()) {
                                         ?>

                                        <tr>
                                            <td class="text-center"><strong><?php echo $result['productId']; ?></strong></td>
                                            <td><?php echo $result['productName']; ?></td>
                                            <td class="text-center"><strong><?php echo $result['quantity']; ?></strong></td>
                                            <td class="text-center"><strong><?php echo $result['price']; ?></strong></td>
                                            <td class="text-right"><strong><?php echo $result['cmrId']; ?></strong></td>
                                            <td class="text-right"><a href="shipingdesc.php?cmrId=<?php echo $result['cmrId']; ?>">Address<strong></strong></a></td>
                                            <td class="text-right"><a href="?delviId=<?php echo $result['id']; ?>"><strong><span class="label label-success">Confirm</span></strong></a></td>

                                             <td class="text-right"><a href="?delorder=<?php echo $result['id']; ?>"><strong><span class="label label-danger">Cancel</span></strong></a></td>
                                        </tr>
                                        <?php } } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- END Products Content -->
                        </div>
                        <!-- END Products Block -->                        
                    </div>
                    <!-- END Page Content -->
                <?php include 'inc/footer.php'; ?>