<?php
 include 'config/config.php'; 
 include 'lib/Database.php';
 include 'lib/Session.php';
 Session::init();
 include 'helpers/Formate.php';
 
 $db = new Database();
 $fm = new Formate();
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
<!-- Basic page needs -->
<meta charset="utf-8">
<!--[if IE]>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <![endif]-->
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Valokich-Online-Shop</title>
<meta name="description" content="">
<meta name="keywords" content=""/>
<!-- Mobile specific metas  , -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Favicon  -->
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700italic,700,400italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Arimo:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Dosis:400,300,200,500,600,700,800' rel='stylesheet' type='text/css'>

<!-- CSS Style -->

<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

<!-- font-awesome & simple line icons CSS -->
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css" media="all">
<link rel="stylesheet" type="text/css" href="assets/css/simple-line-icons.css" media="all">

<!-- owl.carousel CSS -->
<link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="assets/css/owl.theme.css">
<link rel="stylesheet" type="text/css" href="assets/css/owl.transitions.css">

<!-- animate CSS  -->
<link rel="stylesheet" type="text/css" href="assets/css/animate.css" media="all">

<!-- flexslider CSS -->
<link rel="stylesheet" type="text/css" href="assets/css/flexslider.css" >

<!-- jquery-ui.min CSS  -->
<link rel="stylesheet" type="text/css" href="assets/css/jquery-ui.css">

<!-- Revolution Slider CSS -->
<link href="assets/css/revolution-slider.css" rel="stylesheet">

<!-- style CSS -->
<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="all">
</head>

<body class="cms-index-index cms-home-page">

<!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]--> 

<!-- mobile menu -->
<div id="mobile-menu">
  <ul>
    <li><a href="index.php" class="home1">Home</a></li>
    <li><a href="product.php">Products</a></li>
    <li><a href="contact_us.php">Contact us</a></li>
    <li><a href="about_us.php">About us</a></li>
    <li><a href="blog.php">Blog</a></li>
  </ul>
