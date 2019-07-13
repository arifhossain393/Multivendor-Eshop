                        
                    <?php include 'inc/header.php'; ?>
                        
                    <!-- Page content -->
                    <div id="page-content">
                        <!-- Dashboard Header -->
                        
                        <div class="content-header content-header-media">
                            <div class="header-section">
                                <div class="row">
                                    <!-- Main Title (hidden on small devices for the statistics to fit) -->
                                    <div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
                                        <h1>Add User</h1>
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
                                $password = $fm->validation(md5($_POST['password']));
                                $level = $_POST['level'];

                                $name = mysqli_real_escape_string($db->link, $name);
                                $username = mysqli_real_escape_string($db->link, $username);
                                $email = mysqli_real_escape_string($db->link, $email);
                                $password = mysqli_real_escape_string($db->link, $password);
                                $level = mysqli_real_escape_string($db->link, $level);

                                if (empty($name) || empty($username) || empty($email) || empty($password) || empty($level)) {
                                    echo"<div class='alert alert-danger'>Field must not be Empty!</div>";
                                }
                                else if(strlen($name) < 5){
                                    echo"<div class='alert alert-danger'>Name Too much Short!!</div>";
                                  }
                                  else if(!preg_match("/^[a-zA-Z ]*$/",$name)){
                                    echo"<div class='alert alert-danger'><strong>Error!</strong> UserName must only contain ulphanumirical, dashes and underscore.</div>";
                                  }
                                  else if(strlen($username) < 3){
                                    echo"<div class='alert alert-danger'>User Name Too much Short!!</div>";
                                  }
                                  else if(!preg_match("/^[a-zA-Z ]*$/",$username)){
                                    echo"<div class='alert alert-danger'><strong>Error!</strong> UserName must only contain ulphanumirical, dashes and underscore.</div>";
                                  }
                                   else if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
                                    echo"<div class='alert alert-danger'><strong>Error !</strong>Invalide Email</div>";
                                  }else{
                                    $query = "INSERT INTO  tbl_admin(name, username, email, password, level) VALUES('$name', '$username', '$email', '$password', '$level')";
                                    $userinsert = $db->insert($query);

                                    if ($userinsert) {
                                        echo"<span style='color:green;'>Add User Successfully</span>";
                                    }else {
                                         echo"<span style='color:red;'>User not Added</span>";
                                    }
                                }
                              }

                            ?>
                           <form  action="" method="post" class="form-horizontal form-bordered ui-formwizard" enctype="multipart/form-data">
                                
                                <!-- END Step Info -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="name">Name</label>
                                    <div class="col-md-5">
                                        <input id="name" name="name" class="form-control " placeholder="Name" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="username">User Name</label>
                                    <div class="col-md-5">
                                        <input id="username" name="username" class="form-control " placeholder="User Name.." type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="email">Email</label>
                                    <div class="col-md-5">
                                        <input id="email" name="email" class="form-control " placeholder="Enter Email" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="category">Password</label>
                                    <div class="col-md-5">
                                        <input id="password" name="password" class="form-control "  type="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="level">User Type</label>
                                    <div class="col-md-5">
                                        <select id="level" name="level" class="form-control" size="1">
                                            <option value="0">Admin</option>
                                            <option value="1">Vendor</option>
                                            <option value="2">Shipping Manager</option>
                                        </select>
                                    </div>
                                </div>
                              
                            <!-- END First Step -->

                                <!-- Form Buttons -->
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-sm btn-primary" id="next4" value="Next">Add</button>
                                    </div>
                                </div>
                                <!-- END Form Buttons -->
                            </form>
                           
                        </div>
                        <!-- END Mini Top Stats Row -->
                       
                    </div>
                    <!-- END Page Content -->

                   <?php include 'inc/footer.php'; ?>