	<?
			$jumunday=date("ymd");
			
			$o_name = $_REQUEST[o_name];
			$o_tel = $_REQUEST[o_tel];
			$o_phone = $_REQUEST[o_phone];
			$o_email = $_REQUEST[o_email];
			$o_zip = $_REQUEST[o_zip];
			$o_juso = $_REQUEST[o_addr];
			$r_name = $_REQUEST[r_name];
			$r_tel1 = $_REQUEST[r_tel];
			$r_phone = $_REQUEST[r_phone];
			$r_email = $_REQUEST[r_email];
			$r_zip = $_REQUEST[r_zip];
			$r_juso = $_REQUEST[r_addr];
			$memo = $_REQUEST[o_etc];
			$pay_method = $_REQUEST[pay_method];
			$card_no1 = $_REQUEST[card_no1];
			$card_no2 = $_REQUEST[card_no2];
			$card_no3 = $_REQUEST[card_no3];
			$card_no4 = $_REQUEST[card_no4];
			$card_okno = sprintf("%-4s%-4s%-4s%-4s",$card_no1,$card_no2,$card_no3,$card_no4);
			$card_kind=$_REQUEST[card_kind];
			$card_halbu=$_REQUEST[card_halbu];
			$bank_sender=$_REQUEST[bank_sender];
			$state=1;
			
			



			$query="insert into jumun (no8, member_no8, jumunday8, product_names8, product_nums8, o_name8, o_tel8,o_phone8,o_email8,o_zip8,o_juso8,r_name8,r_tel8,r_phone8,r_email8,
			r_zip8, r_juso8, memo8, pay_method8, card_okno8, card_halbu8, card_kind8, bank_kind8,
			bank_sender8, total_cash8,state8)
				values ('$jumundays','$member_no','$jumunday','$product_names','$product_nums',
				'$o_name','$o_tel','$o_phone','$o_email','$o_zip','$o_juso','$r_name','$r_tel','$r_phone','$r_email','$r_zip','$r_juso','$memo','$pay_method','$card_okno','$card_halbu','$card_kind','$bank_kind','$bank_sender','$total_cash','$state');";
			$result=mysqli_query($db,$query);
			if(!$result) exit("에러:$query");
	
			echo("<script>location.href='order_ok.php'</script>");