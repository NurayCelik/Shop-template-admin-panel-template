<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php';  // Include Category Class ?> 

<?php 
 $cat =  new Category(); // Create Object for Category Class and take this with one variable as $cat
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['catName']; // here i add our input filed name 
        $insertCat = $cat->catInsert($catName); // with this Category object i access one method. 
    }
?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 

<?php
 if (isset($insertCat)) { // showing this return $msg
 echo $insertCat;
    }
  ?>

                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>