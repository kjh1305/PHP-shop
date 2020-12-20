<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "../common.php";
	$no=$_REQUEST[no];
	$sel1=$_REQUEST[sel1];
	$sel2=$_REQUEST[sel2];
	$text1=$_REQUEST[text1];
	$state=$_REQUEST[state];
	$day1_y=$_REQUEST[day1_y];
	$day1_m=$_REQUEST[day1_m];
	$day1_d=$_REQUEST[day1_d];
	$day2_y=$_REQUEST[day2_y];
	$day2_m=$_REQUEST[day2_m];
	$day2_d=$_REQUEST[day2_d];

	/*
	$query="select * from jumun order by no8 desc";
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러:$query");
	$row=mysqli_fetch_array($result);
	$count=mysqli_num_rows($result);
	*/
?>
<html>
<head>
<title>쇼핑몰 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
<script>
	function go_update(no,pos)
	{
		state=form1.state[pos].value;
		location.href="jumun_update.php?no="+no+"&state="+state+"&page="+form1.page.value+
			"&sel1="+form1.sel1.value+"&sel2="+form1.sel2.value+"&text1="+form1.text1.value+
			"&day1_y="+form1.day1_y.value+"&day1_m="+form1.day1_m.value+"&day1_d="+form1.day1_d.value+
			"&day2_y="+form1.day2_y.value+"&day2_m="+form1.day2_m.value+"&day2_d="+form1.day2_d.value;
	}
</script>
</head>

<body style="margin:0">

<center>

<br>
<script> document.write(menu());</script>
<?
	if(!$day1_y) $day1_y=0;
	if(!$day1_m) $day1_m=0;
	if(!$day1_d) $day1_d=0;
	if(!$day2_y) $day2_y=0;
	if(!$day2_m) $day2_m=0;
	if(!$day2_d) $day2_d=0;
	if(!$sel1) $sel1=0;
	if(!$sel2) $sel2=0;
	if(!$text1) $text1="";
	
	$k=0;
	
	if($day1_y !=0 && $day1_m!=0 && $day1_d!=0 && $day2_y !=0 && $day2_m!=0 && $day2_d!=0) {
		$day1_m=sprintf('%02d',$day1_m);
		$day1_m="$day1_m";
		$day1_d=sprintf('%02d',$day1_d);
		$day1_d="$day1_d";
		$day = $day1_y.$day1_m.$day1_d; 
		$day = date('Y-m-d', strtotime($day));
		$day2_m=sprintf('%02d',$day2_m);
		$day2_m="$day2_m";
		$day2_d=sprintf('%02d',$day2_d);
		$day2_d="$day2_d";
		$day2 = $day2_y.$day2_m.$day2_d; 
		$day2 = date('Y-m-d', strtotime($day2));
		$s[$k] = "jumunday8 between "."'".$day."'".'and'."'".$day2."'"; $k++;
		}
		//$query="select * from jumun where a and b order by no8 desc";
	
	else if($day1_y==0 && $day1_m==0 && $day1_d==0 &&$day2_y !=0 && $day2_m!=0 && $day2_d!=0) {
		$day2_m=sprintf('%02d',$day2_m);
		$day2_m="$day2_m";
		$day2_d=sprintf('%02d',$day2_d);
		$day2_d="$day2_d";
		$day = $day2_y.$day2_m.$day2_d; 
		$day = date('Y-m-d', strtotime($day));
		$s[$k] = "jumunday8<='".$day."'"; $k++;
		}
	else if($day1_y !=0 && $day1_m!=0 && $day1_d!=0) {
		$day1_m=sprintf('%02d',$day1_m);
		$day1_m="$day1_m";
		$day1_d=sprintf('%02d',$day1_d);
		$day1_d="$day1_d";
		$day = $day1_y.$day1_m.$day1_d; 
		$day = date('Y-m-d', strtotime($day));
		$s[$k] = "jumunday8>='".$day."'"; $k++;
		}
	else if($day1_y!=0 && $day1_m!=0){
		$day1_m=sprintf('%02d',$day1_m);
		$s[$k] = "jumunday8 like '".$day1_y.'-'.$day1_m."%'"; $k++;
	}
	else if($day1_m!=0 && $day1_d!=0){
		$day1_m=sprintf('%02d',$day1_m);
		$day1_d=sprintf('%02d',$day1_d);
		$s[$k] = "jumunday8 like '%".$day1_m.'-'.$day1_d."'"; $k++;
	}
	
	else if($day1_y!=0 && $day1_d!=0){
		$day1_d=sprintf('%02d',$day1_d);
		//$s[$k] = "jumunday8 like '".$day1_y."%' and '%".$day1_d."'";
		$s[$k] = "jumunday8 like '".$day1_y."%' and jumunday8 like '%".$day1_d."'";
		$k++;
		}
	
	else if($day1_y!=0) {$s[$k] = "jumunday8 like '".$day1_y."%'"; $k++;}

	else if($day1_m!=0) {
		$day1_m=sprintf('%02d',$day1_m);
		$s[$k] = "jumunday8 like '%____".$day1_m."__%'"; $k++;
		}
	else if($day1_d!=0) {
		$day1_d=sprintf('%02d',$day1_d);
		$s[$k] = "jumunday8 like '%".$day1_d."'"; $k++;}
		
	

	//if($sel1!=0) {$s[$k] = "status8=".$sel1; $k++;}
	//sprintf('%06d', 변수) 
	//여러개 검색조건 SELECT * FROM tablename WHERE filed1 LIKE "%me%" AND filed2 LIKE "%you%";

	
	//if($day2_y!=0) {$s[$k] = "jumunday8 like '%".$day2_y."%'"; $k++;}
	//if($day2_m!=0) {$s[$k] = "jumunday8 like '%".$day2_m."%'"; $k++;}
	//if($day2_d!=0) {$s[$k] = "jumunday8 like '%".$day2_d."%'"; $k++;}
	


	if($sel1!=0) {$s[$k] = "state8=".$sel1; $k++;}
	
	if($text1){
		if($sel2==0) {$s[$k] = "no8 like '%".$text1."%'";$k++;}
		elseif($sel2==1) {$s[$k] = "o_name8 like '%".$text1."%'";$k++;}
		elseif($sel2==2) {$s[$k] = "product_names8 like '%".$text1."%'";$k++;}
	}
	
	
	
	if($k>0)
	{
		$tmp=implode(" and ",$s);
		$tmp="where ".$tmp;
	}
	
	$query="select * from jumun " .$tmp. " order by no8 desc";
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러:$query");
	$count=mysqli_num_rows($result);
	if($count!=0)
	
