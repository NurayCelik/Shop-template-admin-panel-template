<?php 
$filepath= realpath(dirname(__FILE__));//http://localhost/shop olan url kısım. daha kolay ulaşılsın diye yazıldı. Yoksa admin kısım rahat classlara ulaşırken diğer bölümler erişemiyor.
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 
?>
 
<?php
class Brand{
	private $db;  // I crate Property for Database Class
	private $fm; // I crate Property for Format Class  
 
    public function __construct(){
       $this->db   = new Database(); // I crate Object for Database Class
       $this->fm   = new Format(); // I crate Object for Format Class  
	}

	public function brandInsert($brandName){  // Our method with id 
	  	$brandName = $this->fm->validation($brandName);
	    $brandName =  mysqli_real_escape_string($this->db->link, $brandName );
	 
	    if (empty($brandName)) { // validation for empty check 
	    	 $msg = "Brand Field must not be empty";
	    	 return $msg;
	    	}else {
	    		$query = "INSERT INTO tbl_brand(brandName) VALUES ('$brandName')"; // Insert Query 
	    		$brandinsert = $this->db->insert($query);
	    		if ($brandinsert) {
	    			$msg = "<span class='success'>Brand Inserted Successfully.</span> ";
	    			return $msg; // return Message 
	    		}else {
	    			$msg = "<span class='error'>Brand Not Inserted .</span> ";
	    			return $msg; // return Message 
	    		}
	    	}
	  }

	  public function getAllBrand(){ 
       	$query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
         $result = $this->db->select($query);
         return $result; 
       }

    public function getUpdatetById($id){
     	$query = "SELECT * FROM tbl_brand WHERE brandId ='$id' ";
         $result = $this->db->select($query);
         return $result;
     }


     public function brandUpdate($brandName, $id){
 
     $brandName = $this->fm->validation($brandName);
     $brandName =  mysqli_real_escape_string($this->db->link, $brandName );
     $id =  mysqli_real_escape_string($this->db->link, $id );
 
     if (empty($brandName)) {  // Check empty filed 
    	 $msg = "<span class='error'>Brand Field Must Not be empty.</span> ";
    	 return $msg;
 
     }else {
	 $query = "UPDATE tbl_brand
            SET
            brandName = '$brandName'
            WHERE brandId = '$id' ";
            $update_row  = $this->db->update($query);
            if ($update_row) {
            	$msg = "<span class='success'>Brand Updated Successfully.</span> ";
            	return $msg; // return message 
            }else {
            	$msg = "<span class='error'>Brand Not Updated .</span> ";
    			return $msg; // return message 
            }
 
     }
 
 }

 public function delBrandById($id){
          $query = "DELETE FROM tbl_brand WHERE brandId ='$id' ";
          $branddeldata = $this->db->delete($query);
          if ($branddeldata) {
            $msg = "<span class='success'>Brand Deleted Successfully.</span> ";
          return $msg; // return this message 
          }else {
            $msg = "<span class='error'>Brand Not Deleted .</span> ";
                 return $msg; // return this message 
            }
    }

    public function getCopyById(){
        $query = "SELECT * FROM tbl_copy";
         $result = $this->db->select($query);
         return $result;
    }


