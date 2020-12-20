<?
	include "common.php";

	$no=$_REQUEST[no];
	

	$query="delete from juso where no8=$no";
	$result=mysqli_query($db,$query);
	if(!$result) exit("¿¡·¯:$query");

	echo("<script>location.href='juso_list.php'</script>");
?>