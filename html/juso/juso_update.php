	<?
	include "common.php";
	
	$no=$_REQUEST[no];
	$name=$_REQUEST[name];
	$tel1=$_REQUEST[tel1];
	$tel2=$_REQUEST[tel2];
	$tel3=$_REQUEST[tel3];
	$sm=$_REQUEST[sm];
	$birthday1=$_REQUEST[birthday1];
	$birthday2=$_REQUEST[birthday2];
	$birthday3=$_REQUEST[birthday3];
	$juso=$_REQUEST[juso];
	
	$tel=sprintf("%-3s%-4s%-4s",$tel1,$tel2,$tel3);
	$birthday=sprintf("%04d-%02d-%02d",$birthday1,$birthday2,$birthday3);

	$query="update juso set name8='$name', tel8='$tel',sm8=$sm, birthday8='$birthday',
	juso8='$juso' where no8=$no;";
	$result=mysqli_query($db,$query);
	if(!$result) exit("����:$query");

	echo("<script>location.href='juso_list.php'</script>");
	?>