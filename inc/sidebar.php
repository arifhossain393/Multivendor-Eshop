
         <aside class="sidebar col-sm-3 col-xs-12 col-sm-pull-9">
          
          <div class="block special-product">
            <div class="sidebar-bar-title">
              <h3>Special Products</h3>
            </div>
            <div class="block-content">
              <ul>

            <?php 
              $query = "SELECT * FROM tbl_product WHERE type = '4' LIMIT 2";
              $specproduct = $db->select($query);
              if ($specproduct) {
                  while ($result = $specproduct->fetch_assoc()) {
              
            ?>
                <li class="item">
                  <div class="products-block-left"> <a href="single-product.php?proId=<?php echo $result['id']; ?>" title="Sample Product" class="product-image"><img src="admin/<?php echo $result['product_img']; ?>" alt="Sample Product "></a></div>
                  <div class="products-block-right">
                    <p class="product-name"> <a href="single-product.php?proId=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a> </p>
                    
                    <span class="price">৳<?php echo $result['regular_price']; ?></span>
                    <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                  </div>
                </li>
                <?php } } ?>

              </ul>
              <a class="link-all" href="product.php">All Products</a> </div>
          </div>
         
          <!-- <div class="block popular-tags-area ">
            <div class="sidebar-bar-title">
              <h3>Popular Tags</h3>
            </div>
           <div class="tag">
              <ul>
                <li><a href="#">Boys</a></li>
                
              </ul>
            </div> 
          </div>-->
        </aside>