</div>
<!-- end mobile menu -->
<div id="page"> 
 
  
  <!-- Header -->
  <header>
    <div class="header-container">
      <div class="header-top">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-sm-4 hidden-xs"> 
              <!-- Default Welcome Message -->
              <div class="welcome-msg ">Welcome to Valokichu! </div>
              <span class="phone hidden-sm">Call Us: 01956-000056</span> </div>
            <?php
                if (isset($_GET['action']) && $_GET['action'] == "usrlogout") {
                    Session::usrdestroy();
                }
            ?>
            <!-- top links -->
            <div class="headerlinkmenu col-lg-8 col-md-7 col-sm-8 col-xs-12">
              <div class="links">

                  <?php 
                    $login = Session::get("cuslogin");
                      if($login == false){ ?>
                      <div class="wishlist"><a title="My Wishlist" href="wishlist.html"><i class="fa fa-heart"></i><span class="hidden-xs">Wishlist</span></a></div>
                      <div class="login"><a href="login.php"><i class="fa fa-unlock-alt"></i><span class="hidden-xs">Log In</span></a></div>
                   <?php }else{ ?>
                      <div class="myaccount"><a title="My Account" href="account.php"><i class="fa fa-user"></i><span class="hidden-xs">My Account</span></a></div>
                      <div class="wishlist"><a title="My Wishlist" href="wishlist.html"><i class="fa fa-heart"></i><span class="hidden-xs">Wishlist</span></a></div>
                      <div class="login"><a href="?action=usrlogout"><i class="fa fa-unlock-alt"></i><span class="hidden-xs">Log Out</span></a></div>
                  <?php }
                  ?>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-sm-3 col-md-3 col-xs-12"> 
            <!-- Header Logo -->
            <div class="logo">
                <a title="e-commerce" href="index.php"><img alt="responsive theme logo" src="assets/images/logo.png"></a>
            </div>
            <!-- End Header Logo --> 
          </div>
          <div class="col-xs-9 col-sm-6 col-md-6"> 
            <!-- Search -->
            <div class="top-search">
              <div id="search">
                <form action="search.php" method="get">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="search">
                    <button class="btn-search" type="button"><i class="fa fa-search"></i></button>
                  </div>
                </form>
              </div>
            </div>
            
            <!-- End Search --> 
          </div>
          <!-- top cart -->
          
          <div class="col-lg-3 col-xs-3 top-cart">
            <div class="top-cart-contain">
            

              <div class="mini-cart">
                <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"> <a href="#">
                  <div class="cart-icon"><i class="fa fa-shopping-cart"></i></div>
                  <div class="shoppingcart-inner hidden-xs"><span class="cart-title">Shopping Cart</span> <span class="cart-total">
                  <?php
                      $sId = session_id();
                      $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
                      $cartpro = $db->select($query);
                      if ($cartpro) {
                        $sum = Session::get("sum");
                        $qty = Session::get("quantity");
                        echo $qty ."Items :৳".$sum;
                      }else {
                        echo "0";
                      }

                      ?>

                  
                     

                   </span></div>
                  </a></div>
                <div>
                  <div class="top-cart-content">
                    <div class="block-subtitle hidden-xs">Recently added item(s)</div>
                    <ul id="cart-sidebar" class="mini-products-list">

                    <?php
                      $sId = session_id();
                      $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
                      $cartpro = $db->select($query);
                      if ($cartpro) {
                          while ($result = $cartpro->fetch_assoc()) {

                     ?>
                      <li class="item odd"> <a href="shopping_cart.html" title="Ipsums Dolors Untra" class="product-image"><img src="admin/<?php echo $result['image']; ?>" alt="html template" width="65"></a>
                        <div class="product-details">
                          <p class="product-name"><a href="cart.php"><?php echo $result['ProName']; ?></a> </p>
                          <strong><?php echo $result['quantity']; ?></strong> x <span class="price">৳<?php echo $result['price']; ?></span> </div>
                      </li>
                       <?php } } ?>
                     
                    </ul>
                    <div class="top-subtotal">Subtotal: <span class="price">৳ <?php
                      $sId = session_id();
                      $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
                      $cartpro = $db->select($query);
                      if ($cartpro) {
                        $sum = Session::get("sum");
                        echo $sum;
                      }else {
                        echo "0";
                      }

                      ?></span></div>
                    <div class="actions">
                      <a href="checkout.php"><button class="btn-checkout" type="button"><i class="fa fa-check"></i><span>Checkout</span></button>
                      <a href="cart.php"><button class="view-cart" type="button"><i class="fa fa-shopping-cart"></i> <span>View Cart</span></button></a>
                    </div>
                  </div>
                </div>
              </div>
             

            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- end header --> 
  
  <!-- Navbar -->
  <nav class="top-stiky">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 hidden-lg-up hidden-md-up hidden-sm-up">
          <div class="mm-toggle-wrap">
            <div class="mm-toggle"> <i class="fa fa-align-justify"></i> </div>
              <span class="mm-label">Categories</span>
            </div>
          
        </div>
        <div class="col-sm-12 hidden-xs-up">
          <div class="nav-logo">
                <a title="e-commerce" href="index.html"><img alt="responsive theme logo" src="assets/images/logo2.png"></a>
            </div>
          <div class="mtmegamenu">
            <ul>
              <li class="mt-root demo_custom_link_cms">
                <div class="mt-root-item"><a href="index.php">
                  <div class="title title_font"><span class="title-text">Home</span></div>
                  </a></div>
               
              </li>
              <li class="mt-root">
                <div class="mt-root-item"><a href="product.php">
                  <div class="title title_font"><span class="title-text">Products</span> </div>
                  </a></div>
              </li>
              
              <li class="mt-root">
                <div class="mt-root-item"><a href="contact_us.php">
                  <div class="title title_font"><span class="title-text">Contact Us</span> </div>
                  </a></div>
              </li>
              <li class="mt-root">
                <div class="mt-root-item"><a href="about_us.php">
                  <div class="title title_font"><span class="title-text">about us</span></div>
                  </a></div>
              </li>
              <li class="mt-root demo_custom_link_cms">
                <div class="mt-root-item"><a href="blog.php">
                  <div class="title title_font"><span class="title-text">Blog</span></div>
                  </a></div>
               
              </li>
              <li class="mt-root">
                <div class="mt-root-item">
                  <div class="title title_font"><span class="title-text">New Products</span></div>
                </div>
                <ul class="menu-items col-xs-12">

                <?php 
                  $query = "SELECT * FROM tbl_product WHERE type = '5' LIMIT 3";
                  $newproduct = $db->select($query);
                  if ($newproduct) {
                      while ($result = $newproduct->fetch_assoc()) {
                  
                ?>
                  <li class="menu-item depth-1 product menucol-1-3 withimage">
                    <div class="product-item">
                      <div class="item-inner">
                        <div class="product-thumbnail">
                          
                          <div class="pr-img-area"> <a title="Ipsums Dolors Untra" href="single-product.php?proId=<?php echo $result['id']; ?>">
                            <figure> <img style="height: 250px; width: 350px;" class="first-img" src="admin/<?php echo $result['product_img']; ?>" alt="html template"> <img style="height: 250px; width: 350px;" class="hover-img" src="admin/<?php echo $result['product_img']; ?>" alt="html template"></figure>
                            </a>
                            <button type="button" class="add-to-cart-mt"> <i class="fa fa-shopping-cart"></i><span> Add to Cart</span> </button>
                          </div>
                          <div class="pr-info-area">
                            <div class="pr-button">
                              <div class="mt-button add_to_wishlist"> <a href="wishlist.html"> <i class="fa fa-heart"></i> </a> </div>
                              <div class="mt-button add_to_compare"> <a href="compare.html"> <i class="fa fa-signal"></i> </a> </div>
                              <div class="mt-button quick-view"> <a href="quick_view.html"> <i class="fa fa-search"></i> </a> </div>
                            </div>
                          </div>
                        </div>
                        <div class="item-info">
                          <div class="info-inner">
                            <div class="item-title"> <a title="Ipsums Dolors Untra" href="single-product.php?proId=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a> </div>
                            <div class="item-content">
                              <div class="rating"> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                              <div class="item-price">
                                <div class="price-box"> <span class="regular-price"> <span class="price">৳<?php echo $result['regular_price']; ?></span> </span> </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <?php } } ?>
                 
                </ul>
              </li>
            </ul>
          </div>
          <!--Sticky cart -->
          <div class="top-cart-contain nav-cart">
              <div class="mini-cart">
                <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle">
                  <a href="#">
                  <div class="cart-icon"><i class="fa fa-shopping-cart"></i></div>
                  <div class="shoppingcart-inner hidden-xs">
                    <span class="cart-total">4 Items</span>
                  </div>
                  </a>
                </div>
                <div>
                  <div class="top-cart-content">
                    <div class="block-subtitle hidden-xs">Recently added item(s)</div>
                    <ul id="cart-sidebar" class="mini-products-list">
                      <li class="item odd"> <a href="shopping_cart.html" title="Ipsums Dolors Untra" class="product-image"><img src="assets/images/products/img07.jpg" alt="html template" width="65"></a>
                        <div class="product-details"> <a href="#" title="Remove This Item" class="remove-cart"><i class="icon-close"></i></a>
                          <p class="product-name"><a href="shopping_cart.html">Lorem ipsum dolor sit amet Consectetur</a> </p>
                          <strong>1</strong> x <span class="price">$20.00</span> </div>
                      </li>
                      <li class="item even"> <a href="shopping_cart.html" title="Ipsums Dolors Untra" class="product-image"><img src="assets/images/products/img11.jpg" alt="html template" width="65"></a>
                        <div class="product-details"> <a href="#" title="Remove This Item" class="remove-cart"><i class="icon-close"></i></a>
                          <p class="product-name"><a href="shopping_cart.html">Consectetur utes anet adipisicing elit</a> </p>
                          <strong>1</strong> x <span class="price">$230.00</span> </div>
                      </li>
                      <li class="item last odd"> <a href="shopping_cart.html" title="Ipsums Dolors Untra" class="product-image"><img src="assets/images/products/img10.jpg" alt="html template" width="65"></a>
                        <div class="product-details"> <a href="#" title="Remove This Item" class="remove-cart"><i class="icon-close"></i></a>
                          <p class="product-name"><a href="shopping_cart.html">Sed do eiusmod tempor incidist</a> </p>
                          <strong>2</strong> x <span class="price">$420.00</span> </div>
                      </li>
                    </ul>
                    <div class="top-subtotal">Subtotal: <span class="price">$520.00</span></div>
                    <div class="actions">
                      <button class="btn-checkout" type="button"><i class="fa fa-check"></i><span>Checkout</span></button>
                      <button class="view-cart" type="button"><i class="fa fa-shopping-cart"></i> <span>View Cart</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

      </div>
    </div>
  </nav>
  <!-- end nav -->