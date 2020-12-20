<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "common.php";
	include "main_top.php";
	$cart = $_COOKIE[cart];
	$n_cart = $_COOKIE[n_cart];
	$kind = $_REQUEST[kind];
	
?>
<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	

			<!--  현재 페이지 자바스크립  -------------------------------------------->
			<script language = "javascript">

			function cart_edit(kind,pos) {
				if (kind=="deleteall") 
				{
					location.href = "cart_edit.php?kind=deleteall";
				} 
				else if (kind=="delete")	{
					location.href = "cart_edit.php?kind=delete&pos="+pos;
				} 
				else if (kind=="insert")	{
					var num=eval("form2.num"+pos).value;
					location.href = "cart_edit.php?kind=insert&pos="+pos+"&num="+num;
				}
				else if (kind=="update")	{
					var num=eval("form2.num"+pos).value;
					location.href = "cart_edit.php?kind=update&pos="+pos+"&num="+num;
				}
			}

			</script>

			<!-- form2 시작  -->
			<table border="0" cellpadding="0" cellspacing="0" width="747">
				<tr><td height="13"></td></tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" width="746">
				<tr>
					<td height="30" align="left"><img src="images/cart_title.gif" width="746" height="30" border="0"></td>
				</tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" width="747">
				<tr><td height="13"></td></tr>
			</table>

			<table border="0" cellpadding="0" cellspacing="0" width="710" class="cmfont">
				<tr>
					<td><img src="images/cart_title1.gif" border="0"></td>
				</tr>
			</table>

			<table border="0" cellpadding="0" cellspacing="0" width="710">
				<tr><td height="10"></td></tr>
			</table>

			<table border="0" cellpadding="5" cellspacing="1" width="710" class="cmfont" bgcolor="#CCCCCC">
				<tr bgcolor="F0F0F0" height="23" class="cmfont">
					<td width="420" align="center">상품</td>
					<td width="70"  align="center">수량</td>
					<td width="80"  align="center">가격</td>
					<td width="90"  align="center">합계</td>
					<td width="50"  align="center">삭제</td>
				</tr>

				<form name="form2" method="post">
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
						<input type='text' name='num$i' size='3' value='$num' class='cmfont1'>&nbsp<font color='#464646'>개</font>
					</td>
					<td align='center' bgcolor='#FFFFFF'><font color='#464646'>$price</font></td>
					<td align='center' bgcolor='#FFFFFF'><font color='#464646'>$price1 </font></td>
					<td align='center' bgcolor='#FFFFFF'>");
						?>
						<a href = "javascript:cart_edit('update','<?=$i?>')"><img src='images/b_edit1.gif' border="0"></a>&nbsp<br>
						<a href = "javascript:cart_edit('delete','<?=$i?>')"><img src='images/b_delete1.gif' border="0"></a>&nbsp
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
			</form>
			<!-- form2 끝  -->
			<table width="710" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr height="44">
					<td width="710" align="center" valign="middle">
						<a href="index.html"><img src="images/b_shopping.gif" border="0"></a>&nbsp;&nbsp;
						<a href="javascript:cart_edit('deleteall',0)"><img src="images/b_cartalldel.gif" width="103" height="26" border="0"></a>&nbsp;&nbsp;
						<a href="order.php"><img src="images/b_order1.gif" border="0"></a>
					</td>
				</tr>
			</table>

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "main_bottom.php";
?>