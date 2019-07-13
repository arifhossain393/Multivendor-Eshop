                        
                    <?php include 'inc/header.php'; ?>
                        
                    <!-- Page content -->
                    <div id="page-content">
                        <!-- Dashboard Header -->
                        
                        <div class="content-header content-header-media">
                            <div class="header-section">
                                <div class="row">
                                    <!-- Main Title (hidden on small devices for the statistics to fit) -->
                                    <div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
                                        <h1>Add Your Destination</h1>
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
                                    $query = "INSERT INTO  tbl_category(cat_name) VALUES('$cat_name')";
                                    $catinsert = $db->insert($query);

                                    if ($catinsert) {
                                        echo"<span style='color:green;'>Category Add Successfully</span>";
                                    }else {
                                         echo"<span style='color:red;'>Category not Added</span>";
                                    }
                                }
                              }

                            ?>
                           <form  action="" method="post" class="form-horizontal form-bordered ui-formwizard" enctype="multipart/form-data">
                                
                                <!-- END Step Info -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="category">Category Name</label>
                                    <div class="col-md-5">
                                        <input id="category" name="cat_name" class="form-control " placeholder="Category.." type="text">
                                    </div>
                                </div>
                              
                            <!-- END First Step -->

                                <!-- Form Buttons -->
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-sm btn-primary" id="next4" value="Next">Submit</button>
                                    </div>
                                </div>
                                <!-- END Form Buttons -->
                            </form>
                           
                        </div>
                        <!-- END Mini Top Stats Row -->
                       
                    </div>
                    <!-- END Page Content -->

                   <?php include 'inc/footer.php'; ?>