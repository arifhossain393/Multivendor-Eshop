                        
                    <?php include 'inc/header.php'; ?>

                    <?php
                        $userid =Session::get('userId');
                        $level = Session::get('level');

                     ?>
                        
                    <!-- Page content -->
                    <div id="page-content">
                        <!-- Dashboard Header -->
                        
                        <div class="content-header content-header-media">
                            <div class="header-section">
                                <div class="row">
                                    <!-- Main Title (hidden on small devices for the statistics to fit) -->
                                    <div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
                                        <h1>User Profile</h1>
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
                            $query = "SELECT * FROM tbl_admin WHERE id ='$userid' AND level = '$level'";
                            $getuser = $db->select($query);
                            if ($getuser) {
                                 while ($result = $getuser->fetch_assoc()) {

                            ?>

                           <div class="col-md-8">
                               <div class="block">
                            <!-- Info Title -->
                                <div class="block-title">
                                    <div class="block-options pull-right">
                                        <?php 
                                            if ($result['level'] == 0) { 
                                         ?>
                                        <a href="adduser.php" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="" data-original-title="Add User"><i class="fa fa-plus"></i></a>
                                        <a href="userlist.php" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="" data-original-title="User List"><i class="fa fa-user"></i></a>
                                        <a href="updateprofile.php" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="" data-original-title="Update Profile"><i class="fa fa-pencil"></i></a>
                                        <?php }else{ ?>
                                        <a href="updateprofile.php" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="" data-original-title="Update Profile"><i class="fa fa-pencil"></i></a>
                                     <?php } ?>
                                    </div>
                                    <h2>About <strong><?php echo $result['name']; ?></strong> <small>• <i class="fa fa-file-text text-primary"></i> <a href="javascript:void(0)" data-toggle="tooltip" title="" data-original-title="Download Bio in PDF">Bio</a></small></h2>
                                </div>
                                <!-- END Info Title -->

                                <!-- Info Content -->
                                <table class="table table-borderless table-striped">
                                    <tbody>
                                        <tr>
                                            <td style="width: 20%;"><strong>Info</strong></td>
                                            <td><?php echo $result['bio']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Username</strong></td>
                                            <td><?php echo $result['username']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email</strong></td>
                                            <td><?php echo $result['email']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>User Role</strong></td>
                                            <td>
                                                <?php
                                                    if ($result['level'] == 0) {
                                                        echo "Admin";
                                                    }elseif ($result['level'] == 1) {
                                                         echo "Vendor";
                                                    }elseif ($result['level'] == 2) {
                                                         echo "Shipper";
                                                    }

                                                 ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- END Info Content -->
                                    
                               </div>
                           </div>
                                   
                           <?php } } ?>
                        </div>
                        <!-- END Mini Top Stats Row -->
                       
                    </div>
                    <!-- END Page Content -->

                   <?php include 'inc/footer.php'; ?>