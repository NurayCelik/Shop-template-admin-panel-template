<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?> 

<?php
 $fm = new Format(); 
 $brand =  new Brand(); 
 if (isset($_GET['delslider'])) {
	 $id = $_GET['delslider'];
	 $delslider = $brand->delSliderById($id);
} 
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
        <?php
	         if (isset($delslider)) {
	          echo  $delslider;
	         }
        ?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Slider Durum</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>

				<?php 
				   $brand =  new Brand();
		           $getImg = $brand->getAllimage();  
		           if ($getImg) {
		           	$i = 0;
		          while ($result = $getImg->fetch_assoc() ) {
		          	$i++;
                    
                ?>

				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['title']; ?></td>
					<td><img src="<?php echo $result['image']; ?>" height="40px" width="60px"/></td>	
					<td><?php 
 
						 if ($result['status'] == 0) { 
						        echo "Aktif Olsun";
							 }else {
							     echo "Aktif Olmasın";
								 } ?>
					</td>			
					<td>
						<a href="slideredit.php?sliderid=<?php echo $result['id']; ?>">Edit</a> || 
						<a onclick="return confirm('Are you sure to delete')"
	  href="?delslider=<?php echo $result['id']; ?>">Delete</a> 
					</td>
					</tr>
				<?php  }  } ?>	
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
