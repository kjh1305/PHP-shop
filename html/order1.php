<?
	include "common.php";
	include "main_top.php";
	$cart = $_COOKIE[cart];
	$n_cart = $_COOKIE[n_cart];
	$cookie_no = $_COOKIE[cookie_no];
	$query="select no8 from jumun where jumunday8=curdate() order by no8 desc limit 1";
	
			$result=mysqli_query($db,$query);
			if(!$result) exit("에러:$query");
			$count=mysqli_num_rows($result);
			$row=mysqli_fetch_array($result);

	$day1=2020;
	$day1="$day1";
	$day2=06;
	$day2=sprintf('%02d',$day2);
	$day2="$day2";
	$day3=0;
	$day3=sprintf('%02d',$day3);
	$day3="$day3";
	
	$day=$day1.$day2.$day3;
	
?>
<br>
<?=$day?><br>
<?$day=date( 'Y-m-d', strtotime($day));?>
<?=$day?>

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	

			<!--  현재 페이지 자바스크립  -------------------------------------------->
			<script language="javascript">

			function Check_Value() {
				if (!form2.o_name.value) {
					alert("주문자 이름이 잘 못 되었습니다.");	form2.o_name.focus();	return;
				}
				if (!form2.o_tel1.value || !form2.o_tel2.value || !form2.o_tel3.value) {
					alert("전화번호가 잘 못 되었습니다.");	form2.o_tel1.focus();	return;
				}
				if (!form2.o_phone1.value || !form2.o_phone2.value || !form2.o_phone3.value) {
					alert("핸드폰이 잘 못 되었습니다.");	form2.o_phone1.focus();	return;
				}
				if (!form2.o_email.value) {
					alert("이메일이 잘 못 되었습니다.");	form2.o_email.focus();	return;
				}
				if (!form2.o_zip.value) {
					alert("우편번호가 잘 못 되었습니다.");	form2.o_zip.focus();	return;
				}
				if (!form2.o_juso.value) {
					alert("주소가 잘 못 되었습니다.");	form2.o_juso.focus();	return;
				}

				if (!form2.r_name.value) {
					alert("받으실 분의 이름이 잘 못 되었습니다.");	form2.r_name.focus();	return;
				}
				if (!form2.r_tel1.value || !form2.r_tel2.value || !form2.r_tel3.value) {
					alert("전화번호가 잘 못 되었습니다.");	form2.r_tel1.focus();	return;
				}
				if (!form2.r_phone1.value || !form2.r_phone2.value || !form2.r_phone3.value) {
					alert("핸드폰이 잘 못 되었습니다.");	form2.r_phone1.focus();	return;
				}
				if (!form2.r_email.value) {
					alert("이메일이 잘 못 되었습니다.");	form2.r_email.focus();	return;
				}
				if (!form2.r_zip.value) {
					alert("우편번호가 잘 못 되었습니다.");	form2.r_zip.focus();	return;
				}
				if (!form2.r_juso.value) {
					alert("주소가 잘 못 되었습니다.");	form2.r_juso.focus();	return;
				}

				form2.submit();
			}

			function FindZip(zip_kind) 
			{
				window.open("zipcode1.php?zip_kind="+zip_kind, "", "scrollbars=no,width=500,height=250");
			}

			function SameCopy(str) {
				if (str == "Y") {
					form2.r_name.value = form2.o_name.value;
					form2.r_zip.value = form2.o_zip.value;
					form2.r_juso.value = form2.o_juso.value;
					form2.r_tel1.value = form2.o_tel1.value;
					form2.r_tel2.value = form2.o_tel2.value;
					form2.r_tel3.value = form2.o_tel3.value;
					form2.r_phone1.value = form2.o_phone1.value;
					form2.r_phone2.value = form2.o_phone2.value;
					form2.r_phone3.value = form2.o_phone3.value;
					form2.r_email.value = form2.o_email.value;
				}
				else {
					form2.r_name.value = "";
					form2.r_zip.value = "";
					form2.r_juso.value = "";
					form2.r_tel1.value = "";
					form2.r_tel2.value = "";
					form2.r_tel3.value = "";
					form2.r_phone1.value = "";
					form2.r_phone2.value = "";
					form2.r_phone3.value = "";
					form2.r_email.value = "";
				}
			}

			</script>

			<table border="0" cellpadding="0" cellspacing="0" width="747">
				<tr><td height="13"></td></tr>
				<tr>
					<td height="30" align="center"><img src="images/jumun_title.gif" width="746" height="30" border="0"></td>
				</tr>
				<tr><td height="13"></td></tr>
			</table>

			<table border="0" cellpadding="0" cellspacing="0" width="710">
				<tr>
					<td><img src="images/order_title1.gif" width="65" height="15" border="0"></td>
				</tr>
				<tr><td height="10"></td></tr>
			</table>

			<table border="0" cellpadding="5" cellspacing="1" width="710" class="cmfont" bgcolor="#CCCCCC">
				<tr bgcolor="F0F0F0" height="23" class="cmfont">
					<td width="440" align="center">상품</td>
					<td width="70"  align="center">수량</td>
					<td width="100" align="center">가격</td>
					<td width="100" align="center">합계</td>
				</tr>
				<?
					$total=0;
					if(!$n_cart) $n_cart=0;
					for($i=1; $i<=$n_cart; $i++)
					{
						if($cart[$i])
						{
							list($no,$num,$opts1,$opts2)=explode("^",$cart[$i]);
							
							$query="select * from opts where no8=$opts1";
							$result=mysqli_query($db,$query);
							if(!$result) exit("에러:$query");
							$row=mysqli_fetch_array($result);
							
							
							$query="select * from opts where no8=$opts2";
							$result=mysqli_query($db,$query);
							if(!$result) exit("에러:$query");
							$row1=mysqli_fetch_array($result);
							
							$query="select * from product where no8=$no";
							$result=mysqli_query($db,$query);
							if(!$result) exit("에러:$query");
							$row2=mysqli_fetch_array($result);	

							if($row2[icon_sale8]==1){
							$price=number_format(round($row2[price8]*(100-$row2[discount8])/100,-3));
							
							$price1=number_format(round($row2[price8]*(100-$row2[discount8])/100,-3)*$num);
							}
							else{
							$price=number_format($row2[price8]);
							$price1=number_format($row2[price8]*$num);
							}
							
							
				echo("<tr>
					<td height='60' align='center' bgcolor='#FFFFFF'>
						<table cellpadding='0' cellspacing='0' width='100%'>
							<tr>
								<td width='60'>
									<a href='product_detail.php?no=$no'><img src='product/$row2[image18]' width='50' height='50' border='0'></a>
								</td>
								<td class='cmfont'>
									<a href='product_detail.php?no=$no'>$row2[name8]</a><br>
									<font color='#0066CC'>[$row[name8]]</font> $row1[name8]
								</td>
							</tr>
						</table>
					</td>
					<td align='center' bgcolor='#FFFFFF'>
						&nbsp<font color='#464646'>$num 개</font>
					</td>
					<td align='center' bgcolor='#FFFFFF'><font color='#464646'>$price</font></td>
					<td align='center' bgcolor='#FFFFFF'><font color='#464646'>$price1 </font></td>");
					//<td align='center' bgcolor='#FFFFFF'>"
						?>
						<!-- <a href = "javascript:cart_edit('update','<?=$i?>')"><img src='images/b_edit1.gif' border="0"></a>&nbsp<br>
						<a href = "javascript:cart_edit('delete','<?=$i?>')"><img src='images/b_delete1.gif' border="0"></a>&nbsp -->
						<?
							/*
						echo("<a href = \"javascript:cart_edit('delete','$i')\"><img src='images/b_delete1.gif' border='0'></a>&nbsp");
						*/
					echo("</td>
				</tr>");
						}
						$price1=filter_var($price1, 519);
							$total=$total+$price1;
					}
					
					if($total < $max_baesongbi) {
					$total1=$total+$baesongbi;
					$baesongbi=number_format($baesongbi);
					$total=number_format($total);
					$total1=number_format($total1);
					}
					else{
						$baesongbi=0;
						$total1=number_format($total);
						$total=number_format($total);
					}
					
					
					
				echo("<tr>
					<td colspan='5' bgcolor='#F0F0F0'>
						<table width='100%' border='0' cellpadding='0' cellspacing='0' class='cmfont'>
							<tr>
								<td bgcolor='#F0F0F0'><img src='images/cart_image1.gif' border='0'></td>
								<td align='right' bgcolor='#F0F0F0'>
									<font color='#0066CC'><b>총 합계금액</font></b> : 상품대금($total 원) + 배송료($baesongbi 원) = <font color='#FF3333'><b>$total1 원</b></font>&nbsp;&nbsp
								</td>
							</tr>
						</table>
					</td>
				</tr>");
				?>
			</table>
			<br><br>

			<!-- 주문자 정보 -->
			<table width="710" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr height="3" bgcolor="#CCCCCC"><td></td></tr>
			</table>

			<!-- form2 시작  -->
			<?
				$o_no="0";
				$o_name="";
				$o_tel="";
				$o_phone="";
				$o_email="";
				$o_zip="";
				$o_juso="";
				if($cookie_no)
				{
					$query="select * from member where no8=$cookie_no";
					$result=mysqli_query($db,$query);
					if(!$result) exit("에러:$query");
					$row=mysqli_fetch_array($result);
					$o_no=$row[no8];
					$o_name=$row[name8];
					//$o_tel=$row[tel8];
					//$o_phone=$row[phone8];
					$o_email=$row[email8];
					$o_zip=$row[zip8];
					$o_juso=$row[juso8];
					$o_tel1=substr("$row[tel8]",0,2);
					$o_tel2=substr("$row[tel8]",3,4);
					$o_tel3=substr("$row[tel8]",7,4);
					$o_phone1=substr("$row[phone8]",0,3);
					$o_phone2=substr("$row[phone8]",3,4);
					$o_phone3=substr("$row[phone8]",7,4);
				}
			?>
			<form name="form2" method="post" action="order_pay.html">
			<table width="710" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr>
					<td align="left" valign="top" width="150" STYLE="padding-left:45;padding-top:5">
						<font size="2" color="#B90319"><b>주문자 정보</b></font>
					</td>
					<td align="center" width="560">

						<table width="560" border="0" cellpadding="0" cellspacing="0" class="cmfont">
							<tr height="25">
								<td width="150"><b>주문자 성명</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="hidden" name="o_no" value="<?=$o_no?>">
									<input type="text"   name="o_name" size="20" maxlength="10" value="<?=$o_name?>" class="cmfont1">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>전화번호</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="o_tel1" size="4" maxlength="4" value="<?=$o_tel1?>" class="cmfont1"> -
									<input type="text" name="o_tel2" size="4" maxlength="4" value="<?=$o_tel2?>" class="cmfont1"> -
									<input type="text" name="o_tel3" size="4" maxlength="4" value="<?=$o_tel3?>" class="cmfont1">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>휴대폰번호</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="o_phone1" size="4" maxlength="4" value="<?=$o_phone3?>" class="cmfont1"> -
									<input type="text" name="o_phone2" size="4" maxlength="4" value="<?=$o_phone3?>" class="cmfont1"> -
									<input type="text" name="o_phone3" size="4" maxlength="4" value="<?=$o_phone3?>" class="cmfont1">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>E-Mail</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="o_email" size="50" maxlength="50" value="<?=$o_email?>" class="cmfont1">
								</td>
							</tr>
							<tr height="50">
								<td width="150"><b>주소</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="o_zip" size="5" maxlength="5" value="<?=$o_zip?>" class="cmfont1"> 
									<a href="javascript:FindZip(1)"><img src="images/b_zip.gif" align="absmiddle" border="0"></a> <br>
									<input type="text" name="o_juso" size="55" maxlength="200" value="<?=$o_juso?>" class="cmfont1"><br>
								</td>
							</tr>
						</table>

					</td>
				</tr>
				<tr height="10"><td></td></tr>
			</table>

			<!-- 배송지 정보 -->
			<table width="710" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr height="3" bgcolor="#CCCCCC"><td></td></tr>
				<tr height="10"><td></td></tr>
			</table>

			<table width="710" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr>
					<td align="left" valign="top" width="150" STYLE="padding-left:45;padding-top:5"><font size=2 color="#B90319"><b>배송지 정보</b></font></td>
					<td align="center" width="560">

						<table width="560" border="0" cellpadding="0" cellspacing="0" class="cmfont">
							<tr height="25">
								<td width="150"><b>주문자정보와 동일</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="radio" name="same" onclick="SameCopy('Y')">예 &nbsp;
									<input type="radio" name="same" onclick="SameCopy('N')">아니오
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>받으실 분 성명</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_name" size="20" maxlength="10" value="" class="cmfont1">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>전화번호</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_tel1" size="4" maxlength="4" value="" class="cmfont1"> -
									<input type="text" name="r_tel2" size="4" maxlength="4" value="" class="cmfont1"> -
									<input type="text" name="r_tel3" size="4" maxlength="4" value="" class="cmfont1">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>휴대폰번호</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_phone1" size="4" maxlength="4" value="" class="cmfont1"> -
									<input type="text" name="r_phone2" size="4" maxlength="4" value="" class="cmfont1"> -
									<input type="text" name="r_phone3" size="4" maxlength="4" value="" class="cmfont1">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>E-Mail</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_email" size="50" maxlength="50" value="" class="cmfont1">
								</td>
							</tr>
							<tr height="50">
								<td width="150"><b>주소</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_zip" size="5" maxlength="5" value="" class="cmfont1"> 
									<a href="javascript:FindZip(2)"><img src="images/b_zip.gif" align="absmiddle" border="0"></a> <br>
									<input type="text" name="r_juso" size="55" maxlength="200" value="" class="cmfont1"><br>
								</td>
							</tr>
							<tr height="50">
								<td width="150"><b>배송시요구사항</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<textarea name="memo" cols="60" rows="3" class="cmfont1"></textarea>
								</td>
							</tr>
						</table>

					</td>
				</tr>
				<tr height="10"><td></td></tr>
			</table>

			<table width="710" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr height="3" bgcolor="#CCCCCC"><td></td></tr>
				<tr height="10"><td></td></tr>
			</table>

			</form>

			<table width="710" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr>
					<td align="center">
						<img src="images/b_order4.gif" onclick="Check_Value()" style="cursor:hand">

						<!-- 이 바튼은 단지 다음문서로 가는 테스트용 버튼임. 삭제할 것  -->
						&nbsp;&nbsp <input type="button" value="다음 문서로(테스트용)" onclick="form2.submit();">

					</td>
				</tr>
				<tr height="20"><td></td></tr>
			</table>

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "main_bottom.php";
?>