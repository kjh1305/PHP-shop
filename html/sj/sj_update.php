<?
	include "common.php";
	
	$no=$_REQUEST[no];
	$name=$_REQUEST[name];
	$kor=$_REQUEST[kor];
	$eng=$_REQUEST[eng];
	$mat=$_REQUEST[mat];
	$hap=$_REQUEST[hap];
	$avg=$_REQUEST[avg];

	$query="update sj set name8='$name', kor8=$kor,eng8=$eng, mat8=$mat,
	hap8=$hap, avg8=$avg where no8=$no;";
	$result=mysqli_query($db,$query);
	if(!$result) exit("¿¡·¯:$query");

	echo("<script>location.href='sj_list.php'</script>");
	?>