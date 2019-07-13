                        
                    <?php include 'inc/header.php'; ?>

                    <!-- Page content -->
                    <div id="page-content">
                        <!-- Dashboard Header -->
                        
                        <div class="content-header content-header-media">
                            <div class="header-section">
                                <div class="row">
                                    <!-- Main Title (hidden on small devices for the statistics to fit) -->
                                    <div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
                                        <h1>Sub-Category List</h1>
                                    </div>
                                    <!-- END Main Title -->
                                </div>
                            </div>
                            
                            <img src="img/placeholders/headers/dashboard_header.jpg" alt="header image" class="animation-pulseSlow">
                        </div>
                        <!-- END Dashboard Header -->

                        <!-- Mini Top Stats Row -->
                        <div class="row">
                          <div class="box round first grid">
                            <h2>Sub-Category List</h2>
                            <div class="block">
                                <?php 
                                    if (isset($_GET['delId'])) {
                                        $delId = $_GET['delId'];
                                        $delquery = "delete from tbl_subcategory where id='$delId'";
                                        $deldata = $db->delete($delquery);
                                        if ($deldata) {
                                            echo"<span style='color:green;'>Sub Category Delete Successfully</span>";
                                        }else{
                                            echo"<span style='color:green;'>Sub Category not Delete</span>";
                                        }
                                    }

                                ?>

                                <table class="data display datatable" id="example">
                                    <thead>
                                        <tr>
                                            <th width="25%">No</th>
                                            <th width="25%">Category Name</th>
                                            <th width="25%">Sub-Category Name</th>
                                            <th width="25%">Action</th>
                                            
                                        </tr>
                                    </thead>
                                     <?php
                                        $query = "SELECT tbl_subcategory.*, tbl_category.cat_name FROM tbl_subcategory
                                        INNER JOIN tbl_category ON tbl_subcategory.catid = tbl_category.id";
                                        $subcategory = $db->select($query);
                                        if ($subcategory) {
                                            $i = 0;
                                            while ($result = $subcategory->fetch_assoc()) {
                                                $i++;
                                          
                                     ?>
                                    <tbody>
                                      
                                        <tr class="odd gradeX">
                                            <td><?php echo $i; ?></td>
                                            <td><p><?php echo $result['cat_name']; ?></p></td>
                                            <td><p><?php echo $result['subcat_name']; ?></p></td>
                                            <td><a class="btn btn-info" href="updatesubcat.php?subcatId=<?php echo $result['id']; ?>">Edit</a> <a class="btn btn-danger" onclick="return confirm('Are you Sure to Delete!');" href="?delId=<?php echo $result['id']; ?>">Delete</a></td>
                                        </tr>
                                    </tbody>
                                    <?php   }  } ?>
                                </table>
                            

                           </div>
                        </div>
                    </div>
                        <!-- END Mini Top Stats Row -->
                       
                    </div>
                    <!-- END Page Content -->

                   <?php include 'inc/footer.php'; ?>