<?
	include "common.php";

	$name=$_REQUEST[name];
	$kor=$_REQUEST[kor];
	$eng=$_REQUEST[eng];
	$mat=$_REQUEST[mat];
	$hap=$_REQUEST[hap];
	$avg=$_REQUEST[avg];

	$query="insert into sj (name8, kor8, eng8, mat8, hap8, avg8)
				values ('$name',$kor,$eng,$mat,$hap,$avg);";
	$result=mysqli_query($db,$query);
	if(!$result) exit("¿¡·¯:$query");

	echo("<script>location.href='sj_list.php'</script>");
	?>