    public function footerUpdate($copyRight){
        $copyRight = $this->fm->validation($copyRight);
     $copyRight =  mysqli_real_escape_string($this->db->link, $copyRight );
     if (empty($copyRight)) {  // Check empty filed 
       $msg = "<span class='error'>Footer Field Must Not be empty.</span> ";
       return $msg;
 
     }else {
   $query = "UPDATE tbl_copy
            SET
            copyRight = '$copyRight'
            WHERE id = '1' ";
            $update_row  = $this->db->update($query);
            if ($update_row) {
              $msg = "<span class='success'>Footer Updated Successfully.</span> ";
              return $msg; // return message 
            }else {
              $msg = "<span class='error'>Footer Not Updated .</span> ";
          return $msg; // return message 
            }
 
     }

    }
    public function getSocialById(){

       $query = "SELECT * FROM tbl_social";
         $result = $this->db->select($query);
         return $result;

    }
    public function socialUpdate($fb, $tw, $ln, $go){

      $fb = $this->fm->validation($fb);
      $tw = $this->fm->validation($tw);
      $ln = $this->fm->validation($ln);
      $go = $this->fm->validation($go);

      $fb =  mysqli_real_escape_string($this->db->link, $fb );
      $tw =  mysqli_real_escape_string($this->db->link, $tw );
      $ln =  mysqli_real_escape_string($this->db->link, $ln );
      $go =  mysqli_real_escape_string($this->db->link, $go );


       if (empty($fb)) {  // Check empty filed 
         $msg = "<span class='error'>Social Field Must Not be empty.</span> ";
         return $msg;
   
     }else {
      $query = "UPDATE tbl_social
            SET
            fb = '$fb',
            tw = '$tw',
            ln = '$ln',
            go = '$go'
            WHERE id = '1' ";
            $update_row  = $this->db->update($query);
            if ($update_row) {
              $msg = "<span class='success'>Social Updated Successfully.</span> ";
              return $msg; // return message 
            }else {
              $msg = "<span class='error'>Social Not Updated .</span> ";
          return $msg; // return message 
            }
 
     }
}

    public function getAllimage(){

      $query = "SELECT * FROM tbl_slider";
             $result = $this->db->select($query);
             return $result;
    }


