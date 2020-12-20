<?
	include "common.php";
	
	$cookie_no=$_COOKIE[cookie_no];
	$cookie_uid=$_COOKIE[cookie_uid];
	$pwd1=$_REQUEST[pwd1];
	$name=$_REQUEST[name];
	$birthday1=$_REQUEST[birthday1];
	$birthday2=$_REQUEST[birthday2];
	$birthday3=$_REQUEST[birthday3];
	$sm=$_REQUEST[sm];
	$tel1=$_REQUEST[tel1];
	$tel2=$_REQUEST[tel2];
	$tel3=$_REQUEST[tel3];
	$phone1=$_REQUEST[phone1];
	$phone2=$_REQUEST[phone2];
	$phone3=$_REQUEST[phone3];
	$email=$_REQUEST[email];
	$zip=$_REQUEST[zip];
	$juso=$_REQUEST[juso];
	
	$tel=sprintf("%-3s%-4s%-4s",$tel1,$tel2,$tel3);
	$phone=sprintf("%-3s%-4s%-4s",$phone1,$phone2,$phone3);
	$birthday=sprintf("%04d-%02d-%02d",$birthday1,$birthday2,$birthday3);
	
	
	if(!$pwd1)
			$query="update member set uid8='$uid', name8='$name', birthday8='$birthday', sm8=$sm, tel8='$tel', phone8='$phone', email8='$email', zip8='$zip',juso8='$juso' where no8=$cookie_no;";
	else
			$query="update member set uid8='$uid', pwd8='$pwd1', name8='$name', birthday8='$birthday', sm8=$sm, tel8='$tel', phone8='$phone', email8='$email', zip8='$zip',juso8='$juso' where no8=$cookie_no;";
	
	
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러:$query");

	echo("<script>location.href='main.php'</script>");
?>
	