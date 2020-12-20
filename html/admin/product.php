<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "../common.php";
	$text1=$_REQUEST[text1];
	$sel1=$_REQUEST[sel1];
	$sel2=$_REQUEST[sel2];
	$sel3=$_REQUEST[sel3];
	$sel4=$_REQUEST[sel4];
	$no=$_REQUEST[no];
	
?>
<html>
<head>
<title>쇼핑몰 관리자 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
<script>
	function go_new()
	{
		location.href="product_new.php";
	}
</script>
</head>

<body style="margin:0">

<center>

<br>
<script> document.write(menu());</script>
<?
	if(!$sel1) $sel1=0;
	if(!$sel2) $sel2=0;
	if(!$sel3) $sel3=0;
	if(!$sel4) $sel4=0;
	if(!$text1) $text1="";
	
	$k=0;
	if($sel1!=0) {$s[$k] = "status8=".$sel1; $k++;}
	if($sel2==1) {$s[$k] = "icon_new8=1"; $k++;}
	elseif($sel2==2) {$s[$k] = "icon_hit8=1"; $k++;}
	elseif($sel2==3) {$s[$k] = "icon_sale8=1"; $k++;}
	if($sel3!=0) {$s[$k] = "menu8=".$sel3; $k++;}
	if($text1){
		if($sel4==1) {$s[$k] = "name8 like '%".$text1."%'";$k++;}
		elseif($sel4==2) {$s[$k] = "code8 like '%".$text1."%'";$k++;}
	}
	
	if($k>0)
	{
		$tmp=implode(" and ",$s);
		$tmp="where ".$tmp;
	}
	
	$query="select * from product " .$tmp. " order by name8";
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러:$query");
	$count=mysqli_num_rows($result);
	if($count!=0)
	
?>
<table width="800" border="0" cellspacing="0" cellpadding="0">
	<form name="form1" method="post" action="product.php">
	<tr height="40">
		<td align="left"  width="150" valign="bottom">&nbsp 제품수 : <font color="#FF0000"><?=$count?></font></td>
		<td align="right" width="550" valign="bottom">
			<?
			echo("<select name='sel1'>");
			for($i=0; $i<$n_status; $i++)
			{
				if($i==$sel1)
					echo("<option value='$i' selected>$a_status[$i]</option>");
				else
					echo("<option value='$i'>$a_status[$i]</option>");
			}
			echo("</select>&nbsp");
			
			echo("<select name='sel2'>");
			for($i=0; $i<$n_icon; $i++)
			{
				if($i==$sel2)
					echo("<option value='$i' selected>$a_icon[$i]</option>");
				else
					echo("<option value='$i'>$a_icon[$i]</option>");
			}
			echo("</select>&nbsp");
			echo("<select name='sel3'>");
			for($i=0; $i<$n_menu; $i++)
			{
				if($i==$sel3)
					echo("<option value='$i' selected>$a_menu[$i]</option>");
				else
					echo("<option value='$i'>$a_menu[$i]</option>");
			}
			echo("</select>&nbsp"); 
			echo("<select name='sel4'>");
			for($i=1; $i<$n_text1; $i++)
			{
				if($i==$sel4)
					echo("<option value='$i' selected>$a_text1[$i]</option>");
				else
					echo("<option value='$i'>$a_text1[$i]</option>");
			}
			echo("</select>&nbsp");
			?>
			<input type="text" name="text1" size="10" value="<?=$text1?>">&nbsp
		</td>
		<td align="left" width="120" valign="bottom">
			<input type="button" value="검색" onclick="javascript:form1.submit();"> &nbsp;&nbsp
			<input type="button" value="입력" onclick="javascript:go_new();">
		</td>
	</tr>
	<tr><td height="5"></td></tr>
	</form>
</table>

