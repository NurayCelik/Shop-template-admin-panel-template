<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php';  ?>
<?php include '../classes/Category.php';  ?>
<?php include '../classes/Brand.php';  ?>
 
<?php 
 if (!isset($_GET['sliderid'])  || $_GET['sliderid'] == NULL ) {
     echo "<script>window.location = 'slideredit.php';  </script>";
  }else {
    $id = $_GET['sliderid']; // get this id from productlist.php page and take this with one variable as $id 
 
  }
 
   $brand =  new Brand(); // Create object for Product Class 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) ) {
       $updateSlider = $brand->sliderUpdate($_POST, $_FILES, $id); // This method is for update data 
    }
 
?> 
 
<div class="grid_10">
    <div class="box round first grid">
        <h2>:Update Slider</h2>
        <div class="block">  
 
<?php 
if (isset($updateSlider)) {  // Show update data message 
   echo $updateSlider;
   header("refresh:3;sliderlist.php"); 
}
 
?>
 
   <?php 
     $getSlide = $brand->getSliderById($id);  // in our product class i create one method with id 
     if ($getSlide) {
        while ($value = $getSlide->fetch_assoc()) {
            # code...
          ?>
 
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                      <input type="text" name="title" value="<?php echo $value['title']; ?>" class="medium" />
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
                    <td>
                        <label>Slider Select</label>
                    </td>
                    <td>
                        <select id="select" name="status">
                            <option>Select </option>
                          <?php
                        if ($value['status'] == 0) { ?>
                           <option selected = "selected" value="0">Aktif</option>
                            <option value="1">Aktif Değil</option>
                       <?php } else {  ?>
 
                            <option value="0">Aktif</option>
                            <option selected = "selected" value="1">Aktif Değil</option>
                        <?php }  ?>
                        </select>
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
