
<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	

<?
	include "main_top.php";
	include "common.php";
?>
			
<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	

			<!---- 화면 우측(신상품) 시작 -------------------------------------------------->	
			<table width="767" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="60">
						<img src="images/main_newproduct.jpg" width="767" height="40">
					</td>
				</tr>
			</table>
			
			<?
			//<table border="0" cellpadding="0" cellspacing="0">
			//	<!---1번째 줄-->
		
				
			//	<tr>
			//		<td width="150" height="205" align="center" valign="top">
						
							$query="select * from product where icon_new8=1 and status8=1 order by rand() limit 15";
							$result=mysqli_query($db,$query);
							if(!$result) exit("에러:$query");
							
							$num_col=5;
							$num_row=3;
							$count=mysqli_num_rows($result);
							$icount=0;
							
							echo("<table>");
							for($ir=0; $ir<$num_row; $ir++)
							{
								echo("<tr>");
								for($ic=0; $ic<$num_col; $ic++)
								{
									if($icount<$count)
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
							
							<?
							/*
							<table border="0" cellpadding="0" cellspacing="0" width="100" class="cmfont">
							<tr> 
								<td align="center"> 
									<a href="product_detail.html?no=109469"><img src="product/0000_s.jpg" width="120" height="140" border="0"></a>
								</td>
							</tr>
							<tr><td height="5"></td></tr>
							<tr> 
								<td height="20" align="center">
									<a href="product_detail.html?no=1"><font color="444444">상품명1</font></a>&nbsp; 
									<img src="images/i_hit.gif" align="absmiddle" vspace="1"> <img src="images/i_new.gif" align="absmiddle" vspace="1"> 
								</td>
							</tr>
							<tr><td height="20" align="center"><b>89,000 원</b></td></tr>
							<strike>89,000 원</strike><br><b>70,000 원</b></td></tr>
							
							
						</table>
						*/
						?>
					
				<!---2번째 줄-->
				
				<!---3번째 줄-->
				

			<!---- 화면 우측(신상품) 끝 -------------------------------------------------->	

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	
			<!---- 화면 우측(신상품) 끝 -------------------------------------------------->	

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	

<?
	include "main_bottom.php";
?>