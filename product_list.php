<?php include 'inc/header.php'; ?> 
  <!-- Breadcrumbs -->
  
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="Go to Home Page" href="index.html">Home</a><span>&raquo;</span></li>
            <li class=""> <a title="Go to Home Page" href="shop_grid.html">Computers</a><span>&raquo;</span></li>
            <li><strong>Apple</strong></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumbs End --> 
  <!-- Main Container -->
  <div class="main-container col2-left-layout">
    <div class="container">
      <div class="row">
        <div class="col-main col-sm-9 col-xs-12 col-sm-push-3">
          
          <div class="shop-inner">
            <div class="page-title">
              <h2>Apple</h2>
            </div>
            <div class="toolbar">
              <div class="view-mode">
                <ul>
                  <li> <a href="product.php"> <i class="fa fa-th-large"></i> </a> </li>
                  <li class="active"> <a href="product_list.php"> <i class="fa fa-th-list"></i> </a> </li>
                </ul>
              </div>
              <div class="sorter">
                <div class="short-by">
                  <label>Sort By:</label>
                  <select>
                    <option selected="selected">Position</option>
                    <option>Name</option>
                    <option>Price</option>
                    <option>Size</option>
                  </select>
                </div>
                <div class="short-by page">
                  <label>Show:</label>
                  <select>
                    <option selected="selected">9</option>
                    <option>12</option>
                    <option>16</option>
                    <option>30</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="product-list-area">
              <ul class="products-list" id="products-list">
                <!--pagination -->
                <?php 
                  $per_page = 10;
                  if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                  } else {
                    $page = 1;
                  }
                  $start_form = ($page - 1) * $per_page;

                ?>
                <!--pagination -->

                <?php 
                  $query = "SELECT * FROM tbl_product LIMIT $start_form, $per_page";
                  $product = $db->select($query);
                  if ($product) {
                      while ($result = $product->fetch_assoc()) {
                  
                ?>

                <li class="item ">
                  <div class="product-img">
                    <a href="single-product.php?proId=<?php echo $result['id']; ?>" title="Ipsums Dolors Untra">
                    <figure> <img style="height: 270px; width: 230px;" class="small-image" src="admin/<?php echo $result['product_img']; ?>" alt="Ipsums Dolors Untra"></figure>
                    </a> </div>
                  <div class="product-shop">
                    <h2 class="product-name"><a href="single-product.php?proId=<?php echo $result['id']; ?>" title="Ipsums Dolors Untra"><?php echo $result['title']; ?></a></h2>
                    <div class="ratings">
                      <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                      <p class="rating-links"> <a href="#/">4 Review(s)</a> <span class="separator">|</span> <a href="#review-form">Add Your Review</a> </p>
                    </div>
                    <div class="price-box">
                            <?php
                              if ($result['discount_price'] == 0) { ?>
                                 <p class="special-price"> <span class="price-label">Special Price</span> <span class="price">৳ <?php echo $result['regular_price']; ?></span> </p>
                         <?php   }else { ?>
                              <p class="special-price"> <span class="price-label">Special Price</span> <span class="price">৳ <?php echo $result['discount_price']; ?></span> </p>

                              <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price">৳ <?php echo $result['regular_price']; ?></span> </p>
                          <?php  }

                             ?>
                          </div>
                    <div class="desc std">
                      <p><?php echo $result['short_desc']; ?> <a class="link-learn" title="Learn More" href="single_product.html">Learn More</a> </p>
                    </div>
                    <div class="actions">
                      <button class="button cart-button" title="Add to Cart" type="button"><i class="fa fa-shopping-cart"></i><span>Add to Cart</span></button>
                      <ul>
                        <li> <a href="wishlist.html"> <i class="fa fa-heart"></i><span> Add to Wishlist</span> </a> </li>
                        <li> <a href="compare.html"> <i class="fa fa-signal"></i><span> Add to Compare</span> </a> </li>
                      </ul>
                    </div>
                  </div>
                </li>
                <?php } } ?>

                
              </ul>
            </div>
            <div class="pagination-area ">
              <ul>
                
                <!--pagination -->
                <?php
                  $query = "select * from tbl_product";
                  $result = $db->select($query);
                  $total_rows = mysqli_num_rows($result);
                  $total_pages = ceil($total_rows / $per_page);

                 
                  for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<li><a class='active' href='product_list.php?page=".$i."'>".$i."</a></li>";
                  }

                  echo "<li><a href='product_list.php?page=$total_pages'>".'<i class="fa fa-angle-right"></i>'."</a></li>" ?>
                <!--pagination -->

              </ul>
            </div>
          </div>
        </div>
        <?php include 'inc/sidebar.php'; ?>
      </div>
    </div>
  </div>
  <!-- Main Container End --> 
 <?php include 'inc/footer.php'; ?> 