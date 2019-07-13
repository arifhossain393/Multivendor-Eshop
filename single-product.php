<?php include 'inc/header.php'; ?>
  <!-- Breadcrumbs -->

  <?php 
	if(!isset($_GET['proId']) || $_GET['proId'] == NULL){
		echo "<script>window.location = 'index.php';</script>";
	}else{
		$id = $_GET['proId'];
	}

	?>
  
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="Go to Home Page" href="">Home</a><span>&raquo;</span></li>
            <li class=""> <a title="Go to Home Page" href="">Watches</a><span>&raquo;</span></li>
            <li><strong>Single Product</strong></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumbs End --> 
  <!-- Main Container -->
  <div class="main-container col2-left-layout">
    <div class="container">
	<?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $quantity = $fm->validation($_POST['quantity']);
        $quantity = mysqli_real_escape_string($db->link, $quantity);
        $productId = mysqli_real_escape_string($db->link , $id);
		$sId = session_id();
        
		$squery = "SELECT * FROM tbl_product WHERE id = '$productId'";
		$result = $db->select($squery)->fetch_assoc();
		
		$productName = $result['title'];
		if ($result['discount_price'] > 0) {
			$price = $result['discount_price'];
		}else{
			$price = $result['regular_price'];
		}
		$image = $result['product_img'];

		$chkqury = "SELECT * FROM tbl_cart WHERE proId ='$productId' AND sId ='$sId'";

		$crtpro = $db->select($chkqury);
		if ($crtpro) {
			echo"<span style='color:red;'>Product All ready added</span>";
		}else{
		
		$query = "INSERT INTO tbl_cart(sId, proId, ProName, price, quantity, image) VALUES('$sId','$productId', '$productName','$price','$quantity','$image')";
			
			$inserted_row = $db->insert($query);
			 if($inserted_row){
				echo "<script>window.location = 'cart.php';</script>";
			}else{
				echo "<script>window.location = 'index.php';</script>";
			} 
		}
      }

    ?>

     <div class="row">
		<?php 
          $query = "SELECT * FROM tbl_product WHERE id = '$id'";
          $singleproduct = $db->select($query);
          if ($singleproduct) {
              while ($result = $singleproduct->fetch_assoc()) {
          
        ?>


      <div class="col-main col-sm-9 col-xs-12 col-sm-push-3">
          <div class="product-view-area">
          <div class="product-big-image col-xs-12 col-sm-5 col-lg-5 col-md-5">
            <div class="large-image"> <a href="admin/<?php echo $result['product_img']; ?>" class="cloud-zoom" id="zoom1" rel="useWrapper: false, adjustY:0, adjustX:20"> <img class="zoom-img" src="admin/<?php echo $result['product_img']; ?>" alt="products"> </a> </div>
            <div class="flexslider flexslider-thumb">
              <ul class="previews-list slides">

                <li><a href='admin/<?php echo $result['product_img']; ?>' class='cloud-zoom-gallery' rel="useZoom: 'zoom1', smallImage: 'images/products/img01.jpg' "><img src="admin/<?php echo $result['product_img']; ?>" alt = "Thumbnail 2"/></a></li>
                
              </ul>
            </div>
            
            <!-- end: more-images --> 
            
          </div>
          <div class="col-xs-12 col-sm-7 col-lg-7 col-md-7 product-details-area">
       
              <div class="product-name">
                <h1><?php echo $result['title']; ?></h1>
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
              <div class="ratings">
                <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Your Review</a> </p>
                <p class="availability in-stock pull-right">Availability: <span>In Stock</span></p>
              </div>
              <div class="short-description">
                <?php echo $result['short_desc']; ?>
              </div>
           
              <div class="product-variation">


                <form action="" method="post">
                  <div class="cart-plus-minus">
                    <label for="qty">Qty:</label>
                    <div class="numbers-row">
                      <div onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) result.value--;return false;" class="dec qtybutton"><i class="fa fa-minus">&nbsp;</i></div>
                      <input type="text" class="qty" title="Qty" value="1" maxlength="12" id="qty" name="quantity">
                      <div onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="inc qtybutton"><i class="fa fa-plus">&nbsp;</i></div>
                    </div>
                  </div>
                  <button class="button pro-add-to-cart" title="Add to Cart" type="submit"><span><i class="fa fa-shopping-cart"></i> Add to Cart</span></button>
                </form>


              </div>
              <div class="product-cart-option">
                <ul>
                  <li><a href="#"><i class="fa fa-heart"></i><span>Add to Wishlist</span></a></li>
                  <li><a href="#"><i class="fa fa-retweet"></i><span>Add to Compare</span></a></li>
                  <li><a href="#"><i class="fa fa-envelope"></i><span>Email Friend</span></a></li>
                </ul>
          
            </div>
          </div>
        </div>
          <div class="product-overview-tab">
   			<div class="product-tab-inner"> 
              <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                <li class="active">
                	<a href="#description" data-toggle="tab"> Description </a> 
                </li>
                <li> 
                	<a href="#reviews" data-toggle="tab">Reviews</a> 
                </li>
               
              </ul>
              <div id="productTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="description">
                  <div class="std">
                    <?php echo $result['full_desc']; ?>
                  </div>
                </div>
                
                
                  <div id="reviews" class="tab-pane fade">
							<div class="col-sm-5 col-lg-5 col-md-5">
								<div class="reviews-content-left">
									<h2>Customer Reviews</h2>
									<div class="review-ratting">
									<p><a href="#">Amazing</a> Review by Company</p>
									<table>
										<tbody><tr>
											<th>Price</th>
											<td>
												<div class="rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
											</td>
										</tr>
										<tr>
											<th>Value</th>
											<td>
												<div class="rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
											</td>
										</tr>
										<tr>
											<th>Quality</th>
											<td>
												<div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
											</td>
										</tr>
									</tbody></table>
									<p class="author">
										Angela Mack<small> (Posted on 16/12/2015)</small>
									</p>
									</div>
                                    
                                    
                                    <div class="review-ratting">
									<p><a href="#">Good!!!!!</a> Review by Company</p>
									<table>
										<tbody><tr>
											<th>Price</th>
											<td>
												<div class="rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
											</td>
										</tr>
										<tr>
											<th>Value</th>
											<td>
												<div class="rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
											</td>
										</tr>
										<tr>
											<th>Quality</th>
											<td>
												<div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
											</td>
										</tr>
									</tbody></table>
									<p class="author">
										Lifestyle<small> (Posted on 20/12/2015)</small>
									</p>
									</div>
                                    
                                    
                                    <div class="review-ratting">
									<p><a href="#">Excellent</a> Review by Company</p>
									<table>
										<tbody><tr>
											<th>Price</th>
											<td>
												<div class="rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
											</td>
										</tr>
										<tr>
											<th>Value</th>
											<td>
												<div class="rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
											</td>
										</tr>
										<tr>
											<th>Quality</th>
											<td>
												<div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
											</td>
										</tr>
									</tbody></table>
									<p class="author">
										Jone Deo<small> (Posted on 25/12/2015)</small>
									</p>
									</div>
                                    
								</div>
							</div>
							<div class="col-sm-7 col-lg-7 col-md-7">
								<div class="reviews-content-right">
									<h2>Write Your Own Review</h2>
									<form>
										<h3>You're reviewing: <span>Donec Ac Tempus</span></h3>
										<h4>How do you rate this product?<em>*</em></h4>
                                        <div class="table-responsive reviews-table">
										<table>
											<tbody><tr>
												<th></th>
												<th>1 star</th>
												<th>2 stars</th>
												<th>3 stars</th>
												<th>4 stars</th>
												<th>5 stars</th>
											</tr>
											<tr>
												<td>Quality</td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
											</tr>
											<tr>
												<td>Price</td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
											</tr>
											<tr>
												<td>Value</td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
											</tr>
										</tbody></table></div>
										<div class="form-area">
											<div class="form-element">
												<label>Nickname <em>*</em></label>
												<input type="text">
											</div>
											<div class="form-element">
												<label>Summary of Your Review <em>*</em></label>
												<input type="text">
											</div>
											<div class="form-element">
												<label>Review <em>*</em></label>
												<textarea></textarea>
											</div>
											<div class="buttons-set">
												<button class="button submit" title="Submit Review" type="submit"><span><i class="fa fa-thumbs-up"></i> &nbsp;Review</span></button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
            
              </div>
            </div>
          </div>
        </div>
		<?php } } ?>

		<?php include 'inc/sidebar.php'; ?>
        
      </div>
    </div>
  </div>
  
  <!-- Main Container End --> 
 


