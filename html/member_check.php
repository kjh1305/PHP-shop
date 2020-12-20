<?
	include "common.php";
	$uid = $_REQUEST[uid];
	$pwd = $_REQUEST[pwd];

	$query="select no8, name8, uid8 from member where uid8='$uid' and pwd8='$pwd'";
	
	$result=mysqli_query($db,$query);
    if(!$result) exit("에러:$query");
    $row=mysqli_fetch_array($result);
    $count=mysqli_num_rows($result);
	
	if($count>0){

	setcookie("cookie_no",$row[no8]);
	setcookie("cookie_name",$row[name8]);
	setcookie("cookie_uid",$row[uid8]);

		echo("<script>location.href='main.php'</script>");
	}
	
	else
		echo("<script>location.href='member_login.php'</script>");
?>