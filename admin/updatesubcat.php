                        
                    <?php include 'inc/header.php'; ?>
                    <?php 
                        if (!isset($_GET['subcatId']) || $_GET['subcatId'] == NULL) {
                            header("location:viewsubcategory.php");
                        }else {
                            $subcatId = $_GET['subcatId'];
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
                                        <h1>Edit Sub-Category</h1>
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
                            $catid = $_POST['catid'];
                            $subcat_name = $fm->validation($_POST['subcat_name']);

                            $catid = mysqli_real_escape_string($db->link, $catid);
                            $subcat_name = mysqli_real_escape_string($db->link, $subcat_name);
                            if (empty($catid) || empty($subcat_name)) {
                                echo"<span style='color:red;'>Field must not be Empty!</span>";
                            }else{
                                $query = "UPDATE tbl_subcategory
                                    SET
                                    catid = '$catid',
                                    subcat_name = '$subcat_name'
                                    WHERE id = '$subcatId'
                                ";
                                $editsubcat = $db->update($query);

                                if ($editsubcat) {
                                    echo"<span style='color:green;'>Sub Category Update Successfully</span>";
                                }else {
                                     echo"<span style='color:red;'>Sub Category not Update</span>";
                                }
                            }
                          }
                        ?>
                           <form  action="" method="post" class="form-horizontal form-bordered ui-formwizard">
                                
                                <!-- END Step Info -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="catid">Select Category</label>
                                    <div class="col-md-5">
                                        <select id="catid" name="catid" class="form-control" size="1">
                                            <?php 
                                                $query = "SELECT * FROM tbl_category ORDER BY id";
                                                $selectcat = $db->select($query);
                                                if ($selectcat) {
                                                    while ($catresult = $selectcat->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $catresult['id']; ?>"><?php echo $catresult['cat_name']; ?></option>
                                           <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                              
                            <!-- END First Step -->
                                 <?php 
                                    $query = "SELECT * FROM tbl_subcategory WHERE id = '$subcatId'";
                                    $selectsubcat = $db->select($query);
                                    if ($selectsubcat) {
                                        while ($result = $selectsubcat->fetch_assoc()) {
                                ?>
                                <!-- END Step Info -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="subcat_name">Sub Category Name</label>
                                    <div class="col-md-5">
                                        <input id="subcat_name" name="subcat_name" class="form-control " value="<?php echo $result['subcat_name']; ?>" type="text">
                                    </div>
                                </div>
                              <!-- END First Step -->
                                <?php } } ?>
                                <!-- Form Buttons -->
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-sm btn-primary" id="next4">Submit</button>
                                    </div>
                                </div>
                                <!-- END Form Buttons -->
                            </form>
                         
                        </div>
                        <!-- END Mini Top Stats Row -->
                       
                    </div>
                    <!-- END Page Content -->

                   <?php include 'inc/footer.php'; ?>