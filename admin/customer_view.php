                <?php include 'inc/header.php'; ?>

                <?php 
                    if (isset($_GET['delData'])) {
                        $delData = $_GET['delData'];
                        $delquery = "delete from tbl_user where id='$delData'";
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
                                <li class="active">
                                    <a href="customer_view.php"><i class="gi gi-user"></i> Customer View</a>
                                </li>
                            </ul>
                        </div>
                        <!-- END eCommerce Orders Header -->
                       
                        <!-- All Orders Block -->
                        <div class="block full">
                            <!-- All Orders Title -->
                            <div class="block-title">
                                <div class="block-options pull-right">
                                    <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a>
                                </div>
                                <h2><strong>All</strong> Customer List</h2>
                            </div>
                            <!-- END All Orders Title -->

                            <!-- All Orders Content -->
                            <table id="ecom-orders" class="table table-bordered table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Name</th>
                                        <th class="visible-lg">Email</th>
                                        <th class="text-center visible-lg">Address</th>
                                        <th class="hidden-xs">City</th>
                                        <th class="text-right hidden-xs">Zip-Code</th>
                                        <th class="text-right hidden-xs">Country</th>
                                        <th class="text-right hidden-xs">Phone</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM tbl_user ORDER BY id";
                                        $viewcustomer = $db->select($query);
                                        if ($viewcustomer) {
                                            $i = 0;
                                            while ($result = $viewcustomer->fetch_assoc()) {
                                            $i++;
                                     ?>
                                    <tr>
                                        <td class="text-center"><a href="page_ecom_order_view.html"><strong><?php echo $i; ?></strong></a></td>
                                        <td class="visible-lg"><?php echo $result['user_name']; ?></td>
                                        <td class="text-center visible-lg"><?php echo $result['user_email']; ?></td>
                                        <td class="text-right hidden-xs"><strong><?php echo $result['address']; ?></strong></td>
                                        <td><?php echo $result['city']; ?></td>
                                        <td class="hidden-xs text-center"><?php echo $result['zip']; ?></td>
                                        <td class="hidden-xs text-center">
                                            <?php echo $result['country']; ?>
                                        </td>
                                        <td class="hidden-xs text-center">
                                            <?php echo $result['phn']; ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-xs">
                                                <a href="?delData=<?php echo $result['id']; ?>" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                                  
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