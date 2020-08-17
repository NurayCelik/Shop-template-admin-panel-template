<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';
 $brand =  new Brand();
?>
 <?php 

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) ) {
        $updateAdmin = $brand->adminUpdate($_POST, $_FILES);
    }
 ?>

 
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Admin Profil</h2>
        <div class="block">  
        <?php 
                if (isset($updateAdmin)) { 
                    echo $updateAdmin;
                }
            ?>
                
     <?php 
      
          $getAdmin = $brand->getAdminData(); // Create this method in our User.php Class
          if ($getAdmin) {
           while ($value = $getAdmin->fetch_assoc()) { 
     ?> 
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Admin Name</label>
                    </td>
                    <td>
                      <input type="text" name="adminName" value="<?php echo $value['adminName']; ?>" class="medium" />
                    </td>
        </tr>
        <tr>
                    <td>
                        <label> User Name </label>
                    </td>
                     <td>
                      <input type="text" name="adminUser" value="<?php echo $value['adminUser']; ?>" class="medium" />
                    </td>
        </tr>
        <tr>
                    <td>
                        <label> Admin Email </label>
                    </td>
                   <td>
                      <input type="text" name="adminEmail" value="<?php echo $value['adminEmail']; ?>" class="medium" />
                    </td>
        </tr>
        
       
        <tr>
                    <td>
                        <label>Level</label>
                    </td>
                    <td>
                        <input type="text" name="level" value="<?php echo  $value['level']; ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $value['image'];?>" height="60px;" width="80px;"><br/>
                        <input type="file" name="image" />
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
 
      <?php  } } ?>
 
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>
