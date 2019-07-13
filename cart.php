<?php include 'inc/header.php'; ?>
  <?php 
      if (isset($_GET['delProduct'])) {
          $delProduct = $_GET['delProduct'];
          $delquery = "delete from tbl_cart where id='$delProduct'";
          $deldata = $db->delete($delquery);
          if ($deldata) {
              echo"<span style='color:green;'>Product Delete Successfully</span>";
          }else{
              echo"<span style='color:green;'>Product not Delete</span>";
          }
      }

  ?>
<?php
    if (!isset($_GET['id'])) {
      echo "<meta http-equiv='refresh' content='0;URL=?id=onlieshop'/>";
    }
?>
  <!-- Main Container -->
  <section class="main-container col1-layout">
    <div class="main container">
      <div class="col-main">
        <div class="cart">
          
          <div class="page-content page-order"><div class="page-title">
            <h2>Shopping Cart</h2>
          </div>
            <?php 
              if($_SERVER['REQUEST_METHOD']=='POST'){
                $cartId   = $_POST['id'];
                $quantity   = $_POST['quantity'];

                $cartId = mysqli_real_escape_string($db->link , $cartId);
                $quantity = mysqli_real_escape_string($db->link , $quantity);
                
                $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE id ='$cartId'";
                  $updated_row = $db->update($query);
                  if($updated_row){
                    echo "Cart Update Successfully";
                  }else {
                    echo "<script>window.location='cart.php';</script>";
                  }
                  
                  if ($quantity <= 0) {
                    $cartId   = $_POST['id'];
                    $quantity   = 1;

                    $cartId = mysqli_real_escape_string($db->link , $cartId);
                    $quantity = mysqli_real_escape_string($db->link , $quantity);
                    
                    $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE id ='$cartId'";
                      $updated_row = $db->update($query);
                      if($updated_row){
                        echo "Cart Update Successfully";
                      }else {
                        echo "<script>window.location='cart.php';</script>";
                      }
                  }
                
              }

            ?>
            
            <div class="order-detail-content">
              <div class="table-responsive">
                <table class="table table-bordered cart_summary">
                  <thead>
                    <tr>
                      <th class="cart_product">Product</th>
                      <th>Description</th>
                      <th>Unit price</th>
                      <th>Qty</th>
                      <th>Total</th>
                      <th  class="action"><i class="fa fa-trash-o"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sId = session_id();
                      $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
                      $cartpro = $db->select($query);
                      if ($cartpro) {
                         $qun = 0;
                        $sum = 0;
                          while ($result = $cartpro->fetch_assoc()) {

                     ?>
                    <tr>
                      <td class="cart_product"><a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="Product"></a></td>
                      <td class="cart_description"><p class="product-name"><?php echo $result['ProName']; ?></p>
                      <td class="price"><span>৳ <?php echo $result['price']; ?></span></td>
                      <td class="qty">
                        <form action="" method="post">
                          <input type="hidden" name="id" value="<?php echo $result['id']; ?>"/>
                          <input class="form-control input-sm" name="quantity" type="number" value="<?php echo $result['quantity']; ?>">
                          
                        </form>
                      </td>
                      <td class="price"><span>৳ <?php
                       $total = $result['price'] * $result['quantity']; 
                       echo $total;
                       ?></span></td>
                      <td class="action"><a onclick="return confirm('Are you sure to delete product');" href="?delProduct=<?php echo $result['id']; ?>"><i class="icon-close"></i></a></td>
                    </tr>
                    <?php 
                      $quantity = $qun + $result['quantity'];
                      Session::set("quantity", $quantity);
                   ?>

                    <?php
                      $sum = $sum + $total;
                      Session::set("sum", $sum);

                     ?>
                    <?php } } ?>

                  </tbody>
                   <?php
                      $sId = session_id();
                      $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
                      $cartpro = $db->select($query);
                      if ($cartpro) {
                    ?>
                  <tfoot>
                    <tr>
                      <td colspan="2" rowspan="2"></td>
                      <td colspan="3">Total products (tax 5%.)</td>
                      <td colspan="2"><?php
                        $vat = $sum * 0.05;
                        echo $vat;
                       ?></td>
                    </tr>
                    <tr>
                      <td colspan="3"><strong>Total</strong></td>
                      <td colspan="2"><strong><?php
                        $total = $sum + $vat;
                        echo $total;
                       ?></strong></td>
                    </tr>
                  </tfoot>
                  <?php } ?>
                </table>
              </div>
              <div class="cart_navigation"> <a class="continue-btn" href="product.php"><i class="fa fa-arrow-left"> </i>&nbsp; Continue shopping</a> <a class="checkout-btn" href="checkout.php"><i class="fa fa-check"></i> Proceed to checkout</a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
   <!-- Footer -->
  <?php include 'inc/footer.php'; ?>