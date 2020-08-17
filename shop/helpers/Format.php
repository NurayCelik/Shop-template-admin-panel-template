<?php 

class Format{

  public function validation($data){
  $data1 = trim($data);
  $data2 = stripcslashes($data1);
  $data3 = htmlspecialchars($data2);
  return $data3; // here i return this $data variable so we can use this.
 }
public function textShorten($text, $limit = 400){
	$text1 = $text. "";
	$text2 = substr($text1, 0, $limit);
	$text3 = $text2."...";
	return $text3; 
}	
 public function formatDate($date){
 return date('m.d.Y - H:i:s', strtotime($date));
 }
}
?>