<!-- Related Product Slider -->
  
  <div class="container">
  <div class="row">
  <div class="col-xs-12">
   <div class="related-product-area">       
 <div class="page-header">
        <h2>Related Products</h2>
      </div>
      <div class="related-products-pro">
                <div class="slider-items-products">
                  <div id="related-product-slider" class="product-flexslider hidden-buttons">
                    <div class="slider-items slider-width-col4 fadeInUp">
						
					<?php 
			          $query = "SELECT tbl_product.*, tbl_subcategory.* FROM tbl_product
		               INNER JOIN tbl_subcategory ON tbl_product.sub_catid = tbl_subcategory.id";
			          $relatedproduct = $db->select($query);
			          if ($relatedproduct) {
			              while ($result = $relatedproduct->fetch_assoc()) {
			          
			        ?>
                      <div class="product-item">
                        <div class="item-inner fadeInUp">
                          <div class="product-thumbnail">
                            <div class="pr-img-area"> <img style="height: 250px; width: 250px;" class="first-img" src="admin/<?php echo $result['product_img']; ?>" alt=""> <img style="height: 250px; width: 250px;" class="hover-img" src="admin/<?php echo $result['product_img']; ?>" alt="">
                              <button type="button" class="add-to-cart-mt"> <i class="fa fa-shopping-cart"></i><span> Add to Cart</span> </button>
                            </div>
                            <div class="pr-info-area">
                              <div class="pr-button">
                                <div class="mt-button add_to_wishlist"> <a href="wishlist.php"> <i class="fa fa-heart"></i> </a> </div>
                                <div class="mt-button add_to_compare"> <a href="compare.php"> <i class="fa fa-signal"></i> </a> </div>
                                <div class="mt-button quick-view"> <a href="quick_view.php"> <i class="fa fa-search"></i> </a> </div>
                              </div>
                            </div>
                          </div>
                          <div class="item-info">
                            <div class="info-inner">
                              <div class="item-title"> <a title="Ipsums Dolors Untra" href="single-product.php?proId=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a> </div>
                              <div class="item-content">
                                <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                                <div class="item-price">
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
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                   <?php } } ?>
                    
                    </div>
                  </div>
                </div></div>
        
                </div>
                </div>
              </div>
              </div>
<!-- Related Product Slider End --> 

 <!-- Footer -->
 <?php include 'inc/footer.php'; ?>