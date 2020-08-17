<?php include 'inc/header.php'; ?>

 <?php
  if (!isset($_GET['catId'])  || $_GET['catId'] == NULL ) {
     echo "<script>window.location = '404.php';  </script>";
  }else {
    $id = $_GET['catId']; // here i get this id and take this with one variable. 
  }
 ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<?php
          $productbycat = $pd->productByOnlyCat($id); // Create one method on Product.php Class 
          if ($productbycat) {
           while ($result = $productbycat->fetch_assoc()) {
           ?> 
 
	<h3>Latest from <?php echo $result['catName']; ?> </h3> 
 	    <?php    } } ?> 
    		</div>
    		<div class="clear"></div>
    	</div>
	     <div class="section group">
 
     <?php
       $productbycat = $pd->productByCat($id); // Create this method in our Product.php Class 
        if ($productbycat) {
       while ($result = $productbycat->fetch_assoc()) {
           
       ?>
 <div class="grid_1_of_4 images_1_of_4">
 <a href="preview.php?proid=<?php echo $result['productId']; ?>">
 <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
 <h2><?php echo $result['productName']; ?> </h2>
  <p><?php echo $fm->textShorten($result['body'], 60); ?></p>
  <p><span class="price">$<?php echo $result['price']; ?></span></p>
  <div class="button"><span><a href="preview.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
		 </div>
	 <?php    } } else {
		 header("Location:404.php");
            // echo "Products of this category are not available";
 
	 }  ?> 
				 
	 	</div>
			</div>

	
	
    </div>
 </div>
</div>
   <?php include 'inc/footer.php'; ?>