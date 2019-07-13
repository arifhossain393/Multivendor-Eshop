 <?php include 'inc/header.php'; ?>

 <?php 
  $login = Session::get("cuslogin");
  if($login == true){
   // header("Location:index.php");
  }


?>
  <!-- Breadcrumbs -->
  
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="Go to Home Page" href="index.php">Home</a><span>&raquo;</span></li>
            <li><strong>My Account</strong></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumbs End --> 
  
  <!-- Main Container -->
  <section class="main-container col1-layout">
    <div class="main container">
      
        
        <div class="page-content">
          
            <div class="account-login">
              
   
          
              <div class="box-authentication">
                <h4>Login</h4>
                <?php 
                   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                  $user_email = $fm->validation($_POST['user_email']);
                  $password =  md5($_POST['password']);

                  $user_email = mysqli_real_escape_string($db->link , $user_email);
                  $password = mysqli_real_escape_string($db->link , $password);
                  
                  if(empty($user_email) || empty($password)){
                    echo"<span style='color:red;'>Field must not be Empty!</span>";
                  }
                  $query = "SELECT * FROM tbl_user WHERE user_email = '$user_email' AND password = '$password'";
                  $result = $db->select($query);
                  if($result !=false){
                    $value = $result->fetch_assoc();
                    Session::set("cuslogin",true);
                    Session::set("cmrId",$value['id']);
                    Session::set("cmrName",$value['user_name']);
                   echo "<script>window.location='index.php';</script>";
                  }else{
                     echo"<span style='color:red;'>Email Password Not Match!!</span>";
                  }
                }

              ?>


                <form action="" method="post">
                  <p class="before-login-text">Welcome back! Sign in to your account</p>
                  <label for="user_email">Email address<span class="required">*</span></label>
                  <input id="user_email" name="user_email" type="text" class="form-control">

                  <label for="password_login">Password<span class="required">*</span></label>
                  <input id="password_login" name="password" type="password" class="form-control">

                  <p class="forgot-pass"><a href="#">Lost your password?</a></p>
                  <button class="button" type="submit"><i class="fa fa-lock"></i>&nbsp; <span>Login</span></button><label class="inline" for="rememberme">
  								<li class="button"><i class="fa fa-user"></i>&nbsp; <a href="registration.php"><span>Register</span></a></li>
                </form>

              </div>
             
        </div>
      </div>

    </div>
  </section>
  <!-- Main Container End --> 
  <!-- Footer -->
 <?php include 'inc/footer.php'; ?>