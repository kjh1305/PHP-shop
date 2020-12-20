<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "../common.php";
	$no=$_REQUEST[no];
	//jumuns left join jumun on jumuns.jumun_no8=jumun.no8
	//jumun.no8,product.name8,opts.name8 as opts1_name,opts.name8 as opts2_name
	$query="select jumun.* ,jumuns.num8 as q1,jumuns.price8 as q2,jumuns.cash8 as q3,jumuns.discount8 as q4,product.name8 as n1,product.name8 as y1, opts1.name8 as n2,opts2.name8 as n3 from (((jumuns left join jumun on jumuns.jumun_no8=jumun.no8) left join product on jumuns.product_no8=product.no8) left join opts as opts1 on jumuns.opts_no18=opts1.no8) left join opts as opts2 on jumuns.opts_no28=opts2.no8 where jumuns.jumun_no8='$no';";
	
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러:$query");
	$row=mysqli_fetch_array($result);
	$count=mysqli_num_rows($result);
?>
<html>
<head>
<title>쇼핑몰 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
</head>

<body style="margin:0">

<center>

<br>
<script> document.write(menu());</script>
<br>
<br>

<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문번호</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE">&nbsp;<font size="3"><b><?=$row[0]?> (<font color="blue">주문신청</font>)</b></font></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문일</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[2]?></td>
	</tr>
</table>
<br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자</font></td>
		<?
		if($row[1] == 0)
		{
			$member = "비회원";
		}
		else
			$member = "회원";
		?>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[5]?> (<?=$member?>)</td>
		<?
		$tel1=trim(substr($row[6],0,2));
		$tel2=trim(substr($row[6],2,4));
		$tel3=trim(substr($row[6],6,4));
		
		$tel = $tel1 . "-" . $tel2 . "-" . $tel3;
		?>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자전화</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$tel?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자 E-Mail</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[8]?></td>
		<?
		$tel1=trim(substr($row[7],0,3));
		$tel2=trim(substr($row[7],3,4));
		$tel3=trim(substr($row[7],7,4));
		
		$tel = $tel1 . "-" . $tel2 . "-" . $tel3;
		?>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자핸드폰</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$tel?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자주소</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE" colspan="3">(<?=$row[9]?>) <?=$row[10]?></td>
	</tr>
	</tr>
</table>
<img src="blank.gif" width="10" height="5"><br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[11]?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font 
		<?
		$tel1=trim(substr($row[12],0,2));
		$tel2=trim(substr($row[12],2,4));
		$tel3=trim(substr($row[12],6,4));
		
		$tel = $tel1 . "-" . $tel2 . "-" . $tel3;
		?>
		color="#142712">수신자전화</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$tel?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자 E-Mail</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[14]?></td>
		<?
		$tel1=trim(substr($row[13],0,3));
		$tel2=trim(substr($row[13],3,4));
		$tel3=trim(substr($row[13],7,4));
		
		$tel = $tel1 . "-" . $tel2 . "-" . $tel3;
		?>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자핸드폰</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$tel?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자주소</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE" colspan="3">(<?=$row[15]?>) <?=$row[16]?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">메모</font></td>
        <td width="300" height="50" bgcolor="#EEEEEE" colspan="3"><?=$row[17]?></td>
	</tr>
</table>
<br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">지불종류</font></td>
		<?
			if($row[18] == 0){
				$pay = "카드";
		}
			else
				$pay = "무통장";
		?>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$pay?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">카드승인번호 </font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[19]?>&nbsp</td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">카드 할부</font></td>
		<?
			if($row[20] == 0){$halbu = "일시불";}
			if($row[20] == 3){$halbu = "3개월";}
			if($row[20] == 6){$halbu = "6개월";}
			if($row[20] == 9){$halbu = "9개월";}
			if($row[20] == 12){$halbu = "12개월";}

			
		?>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$halbu?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">카드종류</font></td>
		<?
			if($row[21] == 1) { $card_kind = "국민카드";}
			if($row[21] == 2) { $card_kind = "신한카드";}
			if($row[21] == 3) { $card_kind = "우리카드";}
			if($row[21] == 4) { $card_kind = "하나카드";}
				
		?>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$card_kind?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">무통장</font></td>
		<?
			if($row[22] == 1) { $kinds="국민은행 000-00000-0000";}
			if($row[22] == 2) { $kinds="신한은행 000-00000-0000";}
		?>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$kinds?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">입금자이름</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[23]?></td>
	</tr>
</table>
<br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr bgcolor="#CCCCCC"> 
    <td width="340" height="20" align="center"><font color="#142712">상품명</font></td>
		<td width="50"  height="20" align="center"><font color="#142712">수량</font></td>
		<td width="70"  height="20" align="center"><font color="#142712">단가</font></td>
		<td width="70"  height="20" align="center"><font color="#142712">금액</font></td>
		<td width="50"  height="20" align="center"><font color="#142712">할인</font></td>
		<td width="60"  height="20" align="center"><font color="#142712">옵션1</font></td>
		<td width="60"  height="20" align="center"><font color="#142712">옵션2</font></td>
	</tr>
	<?
		
	mysqli_data_seek($result,0);
	for($i=1; $i<=$count; $i++){
		$row=mysqli_fetch_array($result);
		
		$cash=$row[q1]*$row[q3];
		$total_cash=$total_cash+$cash;
		$price = number_format($row[q2]);
		$cash = number_format($cash);
			
		if($row[n1] == null){ 
			$n1 = $row[n1]."배송비";
			}
		else{		
				$n1 = $row[n1];
		}
	echo("<tr bgcolor='#EEEEEE' height='20'>	
		<td width='340' height='20' align='left'>$n1</td>	
		<td width='50'  height='20' align='center'>$row[q1]</td>	
		<td width='70'  height='20' align='right'>$price</td>	
		<td width='70'  height='20' align='right'>$cash</td>	
		<td width='50'  height='20' align='center'>$row[q4]%</td>	
		<td width='60'  height='20' align='center'>$row[n2]</td>	
		<td width='60'  height='20' align='center'>$row[n3]</td>	
	</tr>");
	
	}
	?>
</table>
<img src="blank.gif" width="10" height="5"><br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
	  <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">총금액</font></td>
	  <?
	  	$total_cash = number_format($total_cash);
	  ?>
		<td width="700" height="20" bgcolor="#EEEEEE" align="right"><font color="#142712" size="3"><b><?=$total_cash?></b></font> 원&nbsp;&nbsp</td>
	</tr>
</table>

<table width="800" border="0" cellspacing="0" cellpadding="7">
	<tr> 
		<td align="center">
			<input type="button" value="이 전 화 면" onClick="javascript:history.back();">&nbsp
			<input type="button" value="프린트" onClick="javascript:print();">
		</td>
	</tr>
</table>

</center>

<br>
</body>
</html>
