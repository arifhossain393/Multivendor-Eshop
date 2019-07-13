                        
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
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $name = $fm->validation($_POST['name']);
                            $username = $fm->validation($_POST['username']);
                            $email = $fm->validation($_POST['email']);
                            $bio = $fm->validation($_POST['bio']);
                            $password = $fm->validation(md5($_POST['password']));

                            $name = mysqli_real_escape_string($db->link, $name);
                            $username = mysqli_real_escape_string($db->link, $username);
                            $email = mysqli_real_escape_string($db->link, $email);
                            $bio = mysqli_real_escape_string($db->link, $bio);
                            $password = mysqli_real_escape_string($db->link, $password);
                            if (empty($name) || empty($username) || empty($email) || empty($bio) || empty($password) ) {
                                echo"<span style='color:red;'>Field must not be Empty!</span>";
                            }else{
                                $query = "UPDATE tbl_admin
                                    SET
                                     name = '$name',
                                     username = '$username',
                                     email = '$email',
                                     bio = '$bio',
                                     password = '$password'
                                    WHERE id ='$userid' AND level = '$level'";
                                $update_user = $db->update($query);

                                if ($update_user) {
                                    echo"<span style='color:green;'>User Update Successfully</span>";
                                }else {
                                     echo"<span style='color:red;'>User not Update</span>";
                                }
                            }
                          }
                        ?>

                           <?php
                            $query = "SELECT * FROM tbl_admin WHERE id ='$userid' AND level = '$level'";
                            $getuser = $db->select($query);
                            if ($getuser) {
                                 while ($result = $getuser->fetch_assoc()) {

                            ?>

                           <form  action="" method="post" class="form-horizontal form-bordered ui-formwizard" enctype="multipart/form-data">
                                
                                <!-- END Step Info -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="name">Name</label>
                                    <div class="col-md-5">
                                        <input id="name" name="name" class="form-control " value="<?php echo $result['name']; ?>" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="username">User Name</label>
                                    <div class="col-md-5">
                                        <input id="username" name="username" class="form-control " value="<?php echo $result['username']; ?>" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="email">Email</label>
                                    <div class="col-md-5">
                                        <input id="email" name="email" class="form-control " value="<?php echo $result['email']; ?>" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="bio">Bio</label>
                                    <div class="col-md-5">
                                        <textarea id="bio" name="bio" class="form-control">
                                        <?php echo $result['bio']; ?>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="category">Password</label>
                                    <div class="col-md-5">
                                        <input id="password" name="password" class="form-control "  type="password">
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