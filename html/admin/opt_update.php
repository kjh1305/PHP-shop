	<?
	include "../common.php";
	
	$no1=$_REQUEST[no1];
	$name=$_REQUEST[name];
	
	$query="update opt set name8='$name' where no8=$no1;";
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러:$query");

	echo("<script>location.href='opt.php'</script>");
	?>