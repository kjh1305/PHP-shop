<?
if ($_FILES["image1"]["error"]==0)
{
	$fname1=$_FILES["image1"]["name"];
	$fsize1=$_FILES["image1"]["size"];
	
	if(!move_uploaded_file($_FILES["image1"]["tmp_name"],
		"../product/".$fname1)) exit("업로드 실패");

}
if ($_FILES["image2"]["error"]==0)
{
	$fname2=$_FILES["image2"]["name"];
	$fsize2=$_FILES["image2"]["size"];
	
	if(!move_uploaded_file($_FILES["image2"]["tmp_name"],
		"../product/".$fname2)) exit("업로드 실패");

}
if ($_FILES["image3"]["error"]==0)
{
	$fname3=$_FILES["image3"]["name"];
	$fsize3=$_FILES["image3"]["size"];
	
	if(!move_uploaded_file($_FILES["image3"]["tmp_name"],
		"../product/".$fname3)) exit("업로드 실패");

}

	include "../common.php";

	$menu=$_REQUEST[menu];
	$code=$_REQUEST[code];
	$name=$_REQUEST[name];
	$coname=$_REQUEST[coname];
	$price=$_REQUEST[price];
	$opt1=$_REQUEST[opt1];
	$opt2=$_REQUEST[opt2];
	$content=$_REQUEST[contents];
	$status=$_REQUEST[status];
	$icon_new=$_REQUEST[icon_new];
	$icon_hit=$_REQUEST[icon_hit];
	$icon_sale=$_REQUEST[icon_sale];
	$discount=$_REQUEST[discount];
	$regday1=$_REQUEST[regday1];
	$regday2=$_REQUEST[regday2];
	$regday3=$_REQUEST[regday3];

	$regday=sprintf("%04d-%02d-%02d",$regday1,$regday2,$regday3);
	
	$name=addslashes($name);
	$content=addslashes($content);

	if(!$icon_new) $icon_new=0; else $icon_new=1;
	if(!$icon_hit) $icon_hit=0; else $icon_hit=1;
	if(!$icon_sale) $icon_sale=0; else $icon_sale=1;
	
			

	$query="insert into  product (menu8, code8, name8, coname8, price8, opt18, opt28, content8, status8, icon_new8, icon_hit8, icon_sale8, discount8, regday8, image18, image28, image38)
				values ('$menu', '$code', '$name', '$coname', '$price','$opt1','$opt2','$content',$status,$icon_new,$icon_hit,$icon_sale,'$discount','$regday','$fname1','$fname2','$fname3');";
	
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러:$query");

	echo("<script>location.href='product.php'</script>");

	?>
	