<?php include 'inc/header.php'; ?>
<?php
    
    $cmrId = Session::get("cmrId");
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
            <li class="home"> <a title="Go to Home Page" href="index.html">Home</a><span>&raquo;</span></li>
           
            <li><strong>Payment Page</strong></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumbs End --> 
  
<!-- Main Container -->
<section class="main-container col2-right-layout">
  <div class="main container">
    <div class="row">
      <div class="col-main col-sm-9 col-xs-12">
      
        <div class="page-content checkout-page"><div class="page-title">
          <h2>Order Message</h2>
        </div>
            <div class="box-border">
               <div class="block-content">
                <h2>Confirm Your Order</h2>
             
          </div>
            </div>
        </div>
      </div>
      
    </div>
  </div>
  </section>
  <!-- Main Container End -->
  <!-- Footer -->
  <?php include 'inc/footer.php'; ?>