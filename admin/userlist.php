                        
                    <?php include 'inc/header.php'; ?>

                    <!-- Page content -->
                    <div id="page-content">
                        <!-- Dashboard Header -->
                        
                        <div class="content-header content-header-media">
                            <div class="header-section">
                                <div class="row">
                                    <!-- Main Title (hidden on small devices for the statistics to fit) -->
                                    <div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
                                        <h1>User List</h1>
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
                            <h2>User List</h2>
                            <div class="block">
                                <?php 
                                    if (isset($_GET['delcat'])) {
                                        $delcat = $_GET['delcat'];
                                        $delquery = "delete from tbl_admin where id='$delcat'";
                                        $deldata = $db->delete($delquery);
                                        if ($deldata) {
                                            echo"<span style='color:green;'>User Delete Successfully</span>";
                                        }else{
                                            echo"<span style='color:green;'>User not Delete</span>";
                                        }
                                    }

                                ?>

                                <table class="data display datatable" id="example">
                                    <thead>
                                        <tr>
                                            <th width="20%">No</th>
                                            <th width="20%">User Name</th>
                                            <th width="20%">Email</th>
                                            <th width="20%">User Role</th>
                                            <th width="20%">Action</th>
                                            
                                        </tr>
                                    </thead>
                                     <?php
                                        $query = "SELECT * FROM tbl_admin ORDER BY id DESC";
                                        $userlist = $db->select($query);
                                        if ($userlist) {
                                            $i = 0;
                                            while ($result = $userlist->fetch_assoc()) {
                                                $i++;
                                          
                                     ?>
                                    <tbody>
                                      
                                        <tr class="odd gradeX">
                                            <td><?php echo $i; ?></td>
                                            <td><p><?php echo $result['username']; ?></p></td>
                                            <td><p><?php echo $result['email']; ?></p></td>
                                            <td><p>
                                                <?php
                                                    if ($result['level'] == 0) {
                                                        echo "Admin";
                                                    }elseif ($result['level'] == 1) {
                                                         echo "Vendor";
                                                    }elseif ($result['level'] == 2) {
                                                         echo "Shipper";
                                                    }

                                                 ?>
                                            </p></td>
                                            <td><a class="btn btn-danger" onclick="return confirm('Are you Sure to Delete!');" href="?delcat=<?php echo $result['id']; ?>">Delete</a></td>
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