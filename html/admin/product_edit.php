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
	$page=$_REQUEST[page];
?>
<html>
<head>
<title>쇼핑몰 관리자 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>

<script language="JavaScript">
	function imageView(strImage)
	{
		this.document.images["big"].src = strImage;
	}
</script>

</head>

<body style="margin:0">

<form name="form1" method="post" action="product_update.php" enctype="multipart/form-data">

<input type="hidden" name="sel1" value="<?=$sel1?>">
<input type="hidden" name="sel2" value="<?=$sel2?>">
<input type="hidden" name="sel3" value="<?=$sel3?>">
<input type="hidden" name="sel4" value="<?=$sel4?>">
<input type="hidden" name="text1" value="<?=$text1?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="no" value="<?=$no?>">


<?
/*
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
	*/
	$query = "select * from product where no8 = $no;";
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러:$query");
	$count=mysqli_num_rows($result);
	$row=mysqli_fetch_array($result);
?>

<center>

<br>
<script> document.write(menu());</script>
<br>
<br>

<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr height="23"> 
		<td width="100" bgcolor="#CCCCCC" align="center">상품분류</td>
		<td width="700" bgcolor="#F2F2F2">
			<?
			echo("<select name='menu'>");
			for($i=0; $i<$n_menu; $i++)
			{
				if($i==$row[menu8])
					echo("<option value='$i' selected>$a_menu[$i]</option>");
				else
					echo("<option value='$i'> $a_menu[$i]</option>");
			}
			echo("</select>&nbsp");
			?>
		</td>
	</tr>
	<tr height="23"> 
		<td width="100" bgcolor="#CCCCCC" align="center">상품코드</td>
		<td width="700"  bgcolor="#F2F2F2">
			<input type="text" name="code" value="<?=$row[code8]?>" size="20" maxlength="20">
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">상품명</td>
		<td width="700"  bgcolor="#F2F2F2">
	
			<input type="text" name="name" value="<?=$row[name8]?>" size="60" maxlength="60">
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">제조사</td>
		<td width="700"  bgcolor="#F2F2F2">
			<input type="text" name="coname" value="<?=$row[coname8]?>" size="30" maxlength="30">
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">판매가</td>
		<td width="700"  bgcolor="#F2F2F2">
			<input type="text" name="price" value="<?=$row[price8]?>" size="12" maxlength="12"> 원
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">옵션</td>
		<td width="700"  bgcolor="#F2F2F2">
			<?
				/*
				if($i==$row[opt18])
					echo("<option value='$i' selected>$a_menu[$i]</option>");
				else
					echo("<option value='$i'> $a_menu[$i]</option>");
					stripslashes
					*/
					?>
			<?
			echo("<select name='opt1'>");
			$query="select * from opt order by no8;";
			$result=mysqli_query($db,$query);
			if(!$result) exit("에러:$query");
			$count=mysqli_num_rows($result);

			for($i=0; $i<$count; $i++)
			{	
				$row1=mysqli_fetch_array($result);
				if($row1[no8]==$row[opt18]) //5
					echo("<option value='$row1[no8]' selected>$row1[name8]</option>");
				else	
					echo("<option value='$row1[no8]'>$row1[name8]</option>");
			}
			echo("</select>&nbsp");
			
			echo("<select name='opt2'>");
			mysqli_data_seek($result,0);
			for($i=0; $i<$count; $i++)
			{	
				$row1=mysqli_fetch_array($result);
				if($row1[no8]==$row[opt28]) //4
					echo("<option value='$row1[no8]' selected>$row1[name8]</option>");
				else	
					echo("<option value='$row1[no8]'>$row1[name8]</option>");
			}
			?>
		</td>
	</tr> 
	<tr> 

		<td width="100" bgcolor="#CCCCCC" align="center">제품설명</td>
		<td width="700"  bgcolor="#F2F2F2">
		<input type="radio" name="content" value="0" checked>Text 
      <input type="radio" name="content" value="1">Html
	 <br>
			<textarea name="contents" rows="4" cols="70"><?=$row[content8]?></textarea>
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">상품상태</td>
    <td width="700"  bgcolor="#F2F2F2">
	<?
		if ($row[status8]==1)
			echo("<input type='radio' name='status' value='1' checked>판매중
				<input type='radio' name='status' value='2' >판매중지
				<input type='radio' name='status' value='3' >품절");
		else if ($row[status8]==2)
			echo("<input type='radio' name='status' value='1' >판매중
				<input type='radio' name='status' value='2' checked>판매중지
				<input type='radio' name='status' value='3' >품절");
			else
				echo("<input type='radio' name='status' value='1' >판매중
				<input type='radio' name='status' value='2' >판매중지
				<input type='radio' name='status' value='3' checked>품절");
	  
	 ?> 
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">아이콘</td>
		<td width="700"  bgcolor="#F2F2F2">
		<?	
			if($row[icon_new8] == 1)
				echo("<input type='checkbox' name='icon_new' value='1' checked> New &nbsp &nbsp	");
			else
				echo("<input type='checkbox' name='icon_new' value='0' > New &nbsp &nbsp");
				//echo("<input type='hidden' name='icon_new' value='0' &nbsp &nbsp");

			if($row[icon_hit8] == 1)
				echo("<input type='checkbox' name='icon_hit' value='1' checked> Hit &nbsp &nbsp	");
			else
				echo("<input type='checkbox' name='icon_hit' value='0' > Hit &nbsp &nbsp");
			if($row[icon_sale8] == 1)
				echo("<input type='checkbox' name='icon_sale' value='1'checked> Sale &nbsp &nbsp");
			else
				echo("<input type='checkbox' name='icon_sale' value='0' > Sale &nbsp &nbsp");
	
			echo("할인율 : <input type='text' name='discount' value='$row[discount8]' size='3' maxlength='3'> %");
		?>
		</td>
	</tr>
	<tr> 
	<?
	$regday= explode("-","$row[regday8]");
	?>
		<td width="100" bgcolor="#CCCCCC" align="center">등록일</td>
		<td width="700"  bgcolor="#F2F2F2">
			<input type="text" name="regday1" value="<?=$regday[0]?>" size="4" maxlength="4"> 년 &nbsp
			<input type="text" name="regday2" value="<?=$regday[1]?>" size="2" maxlength="2"> 월 &nbsp
			<input type="text" name="regday3" value="<?=$regday[2]?>" size="2" maxlength="2"> 일 &nbsp
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">이미지</td>
		<td width="700"  bgcolor="#F2F2F2">

			<table border="0" cellspacing="0" cellpadding="0" align="left">
				<tr>
					<td>
						<table width="390" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td>
								<form name="form1" method="post" action="product_update.php" enctype="multipart/form-data">
									<input type='hidden' name='imagename1' value='<?=$row[image18]?>'>
									&nbsp;<input type="checkbox" name="checkno1" value="1"> <b>이미지1</b>: <?=$row[image18]?>
									<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="file" name="image1" size="20" value="찾아보기"> 
								</td>
							</tr> 
							<tr>
								<td>
									<input type='hidden' name='imagename2' value='<?=$row[image28]?>'>
									&nbsp;<input type="checkbox" name="checkno2" value="1"> <b>이미지2</b>: <?=$row[image28]?>
									<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="file" name="image2" size="20" value="찾아보기">
									
									
								</td>
							</tr> 
							<tr>
								<td>
									<input type='hidden' name='imagename3' value='<?=$row[image38]?>'>
									&nbsp;<input type="checkbox" name="checkno3" value="1"> <b>이미지3</b>: <?=$row[image38]?>
									<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="file" name="image3" size="20" value="찾아보기">
								</td>
								</form>
							</tr> 
							<tr>
								<td><br>&nbsp;&nbsp;&nbsp;※ 삭제할 그림은 체크를 하세요.</td>
							</tr> 
				  	</table>
						<br><br><br><br><br>
						<table width="390" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td  valign="middle">&nbsp;
									<img src="../product/<?=$row[image18]?>" width="50" height="50" border="1" style='cursor:hand' onclick="imageView('../product/<?=$row[image18]?>')">&nbsp;
									<img src="../product/<?=$row[image28]?>" width="50" height="50" border="1" style='cursor:hand' onclick="imageView('../product/<?=$row[image28]?>')">&nbsp;
									<img src="../product/<?=$row[image38]?>"  width="50" height="50" border="1" style='cursor:hand' onclick="imageView('../product/<?=$row[image38]?>')">&nbsp;
								</td>
							</tr>				 
						</table>
					</td>
					<td>
						<td align="right" width="310"><img name="big" src="../product/<?=$row[image18]?>" width="300" height="300" border="1"></td>
					</td>
				</tr>
			</table>

		</td>
	</tr>
</table>

<table width="800" border="0" cellspacing="0" cellpadding="5">
	<tr> 
		<td align="center">
			<input type="submit" value="수정하기"> &nbsp;&nbsp
			<input type="button" value="이전화면" onClick="javascript:history.back();">
		</td>
	</tr>
</table>

</form>

</center>

</body>
</html>
