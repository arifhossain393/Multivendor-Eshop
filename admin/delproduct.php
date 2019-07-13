<?php
    include '../lib/Session.php';
    Session::checkSession();
    include '../config/config.php';
    include '../lib/Database.php';
    include '../helpers/Formate.php';

    $db = new Database();
?>

<?php 
	    if (!isset($_GET['delId']) || $_GET['delId'] == NULL) {
	        header("location:products.php");
	    }else {
	        $delId = $_GET['delId'];

	        $query = "SELECT * FROM tbl_product WHERE id = '$delId'";
	        $getData = $db->select($query);
	        if ($getData) {
	        	while ($delimg = $getData->fetch_assoc()) {
	        	    $delink = $delimg['product_img'];
	        	    unlink($delink);
	        	}
	        }

	        $delquery = "DELETE FROM tbl_product WHERE id = '$delId'";
	        $delproduct = $db->delete($delquery);
	        if ($delproduct) {
	        	echo "<script>alert('Product Delete Successfully');</script>";
	        	header('location:products.php');
	        }else {
	        	echo "<script>alert('Product Delete Not Successfully');</script>";
	        	header('location:products.php');
	        }

	    }

    ?>