?>
<form name="form1" method="post" action="jumun.php">
<input type="hidden" name="page" value="<?=$page?>">

<table width="800" border="0" cellspacing="0" cellpadding="0">
	<tr height="40">
		<td align="left"  width="70" valign="bottom">&nbsp 주문수 : <font color="#FF0000"><?=$count?></font></td>
		<td align="right" width="730" valign="bottom">
			기간 : 
			<input type="text" name="day1_y" size="4" value="<?=$day1_y?>">
			<?
			/*echo("<select name='day1_y'>");
			for($i=0; $i<$n_year; $i++)
			{
				if($a_year[$i]==$day1_y)
					echo("<option value='202$i' selected>$a_year[$i]</option>");
				else
					echo("<option value='202$i'>$a_year[$i]</option>");
			}
			echo("</select>&nbsp");
			*/
			echo("<select name='day1_m'>");
			for($i=0; $i<$n_day2; $i++)
			{
				if($i==$day1_m)
					echo("<option value='$i' selected>$a_day2[$i]</option>");
				else
					echo("<option value='$i'>$a_day2[$i]</option>");
			}
			echo("</select>&nbsp");
			
			echo("<select name='day1_d'>");
			for($i=0; $i<$n_day; $i++)
			{
				if($i==$day1_d)
					echo("<option value='$i' selected>$a_day[$i]</option>");
				else
					echo("<option value='$i'>$a_day[$i]</option>");
			}
			echo("</select>&nbsp");
			?>
			 - 
			<input type="text" name="day2_y" size="4" value="<?=$day2_y?>">
			<?
			/*
			echo("<select name='day2_y'>");
			for($i=0; $i<$n_year; $i++)
			{
				if($i==$day2_y)
					echo("<option value='$i' selected>$a_year[$i]</option>");
				else
					echo("<option value='$i'>$a_year[$i]</option>");
			}
			echo("</select>&nbsp");
			*/
			echo("<select name='day2_m'>");
			for($i=0; $i<$n_day2; $i++)
			{
				if($i==$day2_m)
					echo("<option value='$i' selected>$a_day2[$i]</option>");
				else
					echo("<option value='$i'>$a_day2[$i]</option>");
			}
			echo("</select>&nbsp");
			
			echo("<select name='day2_d'>");
			for($i=0; $i<$n_day; $i++)
			{
				if($i==$day2_d)
					echo("<option value='$i' selected>$a_day[$i]</option>");
				else
					echo("<option value='$i'>$a_day[$i]</option>");
			}
			echo("</select>&nbsp");
			
	
			echo("<select name='sel1'>");
			for($i=0; $i<$n_jumunstate; $i++)
			{
				if($i==$sel1)
					echo("<option value='$i' selected>$a_jumunstate[$i]</option>");
				else
					echo("<option value='$i'>$a_jumunstate[$i]</option>");
			}
			echo("</select>&nbsp");
	
			echo("<select name='sel2'>");
			for($i=0; $i<$n_bun; $i++)
			{
				if($i==$sel2)
					echo("<option value='$i' selected>$a_bun[$i]</option>");
				else
					echo("<option value='$i'>$a_bun[$i]</option>");
			}
			echo("</select>&nbsp");
	?>
			<input type="text" name="text1" size="10" value="<?=$text1?>">&nbsp
			<input type="button" value="검색" onclick="javascript:form1.submit();"> &nbsp;
		</td>
	</tr>
	</tr><td height="5" colspan="2"></td></tr>
