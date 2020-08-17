<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php';  ?>
 
 <?php
  if (!isset($_GET['catid'])  || $_GET['catid'] == NULL ) { // get this ID as catid
     echo "<script>window.location = 'catlist.php';  </script>"; // we transfer to catlist.php page
  }else {
    $id = $_GET['catid']; // Get this id from catadd.php and take this on $id variable.
  }
 ?>  
 
 
 <?php 
   $cat =  new Category();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['catName'];
        
        $updateCat = $cat->catUpdate($catName, $id); // Here with category object i create one method
    }

?>
         <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 

                <?php
        if (isset($updateCat)) {
         echo $updateCat;
            }
   ?>
                
      <?php 
        $getCat = $cat->getCatById($id); // With category object i create one method with also id
        if ($getCat) {
          while ($result = $getCat->fetch_assoc()) {
       
     ?>
                <form action="" method="post">
                    <table class="form">                    
                        <tr>
                            <td>
    <input type="text" name="catName"  value="<?php echo $result['catName']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php    }  }  // Close if condition and while loop.?>   
 
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>