                <!-- Main Sidebar -->
                <div id="sidebar">
                    <!-- Wrapper for scrolling functionality -->
                    <div id="sidebar-scroll">
                        <!-- Sidebar Content -->
                        <div class="sidebar-content">
                            <!-- Brand -->
                            <a href="index.php" class="sidebar-brand">
                                <i class="gi gi-flash"></i><span class="sidebar-nav-mini-hide"><strong>ValoKichu</strong></span>
                            </a>
                            <!-- END Brand -->
                                <?php
                                        if (isset($_GET['action']) && $_GET['action'] == "logout") {
                                            Session::destroy();
                                        }

                                ?>
                            <!-- User Info -->
                            <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                                <div class="sidebar-user-avatar">
                                    <a href="index.php">
                                        <img src="img/placeholders/avatars/avatar2.jpg" alt="avatar">
                                    </a>
                                </div>
                                <div class="sidebar-user-name"><?php echo Session::get('username'); ?></div>
                                <div class="sidebar-user-links">
                                    <a href="profile.php" data-toggle="tooltip" data-placement="bottom" title="Profile"><i class="gi gi-user"></i></a>
                                    <a href="inbox.php" data-toggle="tooltip" data-placement="bottom" title="Messages"><i class="gi gi-envelope"></i></a>
                                
                                    <a href="?action=logout" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="gi gi-exit"></i></a>
                                </div>
                            </div>
                         <!-- END User Info -->
                         <!-- Sidebar Navigation -->
                            <ul class="sidebar-nav">
                               
                                <li>
                                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-shopping_cart sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">eCommerce</span></a>
                                    <?php
                                        if (Session::get("level") == 0) {
                                        

                                     ?>

                                    <ul>
                                        <li>
                                            <a href="addcategory.php">Add Category</a>
                                        </li>
                                        <li>
                                            <a href="viewcategory.php">Category List</a>
                                        </li>
                                        <li>
                                            <a href="addsubcategory.php">Add Sub-Category</a>
                                        </li>
                                        <li>
                                            <a href="viewsubcategory.php">Sub-Category List</a>
                                        </li>
                                        <li>
                                            <a href="orders.php">Orders</a>
                                        </li>
                                        <li>
                                            <a href="order_view.php">Order View</a>
                                        </li>
                                        <li>
                                            <a href="products.php">Products</a>
                                        </li>
                                        <li>
                                            <a href="product_edit.php">Product Edit</a>
                                        </li>
                                        <li>
                                            <a href="customer_view.php">Customer View</a>
                                        </li>
                                         <li>
                                            <a href="totalorders.php">Total Amount</a>
                                        </li>
                                    </ul>
                                <?php    } ?>

                                <?php
                                    if (Session::get("level") == 1) {

                                     ?>
                                      <ul>
                                        <li>
                                            <a href="addcategory.php">Add Category</a>
                                        </li>
                                        <li>
                                            <a href="viewcategory.php">Category List</a>
                                        </li>
                                        <li>
                                            <a href="addsubcategory.php">Add Sub-Category</a>
                                        </li>
                                        <li>
                                            <a href="viewsubcategory.php">Sub-Category List</a>
                                        </li>
                                        <li>
                                            <a href="orders.php">Orders</a>
                                        </li>
                                        <li>
                                            <a href="order_view.php">Order View</a>
                                        </li>
                                        <li>
                                            <a href="products.php">Products</a>
                                        </li>
                                        <li>
                                            <a href="product_edit.php">Product Edit</a>
                                        </li>
                                        <li>
                                            <a href="customer_view.php">Customer View</a>
                                        </li>
                                         <li>
                                            <a href="totalorders.php">Total Amount</a>
                                        </li>
                                    </ul>

                                    <?php    } ?> 
                                    <?php
                                    if (Session::get("level") == 2) {

                                     ?>
                                      <ul>
                                        
                                        <li>
                                            <a href="orders.php">Orders</a>
                                        </li>
                                        <li>
                                            <a href="order_view.php">Order View</a>
                                        </li>
                                        <li>
                                            <a href="products.php">Products</a>
                                        </li>
                                       
                                        <li>
                                            <a href="customer_view.php">Customer View</a>
                                        </li>
                                         <li>
                                            <a href="totalorders.php">Total Amount</a>
                                        </li>
                                    </ul>

                                    <?php    } ?>

                                </li>

                            </ul>
                            <!-- END Sidebar Navigation -->
                        </div>
                        <!-- END Sidebar Content -->
                    </div>
                    <!-- END Wrapper for scrolling functionality -->
                </div>
                <!-- END Main Sidebar -->