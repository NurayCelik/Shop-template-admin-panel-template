<?php
include_once('lib/Session.php'); 
Session::init();
include_once('lib/Database.php');
include_once('helpers/Format.php');


spl_autoload_register(function($class){
   include_once "/classes/".$class.".php";
  });
 
  $db = new Database();   // Create Database Class Object 
  $fm = new Format();  // Create Format Class Object 
  $pd = new Product(); // Create Product Class Object 
  $ct = new Cart(); // Create Cart Class Object 
  $cat = new Category();
  $cmr = new User();
 
  
 ?>

<!DOCTYPE html>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="GET">
				    	<input type="text" name="search" placeholder="Search For Product">
				    	<input type="submit" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
						<span class="cart_title">Cart</span>
						<span class="no_product">
							
						<?php 

					   $getData = $ct->checkCartTable(); // create this method in our Cart.php Class 
				       if ($getData) {
				        $sum = Session::get("sum");
				        $qty = Session::get("qty"); // Added product quantity in session get  
				           echo "$".$sum." Qty ".$qty;
				               }else{
				               	echo "(Empty)";
				              }
                
 						?>


								</span>
							</a>
						</div>
			      </div>


			<?php
		       if (isset($_GET['cid'])) {  // i get id as cid.
		       	   $cmrId =  Session::get("cmrId");
		       	   $delDate = $ct->delCustomerCart();//logout olunca sepet bilgileri silineck
		       	   $delComp = $pd->delCompareData($cmrId);
		           Session::destroy();  // destroy this session 
		       }
	        ?>


			   <div class="login">
			 <?php 
				$login =  Session::get("cuslogin");
					 if ($login == false) { ?>
				 <a href="login.php">Login</a>
							
					<?php   }else { ?>
				 <a href="?cid=<?php Session::get('cmrId')?>">Logout</a>

		  <?php } ?> 
		  </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="topbrands.php">Top Brands</a></li>
	  <?php 
        $chkCart = $ct->checkCartTable(); 
        if ($chkCart) { ?>
         <li><a href="cart.php">Cart</a></li>
        <li><a href="payment.php">Payment</a></li>
      <?php  }  ?>


      	<?php 
	        $cmrId =  Session::get("cmrId");
	        $chkOrder = $ct->checkOrder($cmrId); //I create one method in our Cart.php Class 
	        if ($chkOrder) { ?>
	        <li><a href="order.php">Order</a></li> 
      <?php  }  ?>


	  <?php 
		 $login =  Session::get("cuslogin");
		 if ($login == true) { ?>
		 <li><a href="profile.php">Profile</a></li>
	        <?php } 
	  ?>

	   <?php
		     $getPd = $pd->getCompareProduct($cmrId);
		 	   if ($getPd) {?>
			  <li><a href="compare.php">Compare</a></li> 
	  <?php
		}
	  ?>

			<?php
			     $checkwlist = $pd->checkWlistData($cmrId);
			 	   if ($checkwlist) {
			 	   	?>
				  <li><a href="wishlist.php">WishList</a></li> 
		  	<?php
				}
		  	?>

	  <li><a href="contact.php">Contact</a></li>
	  <div class="clear"></div>
	</ul>
</div>
	