    public function sliderInsert($data, $file){

      $title   =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['title'])));
      $status  =  mysqli_real_escape_string($this->db->link, $data['status'] );
    
 
     $permited = array('jpg','png','jpeg','gif');
     $file_name = $file['image']['name'];
     $file_size = $file['image']['size'];
     $file_temp = $file['image']['tmp_name'];
 
     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
     $uploaded_image = "upload/".$unique_image;
     if ($title == "" || $status == "") {
      $msg = "<span class='error'>Field Must Not be empty .</span> ";
          return $msg;
     }else{
          move_uploaded_file($file_temp, $uploaded_image);
          $query = "INSERT INTO tbl_slider(title, image, status) 
          VALUES ('$title','$uploaded_image','$status')";  
 
          $inserted_row = $this->db->insert($query);
          if ($inserted_row) {
          $msg = "<span class='success'>Slider Inserted Successfully.</span> ";
          return $msg; // return message 
        }else {
          $msg = "<span class='error'>Slider Not Inserted .</span> ";
          return $msg; // return message 
        } 
     }

    }
    public function getSliderById($id){
      $query = "SELECT * FROM tbl_slider WHERE id ='$id' ";
             $result = $this->db->select($query);
             return $result;
   }

    public function sliderUpdate($data, $file, $id){
 
    $title   =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['title'])));
    $status  =  mysqli_real_escape_string($this->db->link, $data['status'] );
 
     $permited = array('jpg','png','jpeg','gif');
     $file_name = $file['image']['name'];
     $file_size = $file['image']['size'];
     $file_temp = $file['image']['tmp_name'];
 
     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
     $uploaded_image = "upload/".$unique_image;
     if ($title == "" || $status == "") {
      $msg = "<span class='error'>Field Must Not be empty .</span> ";
          return $msg;
     }else {
     if (!empty($file_name)) {
     if ($file_size > 1054589) {
      echo "<span class='error'>Image Size should be less then 1MB .</span>";
     }elseif (in_array($file_ext, $permited) === false) {
      echo "<span class='error'> You can Upload Only".implode(',', $permited)."</span>";
      } else{
          move_uploaded_file($file_temp, $uploaded_image);
          $query = "UPDATE tbl_slider
          SET 
          title   = '$title',
          image     = '$uploaded_image',
          status      = '$status'
          WHERE id = '$id' ";
      
          $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Slider Updated Successfully.</span> ";
          return $msg;
        }else {
          $msg = "<span class='error'>Slider Not Updated .</span> ";
          return $msg;
        } 
     }
 
      } else{
           $query = "UPDATE tbl_slider
          SET 
          title    = '$title',
          type     = '$type'
          WHERE id = '$id' ";
 
          $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Slider Updated Successfully.</span> ";
          return $msg; // return This Message 
        }else {
          $msg = "<span class='error'>Slider Not Updated .</span> ";
          return $msg; // return This Message 
        } 
 
        }
    }
 
  }

    public function delSliderById($id){
       $query = "SELECT * FROM tbl_slider WHERE id = '$id' ";
       $getData = $this->db->select($query);
         if ($getData) {
           while ($delImg = $getData->fetch_assoc()) {
           $dellink = $delImg['image'];
                  unlink($dellink);
            }
          }
       
               $delquery = "DELETE FROM tbl_slider WHERE id = '$id' ";
                $deldata = $this->db->delete($delquery);
            if ($deldata) {
              $msg = "<span class='success'>Slider Deleted Successfully.</span> ";
            return $msg;
            }else {
              $msg = "<span class='error'>Slider Not Deleted .</span> ";
                 return $msg;
              } 
    }

     public function brandBySearch($search){

          $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
           FROM tbl_product
           INNER JOIN tbl_category
           ON tbl_product.catId = tbl_category.catId
           INNER JOIN tbl_brand
           ON tbl_product.brandId = tbl_brand.brandId and brandName like '%$search%' ";
      $result =  $this->db->select($query);
      

       return $result;
    }


    public function getAdminData(){
         $query = "SELECT * FROM tbl_admin";
         $result = $this->db->select($query);
         return $result;

    }
    public function adminUpdate($data, $file){

      $adminName = $this->fm->validation($data['adminName']);
      $adminUser = $this->fm->validation($data['adminUser']);
      $adminEmail = $this->fm->validation($data['adminEmail']);
      $level = $this->fm->validation($data['level']);

      $adminName =  mysqli_real_escape_string($this->db->link, $data['adminName'] );
      $adminUser =  mysqli_real_escape_string($this->db->link, $data['adminUser'] );
      $adminEmail =  mysqli_real_escape_string($this->db->link, $data['adminEmail'] );
      $level =  mysqli_real_escape_string($this->db->link, $data['level'] );

     $permited = array('jpg','png','jpeg','gif');
     $file_name = $file['image']['name'];
     $file_size = $file['image']['size'];
     $file_temp = $file['image']['tmp_name'];
 
     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
     $uploaded_image = "upload/".$unique_image;
     if ($adminName == "" || $adminUser == "" || $adminEmail == "" || $level == "") {
      $msg = "<span class='error'>Field Must Not be empty .</span> ";
          return $msg;
     }else {
     if (!empty($file_name)) {
     if ($file_size > 1054589) {
      echo "<span class='error'>Image Size should be less then 1MB .</span>";
     }elseif (in_array($file_ext, $permited) === false) {
      echo "<span class='error'> You can Upload Only".implode(',', $permited)."</span>";
      } else{
          move_uploaded_file($file_temp, $uploaded_image);
          $query = "UPDATE tbl_admin
          SET 
          adminName       = '$adminName',
          adminUser       = '$adminUser',
          adminEmail      = '$adminEmail',
          level           = '$level',
          image           = '$uploaded_image'
          WHERE  adminId =  '1' ";
      
          $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Admin Updated Successfully.</span> ";
          return $msg;
        }else {
          $msg = "<span class='error'>Admin Not Updated .</span> ";
          return $msg;
        } 
     }
 
      } else{
           $query = "UPDATE tbl_admin
          SET 
          adminName       = '$adminName',
          adminUser       = '$adminUser',
          adminEmail      = '$adminEmail',
          level           = '$level'
          WHERE adminId = '1' ";
 
          $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Admin Updated Successfully.</span> ";
          return $msg; // return This Message 
        }else {
          $msg = "<span class='error'>Admin Not Updated .</span> ";
          return $msg; // return This Message 
        } 
 
        }
    }

 }


}
?>