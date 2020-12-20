<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "../common.php";
	$no1=$_REQUEST[no1];
	$no2=$_REQUEST[no2];
?>
<html>
<head>
<title>쇼핑몰 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
<script>
	function go_new()
	{
		location.href="opts_new.php?no1=<?=$no1?>";
	}
</script>
</head>

<body style="margin:0">

<center>

<br>
<script> document.write(menu());</script>

<?
  	$query="select * from opt where no8=$no1;";
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러:$query");
	$count=mysqli_num_rows($result);
	$row=mysqli_fetch_array($result);
?>

<table width="500" border="0" cellspacing="0" cellpadding="0">
	<tr height="50">
		<td align="left"  width="300" valign="bottom">&nbsp 옵션명 : <font color="#0457A2"><b><?=$row[name8]?></b></font></td>
		<td align="right" width="200" valign="bottom">
			<input type="button" value="신규입력" onclick="javascript:go_new();"> &nbsp
		</td>
	</tr>
	<tr><td height="5" colspan="2"></td></tr>
</table>

<?
  	$query="select * from opts where opt_no8=$no1;";
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러:$query");
	$count=mysqli_num_rows($result);
?>

<table width="500" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr bgcolor="#CCCCCC" height="20"> 
		<td width="100" align="center"><font color="#142712">소옵션번호</font></td>
		<td width="300" align="center"><font color="#142712">소옵션명</font></td>
		<td width="100" align="center"><font color="#142712">수정/삭제</font></td>
	</tr>

<?
		$page=$_REQUEST[page];
		if(!$page) $page=1;
		$pages=ceil($count/$page_line);
		$first=1;
		if($count>0) $first=$page_line*($page-1);
		$page_last=$count-$first;
		if($page_last>$page_line) $page_last=$page_line;
		if($count>0) mysqli_data_seek($result,$first);

			for($i=0; $i<$page_last; $i++)
				{
				$row=mysqli_fetch_array($result);
					echo("<tr bgcolor='#F2F2F2' height='20'>	
						<td width='100' align='center'>$row[no8]</td>
						<td width='300' align='left'>$row[name8]</td>
						<td width='100' align='center'>
							<a href='opts_edit.php?no1=$no1&no2=$row[no8]'>수정</a>/
							<a href='opts_delete.php?no1=$no1&no2=$row[no8]' onclick='javascript:return confirm('삭제할까요 ?');'>삭제</a>
						</td>
					</tr>");
				}
		
?>
</table>
<?
echo("<table width='400' border='0' cellspacing='0' cellpadding='0'>
	<tr>
	<td height='20' align='center'>");
	$blocks = ceil($pages/$page_block);
	$block = ceil($page/$page_block);
	$page_s = $page_block * ($block-1);
	$page_e = $page_block * $block;
	if($blocks <= $block) $page_e = $pages;

	if($block>1)
	{
		$tmp=$page_s;
		echo("<a href='opts.php?no1=$no1&page=$tmp=$no2'>
		<img src='images/i_prev.gif' align='absmiddle'border='0'>
		</a>&nbsp");
	}
	for($i=$page_s+1; $i<=$page_e; $i++)
	{
		if($page==$i)
			echo("&nbsp;<font ed'><b>$i</b></font>&nbsp;");
		else
			echo("&nbsp;<a href='opts.php?no1=$no1&page=$i=$no2'>[$i]</a>&nbsp;");
	}
	if($block < $blocks)
	{
		$tmp=$page_e+1;
		echo("<a href='opts.php?no1=$no1&page=$tmp=$no2'>
		<img src='images/i_next.gif' align='absmiddle' border='0'>
		</a>");
	}
	echo("	</td>
	</tr>
	</table>");
?>
</center>

</body>
</html>