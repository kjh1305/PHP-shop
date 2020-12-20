<?
if ($_FILES["image1"]["error"]==0)
{
	$fname=$_FILES["image1"]["name"];
	$fsize=$_FILES["image1"]["size"];
	
	if(!move_uploaded_file($_FILES["image1"]["tmp_name"],
		"../product/".$fname)) exit("업로드 실패");

}
?>
<?
if ($_FILES["image2"]["error"]==0)
{
	$fname=$_FILES["image2"]["name"];
	$fsize=$_FILES["image2"]["size"];
	
	if(!move_uploaded_file($_FILES["image2"]["tmp_name"],
		"../product/".$fname)) exit("업로드 실패");

}
?>
<?
if ($_FILES["image3"]["error"]==0)
{
	$fname=$_FILES["image3"]["name"];
	$fsize=$_FILES["image3"]["size"];
	
	if(!move_uploaded_file($_FILES["image3"]["tmp_name"],
		"../product/".$fname)) exit("업로드 실패");

}
?>