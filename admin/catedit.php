                        
                        <?php include 'inc/header.php'; ?>
                            
                         <?php 
                            if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
                                header("location:viewcategory.php");
                            }else {
                                $catId = $_GET['catId'];
                            }

                        ?>

                    <!-- Page content -->
                    <div id="page-content">
                        <!-- Dashboard Header -->
                        
                        <div class="content-header content-header-media">
                            <div class="header-section">
                                <div class="row">
                                    <!-- Main Title (hidden on small devices for the statistics to fit) -->
                                    <div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
                                        <h1>Add Category</h1>
                                    </div>
                                    <!-- END Main Title -->
                                </div>
                            </div>
                            
                            <img src="img/placeholders/headers/dashboard_header.jpg" alt="header image" class="animation-pulseSlow">
                        </div>
                        <!-- END Dashboard Header -->

                        <!-- Mini Top Stats Row -->
                        <div class="row">
                        <?php 
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $cat_name = $_POST['cat_name'];
                            $cat_name = mysqli_real_escape_string($db->link, $cat_name);
                            if (empty($cat_name)) {
                                echo"<span style='color:red;'>Field must not be Empty!</span>";
                            }else{
                                $query = "UPDATE tbl_category
                                    SET cat_name = '$cat_name'
                                    WHERE id = '$catId'
                                ";
                                $update_cat = $db->update($query);

                                if ($update_cat) {
                                    echo"<span style='color:green;'>Category Update Successfully</span>";
                                }else {
                                     echo"<span style='color:red;'>Category not Update</span>";
                                }
                            }
                          }
                        ?>

                    <?php
                        $query = "SELECT * FROM tbl_category WHERE id = '$catId' ORDER BY id desc";
                        $category = $db->select($query);
                        if ($category) {
                            while ($result = $category->fetch_assoc()) {
                     ?>
                           <form  action="" method="post" class="form-horizontal form-bordered ui-formwizard" enctype="multipart/form-data">
                                
                                <!-- END Step Info -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="category">Category Name</label>
                                    <div class="col-md-5">
                                        <input id="category" name="cat_name" class="form-control " value="<?php echo $result['cat_name']; ?>" type="text">
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