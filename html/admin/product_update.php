<?
	
	$checkno1=$_REQUEST[checkno1];
	$checkno2=$_REQUEST[checkno2];
	$checkno3=$_REQUEST[checkno3];
	
	if($checkno1==null) $checkno1=0;
	else $checkno1=1;
	if($checkno2==null) $checkno2=0;
	else $checkno2=1;
	if($checkno3==null) $checkno3=0;
	else $checkno3=1;

	$fname1=$imagename1;
	if($checkno1=="1") $fname1="";
	else
	if ($_FILES["image1"]["error"]==0)
{
	$fname1=$_FILES["image1"]["name"];
	
	if(!move_uploaded_file($_FILES["image1"]["tmp_name"],
		"../product/".$fname1)) exit("업로드 실패");

}
	$fname2=$imagename2;
	if($checkno2=="1") $fname2="";
	else
	if ($_FILES["image2"]["error"]==0)
{
	$fname2=$_FILES["image2"]["name"];
	if(!move_uploaded_file($_FILES["image2"]["tmp_name"],
		"../product/".$fname2)) exit("업로드 실패");

}
	$fname3=$imagename3;
	if($checkno3=="1") $fname3="";
	if ($_FILES["image3"]["error"]==0)
{
	$fname3=$_FILES["image3"]["name"];
	if(!move_uploaded_file($_FILES["image3"]["tmp_name"],
		"../product/".$fname3)) exit("업로드 실패");

}


	include "../common.php";
	$sel1=$_REQUEST[sel1];
	$sel2=$_REQUEST[sel2];
	$sel3=$_REQUEST[sel3];
	$sel4=$_REQUEST[sel4];
	$text1=$_REQUEST[text1];
	$page=$_REQUEST[page];
	$no=$_REQUEST[no];
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

	if($icon_new==null) $icon_new = 0;
	else $icon_new = 1;
	if($icon_hit==null) $icon_hit = 0;
	else $icon_hit = 1;
	if($icon_sale==null) $icon_sale = 0;
	else $icon_sale = 1;
	
			$query="update product set menu8='$menu', code8='$code', name8='$name', coname8='$coname', price8='$price', opt18='$opt1', opt28='$opt2',content8='$content', status8='$status',
			icon_new8=$icon_new,icon_hit8=$icon_hit,icon_sale8=$icon_sale, discount8='$discount',
			regday8='$regday',image18='$fname1', image28='$fname2', image38='$fname3' where no8=$no;";
	
	
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러:$query");

	echo("<script>location.href='product.php?sel1=$sel1&sel2=$sel2&sel3=$sel3&sel4=$sel4&text1=$text1&page=$page';</script>");
?>
	