<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr bgcolor="#CCCCCC" height="23"> 
		<td width="100" align="center">제품분류</td>
		<td width="100" align="center">제품코드</td>
		<td width="280" align="center">제품명</td>
		<td width="70"  align="center">판매가</td>
		<td width="50"  align="center">상태</td>
		<td width="120" align="center">이벤트</td>
		<td width="80"  align="center">수정/삭제</td>
		
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

			$price=number_format($row[price8]);
			if($row[status8]==1) $status = "판매중";
			if($row[status8]==2) $status = "판매중지";
			if($row[status8]==3) $status = "품절";
			if($row[icon_new8]==1) $icon_new = "New";
			else
				$icon_new = "";
			if($row[icon_hit8]==1) $icon_hit = "hit";
			else
				$icon_hit = "";
			if($row[icon_sale8]==1) $icon_sale = "sale [$row[discount8]%]";
			else
				$icon_sale = "";
			
			
				for($q=1; $q<$n_menu; $q++)
			{		
					if($row[menu8] == $q)
					$menu = $a_menu[$q];
			}
	echo("<tr bgcolor='#F2F2F2' height='23'>	
		<td width='100'>&nbsp $menu</td>
		<td width='100'>&nbsp $row[code8]</td>
		<td width='280'>&nbsp $row[name8]</td>	
		<td width='70'  align='right'> $price&nbsp원</td>	
		<td width='50'  align='center'>$status</td>	
		<td width='120' align='center'>&nbsp 
		$icon_new
		$icon_hit
		$icon_sale
		</td>	
		<td width='80'  align='center'>
			<a href='product_edit.php?no=$row[no8]&sel1=$sel1&sel2=$sel2&sel3=$sel3&sel4=$sel4&text1=$text1&page=$page'>수정</a>/
			<a href='product_delete.php?no=$row[no8]&sel1=$sel1&sel2=$sel2&sel3=$sel3&sel4=$sel4&text1=$text1&page=$page' onclick='javascript:return confirm('삭제할까요 ?');'>삭제</a>
		</td>
	</tr>");
		}//&sel1=$sel1&sel2=$sel2&sel3=$sel3&sel4=$sel4&text1=$text1&page=$page
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
		echo("<a href='product.php?page=$tmp&sel1=$sel1&sel2=$sel2&sel3=$sel3&sel4=$sel4&text1=$text1'>
		<img src='images/i_prev.gif' align='absmiddle'border='0'>
		</a>&nbsp");
	}
	for($i=$page_s+1; $i<=$page_e; $i++)
	{
		if($page==$i)
			echo("&nbsp;<font ed'><b>$i</b></font>&nbsp;");
		else
			echo("&nbsp;<a href='product.php?page=$i&sel1=$sel1&sel2=$sel2&sel3=$sel3&sel4=$sel4&text1=$text1'>[$i]</a>&nbsp;");
	}
	if($block < $blocks)
	{
		$tmp=$page_e+1;
		echo("<a href='product.php?page=$tmp&sel1=$sel1&sel2=$sel2&sel3=$sel3&sel4=$sel4&text1=$text1'>
		<img src='images/i_next.gif' align='absmiddle' border='0'>
		</a>");
	}
	echo("	</td>
	</tr>
	</table>");
?>
<?
/*
<table width="800" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="30" class="cmfont" align="center">
			<img src="images/i_prev.gif" align="absmiddle" border="0"> 
			<font color="#FC0504"><b>[1]</b></font>&nbsp;
			<a href="product.php?page=2&sel1=$sel1&sel2=$sle2&sel3=$sel3&sel4=$sel4&text1=$text1"><font color="#7C7A77">[2]</font></a>&nbsp;
			<a href="product.php?page=3&sel1=$sel1&sel2=$sel2&sel3=$sel3&sel4=$sel4&text1=$text1"><font color="#7C7A77">[3]</font></a>&nbsp;
			<img src="images/i_next.gif" align="absmiddle" border="0">
		</td>
	</tr>
</table>
*/
?>
</center>

</body>
</html>