</table>

<table width="800" border="1" cellpadding="0" style="border-collapse:collapse">
	<tr bgcolor="#CCCCCC" height="23"> 
		<td width="70"  align="center">주문번호</td>
		<td width="70"  align="center">주문일</td>
		<td width="250" align="center">상품명</td>
		<td width="50"  align="center">제품수</td>	
		<td width="70"  align="center">총금액</td>
	    <td width="65"  align="center">주문자</td>
		<td width="50"  align="center">결재</td>
		<td width="135" align="center" colspan="2">주문상태</td>
	    <td width="50"  align="center">삭제</td>
	</tr>
	<!--<tr bgcolor="#F2F2F2" height="23"> 
		<td width="70"  align="center"><a href="jumun_info.html?no=0803050004">0803050004</a></td>
		<td width="70"  align="center">2008-03-05</td>
		<td width="250" align="left">&nbsp;파란 브라우스 외 1</td>	
		<td width="40" align="center">2</td>	
		<td width="70"  align="right">35,000&nbsp</td>	
		<td width="65"  align="center">홍길동</td>	
		<td width="50"  align="center">카드</td>	
		<td width="85" align="center" valign="bottom">
			<select name="state" style="font-size:9pt; color:black">
				<option value="1" selected>주문신청</option>
				<option value="2">주문확인</option>
				<option value="3">입금확인</option>
				<option value="4">배송중</option>
				<option value="5">주문완료</option>
				<option value="6">주문취소</option>
			</select>&nbsp;
		</td>
		<td width="50" align="center">
			<a href="javascript:go_update('0803050004',0);"><img src="images/b_edit1.gif" border="0"></a>
		</td>	
		<td width="50" align="center">
			<a href="jumun_delete.html?no=0803050004" onclick="javascript:return confirm('삭제할까요 ?');"><img src="images/b_delete1.gif" border="0"></a>
		</td>
	</tr>
	-->
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
			$total_cash=number_format($row[total_cash8]);
			if($row[pay_method8] == 1)
		{
			$pay_method = "무통장";
		}
		else 
		{
			$pay_method = "카드";
		}
		
				echo("<tr bgcolor='#F2F2F2' height='23'>	
					<td width='70'  align='center'><a href='jumun_info.php?no=$row[no8]'>$row[no8]</a></td>
		<td width='70'  align='center'>$row[jumunday8]</td>
		<td width='250' align='left'>&nbsp;$row[product_names8]</td>	
		<td width='40' align='center'>$row[product_nums8]</td>	
		<td width='70'  align='center'>$total_cash</td>	
		<td width='65'  align='center'>$row[o_name8]</td>	
		<td width='50'  align='center'>$pay_method</td>	");
		/*
		<td width='85' align='center' valign='bottom'>
			<select name='state' style='font-size:9pt; color:black'>
				<option value='1' selected>주문신청</option>
				<option value='2'>주문확인</option>
				<option value='3'>입금확인</option>
				<option value='4'>배송중</option>
				<option value='5'>주문완료</option>
				<option value='6'>주문취소</option>
			echo("</select>&nbsp;
		</td>");*/
		$state=$row[state8];
		$color="black";
		if($state==5) $color="blue";
		if($state==6) $color="red";
		echo("<td width='85' align='center' valign='bottom'>
		<select name='state' style='font-size:9pt; color:$color'>");
			for($si=1; $si<$n_state; $si++)
			{
				if($si==$state)
					echo("<option value='$si' selected>$a_state[$si]</option>");
				else
					echo("<option value='$si'>$a_state[$si]</option>");
			}
				echo("</select>&nbsp;
		</td>");		
		
		echo("<td width='50' align='center'>
			<a href=\"javascript:go_update('$row[no8]',$i);\"><img src='images/b_edit1.gif' border='0'></a>
		</td>	
		<td width='50' align='center'>
			<a href='jumun_delete.php?no=$row[no8]' onclick='javascript:return confirm('삭제할까요 ?');'><img src='images/b_delete1.gif' border='0'></a>
		</td>
	</tr>");
		}
?>
		
</table>

<input type="hidden" name="state">

<!-- <table width="800" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="30" class="cmfont" align="center">
			<img src="images/i_prev.gif" align="absmiddle" border="0"> 
			<font color="#FC0504"><b>1</b></font>&nbsp;
			<a href="jumun.html?page=2&sel1=&sel2=&text1=&day1_y=&day1_m=&day1_d=&day2_y=&day2_m=&day2_d="><font color="#7C7A77">[2]</font></a>&nbsp;
			<a href="jumun.html?page=3&sel1=&sel2=&text1=&day1_y=&day1_m=&day1_d=&day2_y=&day2_m=&day2_d="><font color="#7C7A77">[3]</font></a>&nbsp;
			<img src="images/i_next.gif" align="absmiddle" border="0">
		</td>
	</tr>
</table>-->
<?
echo("<table width='400' border='0' cellspacing='0' cellpadding='0'>
	<tr>
	<td height='20' align='center'>");
	$blocks = ceil($pages/$page_block);
	$block = ceil($page/$page_block);
	$page_s = $page_block * ($block-1);
	$page_e = $page_block * $block;
	if($blocks <= $block) $page_e = $pages;
	/*
	if($block>1)
	{
		$tmp=$page_s;
		echo("<a href='jumun.php?page=$tmp=$no'>
		<img src='images/i_prev.gif' align='absmiddle'border='0'>
		</a>&nbsp");
	}
	*/
	if($block>1)
	{
		$tmp=$page_s;
		echo("<a href='jumun.php?page=$tmp&day1_y=$day1_y&day1_m=$day1_m&day1_d=$day1_d&day2_y=$day2_y&day2_m=$day2_m&day2_d=$day2_d&sel1=$sel1&sel2=$sel2&text1=$text1'>[1]</a>&nbsp");
	}
	for($i=$page_s+1; $i<=$page_e; $i++)
	{
		if($page==$i)
			echo("&nbsp;<font ed'><b>$i</b></font>&nbsp;");
		else
			echo("&nbsp;<a href='jumun.php?page=$i&day1_y=$day1_y&day1_m=$day1_m&day1_d=$day1_d&day2_y=$day2_y&day2_m=$day2_m&day2_d=$day2_d&sel1=$sel1&sel2=$sel2&text1=$text1'>[$i]</a>&nbsp;");
	}
	if($block < $blocks)
	{
		$tmp=$page_e+1;
		echo("<a href='jumun.php?page=$tmp&day1_y=$day1_y&day1_m=$day1_m&day1_d=$day1_d&day2_y=$day2_y&day2_m=$day2_m&day2_d=$day2_d&sel1=$sel1&sel2=$sel2&text1=$text1'>
		<img src='images/i_next.gif' align='absmiddle' border='0'>
		</a>");
	}
	echo("	</td>
	</tr>
	</table>");
?>
</form>

</center>

</body>
</html>