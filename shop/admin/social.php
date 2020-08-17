<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';  ?> 

<?php 
   $brand =  new Brand();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fb = $_POST['fb'];
        $tw = $_POST['tw'];
        $ln = $_POST['ln'];
        $go = $_POST['go'];
        
        $updateSocial = $brand->socialUpdate($fb, $tw, $ln, $go);
    }
 
 ?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <div class="block"> 

            <?php 
                if (isset($updateSocial)) { 
                    echo $updateSocial;
                }
            ?>


        <?php 

        $brand =  new Brand();
        $getSocial = $brand->getSocialById(); 
        if ($getSocial) {
           while ($result = $getSocial->fetch_assoc()) {
           
?>

         <form action="" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <label>Facebook</label>
                    </td>
                    <td>
                        <input type="text" name="fb" value="<?php echo $result['fb']; ?>" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Twitter</label>
                    </td>
                    <td>
                        <input type="text" name="tw" value="<?php echo $result['tw']; ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>LinkedIn</label>
                    </td>
                    <td>
                        <input type="text" name="ln" value="<?php echo $result['ln']; ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>Google Plus</label>
                    </td>
                    <td>
                        <input type="text" name="go" value="<?php echo $result['go']; ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>

        <?php    }  }  ?>

        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>