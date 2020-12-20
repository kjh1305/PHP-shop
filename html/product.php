<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "main_top.php";
	include "common.php";
	$sort=$_REQUEST[sort];
	$menu=$_REQUEST[menu];
	$page=$_REQUEST[page];
	$menu2=$_REQUEST[menu2];
?>


<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	

      <!-- 하위 상품목록 -->

			<!-- form2 시작 -->
			<form name="form2" method="post" action="product.php">
			<input type="hidden" name="menu" value="1">
			
			<table border="0" cellpadding="0" cellspacing="5" width="767" class="cmfont" bgcolor="#efefef">
				<tr>
					<td bgcolor="white" align="center">
						<table border="0" cellpadding="0" cellspacing="0" width="751" class="cmfont">
							<tr>
								<td align="center" valign="middle">
						
			<table border="0" cellpadding="0" cellspacing="0" width="730" height="40" class="cmfont">
										<tr>
										<?
											echo("<td width='500' class='cmfont'>");
											
												//echo("<select name='menu2'>");
												for($ai=1; $ai<$n_menu; $ai++){
													if($menu==$ai)
														echo("<font color='#C83762' class='cmfont'><b>$a_menu[$ai]&nbsp</b></font>&nbsp");
												}
												echo("</td>");
										?>
										<?
													
													$query="select * from product where menu8=$menu and status8=1 order by no8";

													$result=mysqli_query($db,$query);
													if(!$result) exit("에러:$query");
													$count=mysqli_num_rows($result);
							?>
											<td align="right" width="274">
												<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cmfont">
													<tr>
														<td align="right"><font color="EF3F25"><b><?=$count?></b></font> 개의 상품.&nbsp;&nbsp;&nbsp</td>
														<td width="100">
															<select name="sort" size="1" class="cmfont" onChange="form2.submit()">
																<option value="new" selected>신상품순 정렬</option>
																<option value="up">고가격순 정렬</option>
																<option value="down">저가격순 정렬</option>
																<option value="name">상품명 정렬</option>
															</select>
			
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</form>
			<!-- form2 -->

			<table border="0" cellpadding="0" cellspacing="0">
				<!--- 1 번째 줄 -->
				<tr>
<?
			//<table border="0" cellpadding="0" cellspacing="0">
			//	<!---1번째 줄-->
		
				
			//	<tr>
			//		<td width="150" height="205" align="center" valign="top">
						
							
							if ($sort=="up")
						$query="select * from product where menu8=$menu and status8=1 order by price8 desc";
					else if ($sort=="down")
						$query="select * from product where menu8=$menu and status8=1 order by price8";
					else if ($sort=="name")
						$query="select * from product where menu8=$menu and status8=1 order by name8";
					else
						$query="select * from product where menu8=$menu and status8=1 order by no8 desc";

							$result=mysqli_query($db,$query);
							if(!$result) exit("에러:$query");
							
							if(!$page) $page=1;	
							
							$num_col=5;
							$num_row=2; 
							$page_line=$num_col*$num_row;
							$count=mysqli_num_rows($result); //레코드개수
							$pages=ceil($count/$page_line);
							$icount=0;
							
							$first=1;
							if($count>0) $first=$page_line*($page-1);
							$page_last=$count-$first;
							if($page_last>$page_line) $page_last=$page_line;
							if($count>0) mysqli_data_seek($result,$first);


							echo("<table>");
							for($ir=0; $ir<$num_row; $ir++)
							{
								echo("<tr>");
								for($ic=0; $ic<$num_col; $ic++)
								{
									if($icount<= $page_last-1)
									{
										$row=mysqli_fetch_array($result);
										$price=number_format($row[price8]);
										echo("<td width='150' height='205' align='center' valign='top'>");
										echo("<table border='0' cellpadding='0' cellspacing='0' width='100' class='cmfont'>");
							echo("<tr>"); 
								echo("<td align='center'>"); 
									echo("<a href='product_detail.php?no=$row[no8]'><img src='product/$row[image18]' width='120' height='140' border='0'></a>");
								echo("</td>");
							echo("</tr>");
							echo("<tr><td height='5'></td></tr>");
							echo("<tr>"); 
								echo("<td height='20' align='center'>
									<a href='product_detail.php?no=$row[no8]'><font color='444444'>$row[name8]</font></a><br>&nbsp;"); 
									if($row[icon_new8] == 1)
									echo("<img src='images/i_new.gif' align='absmiddle' vspace='1'>");
									if($row[icon_hit8] == 1)
									echo("<img src='images/i_hit.gif' align='absmiddle' vspace='1'>");
									if($row[icon_sale8] == 1)
									echo("<br><img src='images/i_sale.gif' align='absmiddle' vspace='1'><font color='red'> $row[discount8]% !!</font>"); 
								echo("</td>");
							echo("</tr>");

							if($row[icon_sale8] == 0){
								echo("<tr><td height='20' align='center'><b> $price 원</b></td></tr>");
							}
							else{
								$price1=number_format(round($row[price8]*(100-$row[discount8])/100,-3));
								echo("<tr><td height='20' align='center'<b><strike>$price 원</strike><br><b>$price1 원</b></td></tr>");
							}
						echo("</table>");
										
										echo("</td>");
									}
								else
									echo("<td></td>");
								$icount++;
								}
								echo("</tr>");
							}
							echo("</table>");
							?>
					</td>
					

					

				</tr>
				
				
			</table>
			<?
			/*
			<table border="0" cellpadding="0" cellspacing="0" width="690">
				<tr>
					<td height="40" class="cmfont" align="center">
						<img src="images/i_prev.gif" align="absmiddle" border="0"> 
						<font color="#FC0504"><b>1</b></font>&nbsp;
						<a href="product.php?menu=1&sort=1&page=1">
						<font color="#7C7A77">[2]</font></a>&nbsp;
						<a href="product.php?menu=$menu&sort=$sort&page=$page"><font color="#7C7A77">[3]</font></a>&nbsp;
						<img src="images/i_next.gif" align="absmiddle" border="0">
					</td>
				</tr>
			</table>
			*/?>
			
<?
echo("<table width='400' border='0' cellspacing='0' cellpadding='0'>
	<tr>
	<td height='40' class='cmfont' align='center'>");
	
	$blocks = ceil($pages/$page_block);
	$block = ceil($page/$page_block);
	$page_s = $page_block * ($block-1);
	$page_e = $page_block * $block;
	if($blocks <= $block) $page_e = $pages;

	if($block>1)
	{
		$tmp=$page_s;
		echo("<a href='product.php?page=$tmp&menu=$menu&sort=$sort'>
		<img src='images/i_prev.gif' align='absmiddle'border='0'>
		</a>&nbsp");
	}
	for($i=$page_s+1; $i<=$page_e; $i++)
	{
		if($page==$i)
			echo("&nbsp;<font ed'><b>$i</b></font>&nbsp;");
		else
			echo("&nbsp;<a href='product.php?page=$i&menu=$menu&sort=$sort'>[$i]</a>&nbsp;");
	}
	if($block < $blocks)
	{
		$tmp=$page_e+1;
		echo("<a href='product.php?page=$tmp&menu=$menu&sort=$sort'>
		<img src='images/i_next.gif' align='absmiddle' border='0'>
		</a>");
	}
	echo("	</td>
	</tr>
	</table>");
?>
<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "main_bottom.php";
	
?>