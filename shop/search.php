<?php include 'inc/header.php'; ?>

 <?php
  if (!isset($_GET['search'])  || $_GET['search'] == NULL ) {
     echo "<script>window.location = '404.php';  </script>";
  }else {
    $search = $_GET['search']; // here i get this id and take this with one variable. 
  }
 ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		 
         	    </div>
            		<div class="clear"></div>
            	</div>
        	     <div class="section group">
                <h2>ARAMA SONUÇLARI</h2>
 
     <?php
       $productbySearch = $pd->productBySearch($search); // Create this method in our Product.php Class 
        if ($productbySearch) {
       while ($result = $productbySearch->fetch_assoc()) {
           
       ?>
       <div class="grid_1_of_4 images_1_of_4">
       <a href="preview.php?proid=<?php echo $result['productId']; ?>">
       <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
       <h2><?php echo $result['productName']; ?> </h2>
        <p><?php echo $fm->textShorten($result['body'], 60); ?></p>
        <p><span class="price">$<?php echo $result['price']; ?></span></p>
        <div class="button"><span><a href="preview.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
      		 </div>
           <div class="clearfix"></div>
      	 <?php    
            } 
              }
        
   
   ?> 
				 
	 	</div>
			</div>

     
     
              
        <?php 
          $searchCat = $cat->catBySearch($search); // Create this method in Category.php class 
          if ($searchCat) { ?>


      <div class="">
      <h2>CATEGORIES</h2>

       <ul>
        <?php
         while ($result = $searchCat->fetch_assoc()) {
                  
         ?> 
         <li><a href="productbycat.php?catId=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?>  - Please click...</a></li>
           <?php }  }  ?> 
                     
             </ul>
          
            </div>
            <br>
            <br>
            <br>
	


        <?php 
          $brand = new Brand();
          $searchBrand = $brand->brandBySearch($search); // Create this method in Category.php class 
          if ($searchBrand) { ?>


      
      
    <?php
         while ($result = $searchBrand->fetch_assoc()) {
                  
         ?> 
         <div class="" style="height: 600px;">
         <div class="grid images_3_of_2">
          
           <img src="admin/<?php echo $result['image']; ?>" alt="" width="300px;" height="300px;" /> 
        </div>
        <div class="desc span_3_of_2">
           <h2>Brand:<span><?php echo $result['brandName'];?></span></h2>
           <p>Ürün İsmi: <?php echo $result['productName'];?> </p>
            <p><?php echo $fm->textShorten($result['body'], 200);?></p>
         <div class="price">
           <p>Price: <span>$<?php echo $result['price'];?></span></p>
           <p>Category: <span><?php echo $result['catName'];?></span></p>
           
         </div>
          </div> <br>
            <br>
            <br>          
          <div class="clear"></div>

           <?php }  }  ?> 

	
    </div>
  </div>

   <?php include 'inc/footer.php'; ?>