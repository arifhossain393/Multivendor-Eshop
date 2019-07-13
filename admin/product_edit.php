                        
                    <?php include 'inc/header.php'; ?>
                  <?php 
                        if (!isset($_GET['proId']) || $_GET['proId'] == NULL) {
                            header("location:products.php");
                        }else {
                            $proId = $_GET['proId'];
                        }

                    ?>  
                    <!-- Page content -->
                    <div id="page-content">
                        <!-- Dashboard Header -->
                        
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
                                <li class="active">
                                    <a href="product_edit.php"><i class="gi gi-pencil"></i> Product Edit</a>
                                </li>
                                <li>
                                    <a href="customer_view.php"><i class="gi gi-user"></i> Customer View</a>
                                </li>
                            </ul>
                        </div>
                        <!-- END Dashboard Header -->

                        <!-- Mini Top Stats Row -->
                        <div class="row">
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            
                           $title = mysqli_real_escape_string($db->link, $_POST['title']);
                            $sub_catid = mysqli_real_escape_string($db->link, $_POST['sub_catid']);
                            $short_desc = mysqli_real_escape_string($db->link, $_POST['short_desc']);
                            $full_desc = mysqli_real_escape_string($db->link, $_POST['full_desc']);
                            $regular_price = mysqli_real_escape_string($db->link, $_POST['regular_price']);
                            $discount_price = mysqli_real_escape_string($db->link, $_POST['discount_price']);
                            $status = mysqli_real_escape_string($db->link, $_POST['status']);
                            $brand_name = mysqli_real_escape_string($db->link, $_POST['brand_name']);
                            $type = mysqli_real_escape_string($db->link, $_POST['type']);
                            $up_date = mysqli_real_escape_string($db->link, $_POST['up_date']);

                            $permited = array('jpg', 'jpeg', 'png', 'gif');
                            $file_name = $_FILES['product_img']['name'];
                            $file_size = $_FILES['product_img']['size'];
                            $file_temp = $_FILES['product_img']['tmp_name'];

                            $div = explode('.', $file_name);
                            $file_ext = strtolower(end($div));
                            $uniq_image = substr(md5(time()), 0,10).'.'.$file_ext;

                            $upload_image = "upload/".$uniq_image;

                            if ($title == "" || $sub_catid == "" || $short_desc == "" || $full_desc == "" || $regular_price == "" || $status == "" || $brand_name == "" || $type == "" || $up_date == "") {
                                echo"<span style='color:red;'>Field must not be empty</span>";
                            }else{
                                if (!empty($file_name)) {
                                    if ($file_size > 3145701) {
                                        echo "<div class='alert alert-danger'>Image size should be less 3MB.</div>";
                                    }elseif (in_array($file_ext, $permited) === false) {
                                        echo "<div class='alert alert-danger'>you can upload only:-".implode(',', $permited)."</div>";
                                    }else {
                                        
                                    move_uploaded_file($file_temp, $upload_image);
                                    $query = "UPDATE tbl_product
                                        SET
                                        sub_catid = '$sub_catid',
                                        title = '$title',
                                        short_desc = '$short_desc',
                                        full_desc = '$full_desc',
                                        regular_price = '$regular_price',
                                        discount_price = '$discount_price',
                                        status = '$status',
                                        brand_name = '$brand_name',
                                        product_img = '$upload_image',
                                        type = '$type',
                                        up_date = '$up_date'
                                        WHERE id = '$proId'
                                     ";
                                    $update_product = $db->update($query);
                                    if ($update_product) {
                                        echo "<span style='color:green;'>Product Update Successfully</span>";
                                    }else {
                                        echo "<span style='color:red;'>Product Update Not Successfully</span>";
                                    }
                                }
                            }else {
                                 move_uploaded_file($file_temp, $upload_image);
                                    $query = "UPDATE tbl_product
                                        SET
                                        sub_catid = '$sub_catid',
                                        title = '$title',
                                        short_desc = '$short_desc',
                                        full_desc = '$full_desc',
                                        regular_price = '$regular_price',
                                        discount_price = '$discount_price',
                                        status = '$status',
                                        brand_name = '$brand_name',
                                        product_img = '$upload_image',
                                        type = '$type',
                                        up_date = '$up_date'
                                        WHERE id = '$proId'
                                     ";
                                    $update_product = $db->update($query);
                                    if ($update_product) {
                                        echo "<span style='color:green;'>Product Update Successfully</span>";
                                    }else {
                                        echo "<span style='color:red;'>Product Update Not Successfully</span>";
                                    }
                            }
                        }
                    }
                 ?>


                            <?php
                                $query = "SELECT * FROM tbl_product WHERE id = '$proId'";
                                $viewproduct = $db->select($query);
                                if ($viewproduct) {
                                    while ($result = $viewproduct->fetch_assoc()) {
                             ?>
                           <form  action="" method="post" class="form-horizontal form-bordered ui-formwizard" enctype="multipart/form-data">
                                
                                <!-- END Step Info -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="pac_title">Product Name</label>
                                    <div class="col-md-6">
                                        <input id="title" name="title" class="form-control " value="<?php echo $result['title']; ?>" type="text">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="sub_catid ">Subcategory Name</label>
                                    <div class="col-md-6">
                                        <select id="sub_catid " name="sub_catid" class="form-control" size="1">
                                            <?php 
                                                $query = "select * from tbl_subcategory";
                                                $subcategory = $db->select($query);
                                                if ($subcategory) {
                                                    while($subresult = $subcategory->fetch_assoc()){
                                            ?>
                                            <option value="<?php echo $result['id']; ?>"><?php echo $subresult['subcat_name']; ?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="short_desc">Short Description</label>
                                    <div class="col-xs-6">
                                        <textarea id="short_desc" name="short_desc" class="ckeditor"><?php echo $result['short_desc']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="full_desc">Full Description</label>
                                    <div class="col-xs-6">
                                        <textarea id="full_desc" name="full_desc" class="ckeditor"><?php echo $result['full_desc']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="regular_price">Regular Price</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-usd"></i></div>
                                            <input id="regular_price" name="regular_price" class="form-control" value="<?php echo $result['regular_price']; ?>" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="discount_price">Discount Price</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-usd"></i></div>
                                            <input id="discount_price" name="discount_price" class="form-control" value="<?php echo $result['discount_price']; ?>" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="status">Status</label>
                                    <div class="col-md-6">
                                        <select id="status" name="status" class="form-control" size="1">
                                            <option value="0">Abailable</option>
                                            <option value="1">Out of Stock</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="brand_name">Brand Name</label>
                                    <div class="col-md-6">
                                        <input id="brand_name" name="brand_name" class="form-control " value="<?php echo $result['brand_name']; ?>" type="text">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="product_img">Product Image</label>
                                    <div class="col-md-6">
                                        <img style="height: 50px; width: 50px" src="../admin/<?php echo $result['product_img']; ?>">
                                        <input id="product_img" name="product_img" type="file">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="type">Product Type</label>
                                    <div class="col-md-6">
                                        <select id="type" name="type" class="form-control" size="1">
                                            <option value="0">Hot Deal</option>
                                            <option value="1">Top Rated</option>
                                            <option value="2">Freatures</option>
                                            <option value="3">On Sale</option>
                                            <option value="4">Special Product</option>
                                            <option value="5">New Product</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="up_date">Publish Date</label>
                                    <div class="col-md-6">
                                        <input id="up_date" name="up_date" class="form-control input-datepicker" data-date-format="yyyy-mm-dd" value="<?php echo $fm->formatDate($result['up_date']); ?>" type="text">
                                    </div>
                                </div>
            
                                 <!-- END First Step -->

                                <!-- Form Buttons -->
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-sm btn-primary" id="next4" value="Next">Update</button>
                                    </div>
                                </div>
                                <!-- END Form Buttons -->
                            </form>
                            <?php } } ?>
                           
                        </div>
                        <!-- END Mini Top Stats Row -->
                       
                    </div>
                    <!-- END Page Content -->

                   <?php include 'inc/footer.php'; ?>