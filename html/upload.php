<?
if ($_FILES["filename"]["error"]==0)
{
	$fname=$_FILES["filename"]["name"];
	$fsize=$_FILES["filename"]["size"];
	
	if(!move_uploaded_file($_FILES["filename"]["tmp_name"],
		"product/".$newfname)) exit("업로드 실패");

	echo("파일이름 : $fname<br> 파일크기 : $fsize");
}
?>