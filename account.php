<?php include 'inc/header.php'; ?>
<?php
    $cmrId =Session::get('cmrId');
    $login = Session::get("cuslogin");
    if ($login == false) {
        echo "<script>window.location='login.php';</script>";
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
                <h4>User Account</h4>
                <?php
                  $query = "SELECT * FROM tbl_user WHERE id ='$cmrId'";
                  $getuser = $db->select($query);
                  if ($getuser) {
                       while ($result = $getuser->fetch_assoc()) {

                 ?>
              <div class="block">
              <!-- Info Title -->
                  <div class="block-title">
                      <div class="block-options pull-right">
                         
                          <a href="updateprofile.php" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="" data-original-title="Update Profile"><i class="fa fa-pencil"></i></a>
                      </div>
                  </div>
                  <!-- END Info Title -->

                  <!-- Info Content -->
                  <table class="table table-borderless table-striped">
                      <tbody>
                          <tr>
                              <td style="width: 20%;"><strong>Name</strong></td>
                              <td><?php echo $result['user_name']; ?></td>
                          </tr>
                          <tr>
                              <td><strong>Email</strong></td>
                              <td><?php echo $result['user_email']; ?></td>
                          </tr>
                          <tr>
                              <td><strong>Address</strong></td>
                              <td><?php echo $result['address']; ?></td>
                          </tr>
                          <tr>
                              <td><strong>City</strong></td>
                              <td><?php echo $result['city']; ?></td>
                          </tr>
                          <tr>
                              <td><strong>Zip-Code</strong></td>
                              <td><?php echo $result['zip']; ?></td>
                          </tr>
                          <tr>
                              <td><strong>Country</strong></td>
                              <td><?php echo $result['country']; ?></td>
                          </tr>
                          <tr>
                              <td><strong>Phone No:</strong></td>
                              <td><?php echo $result['phn']; ?></td>
                          </tr>
                          
                      </tbody>
                  </table>
                  <!-- END Info Content -->
                 </div>
                 <?php } } ?>

              </div>
             
        </div>
      </div>

    </div>
  </section>
  <!-- Main Container End --> 
  <!-- Footer -->
 <?php include 'inc/footer.php'; ?>