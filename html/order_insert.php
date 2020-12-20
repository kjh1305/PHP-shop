<?
	include "common.php";

	$cookie_no = $_COOKIE[cookie_no];
	$cart = $_COOKIE[cart];
	$n_cart = $_COOKIE[n_cart];
	$card_no3 = $_REQUEST[card_no3];
	$card_no4 = $_REQUEST[card_no4];
	$card_okno = $card_no3.$card_no4;
	$pay_method = $_REQUEST[pay_method];
	$card_kind = $_REQUEST[card_kind];
	$card_halbu = $_REQUEST[card_halbu];
	$bank_kind = $_REQUEST[bank_kind];
	$bank_sender = $_REQUEST[bank_sender];
	$o_name = $_REQUEST[o_name];
	$o_tel = $_REQUEST[o_tel];
	$o_phone = $_REQUEST[o_phone];
	$o_email = $_REQUEST[o_email];
	$o_zip = $_REQUEST[o_zip];
	$o_juso = $_REQUEST[o_juso];
	$r_name = $_REQUEST[r_name];
	$r_tel = $_REQUEST[r_tel];
	$r_phone = $_REQUEST[r_phone];
	$r_email = $_REQUEST[r_email];
	$r_zip = $_REQUEST[r_zip];
	$r_juso = $_REQUEST[r_juso];
	$memo=$_REQUEST[memo];
	

	$total_cash = 0;
	$product_nums = 0;
	$product_names = 0;
	
	

	$query="select no8 from jumun where jumunday8=curdate() order by no8 desc limit 1";
			$result=mysqli_query($db,$query);
			if(!$result) exit("에러:$query");
			$count=mysqli_num_rows($result);
			$row3=mysqli_fetch_array($result);

			if($count>0){
				$jumundays=$row3[no8]+1;
			}
			else{
				$jumundays=date("ymd")."0001";
			}
			

	for($i=1; $i<=$n_cart; $i++)
	{
		if($cart[$i])
		{
			list($no,$num,$opts1,$opts2)=explode("^",$cart[$i]);
			$query="select * from product where no8=$no";
			$result=mysqli_query($db,$query);
			if(!$result) exit("에러:$query");
			$row=mysqli_fetch_array($result);
			$price=$row[price8];
			$cash=round($row[price8]*(100-$row[discount8])/100,-3);
			$discount=$row[discount8];
			$query="select * from opts where no8=$opts1";
			$result=mysqli_query($db,$query);
			if(!$result) exit("에러:$query");
			$row1=mysqli_fetch_array($result);
			$opts_no1=$row1[no8];				
			$query="select * from opts where no8=$opts2";
			$result=mysqli_query($db,$query);
			if(!$result) exit("에러:$query");
			$row2=mysqli_fetch_array($result);
			$opts_no2=$row2[no8];
			$product_nums = $product_nums + 1;
			$total_cash = $total_cash + $cash*$num;
			$query="insert into jumuns (jumun_no8, product_no8, num8, price8, cash8, discount8, opts_no18,opts_no28)
				values ('$jumundays','$no','$num','$price','$cash','$discount','$opts_no1','$opts_no2');";
			$result=mysqli_query($db,$query);
			if(!$result) exit("에러:$query");

		}
	}
			
			if($product_nums==1) $product_names = $row[name8];
			
			if($product_nums>1)
			{
				$tmp = $product_nums;
				$product_names = $row[name8]." 외 ".$tmp;
			}
			
			
			if($total_cash < $max_baesongbi)
			{
				$total_cash = $total_cash + $baesongbi;
				$query="insert into jumuns (jumun_no8, product_no8, num8, price8, cash8, discount8, opts_no18,opts_no28)
				values ('$jumundays','0','1','$baesongbi','$baesongbi',0,0,0);";
				$result=mysqli_query($db,$query);
				if(!$result) exit("에러:$query");	
			}
			

			//회원 비회원 구분하기
			
			if($cookie_no)
			$member_no = $cookie_no;
			else
			$member_no = 0;
			$jumunday=date("ymd");
			$state=1;
			if($pay_method ==0){
			$query="insert into jumun (no8, member_no8, jumunday8, product_names8, product_nums8, o_name8, o_tel8,o_phone8,o_email8,o_zip8,o_juso8,r_name8,r_tel8,r_phone8,r_email8,r_zip8,r_juso8,memo8,pay_method8,card_okno8,card_halbu8,card_kind8,bank_kind8,bank_sender8,total_cash8,state8)
				values ('$jumundays','$member_no','$jumunday','$product_names','$product_nums','$o_name','$o_tel','$o_phone','$o_email','$o_zip','$o_juso','$r_name','$r_tel','$r_phone','$r_email','$r_zip','$r_juso','$memo',$pay_method,'$card_okno','$card_halbu','$card_kind','$bank_kind','0',$total_cash,$state);";
			
			$result=mysqli_query($db,$query);
			if(!$result) exit("에러:$query");
			}
			else{
			$query="insert into jumun (no8, member_no8, jumunday8, product_names8, product_nums8, o_name8,o_tel8,o_phone8,o_email8,o_zip8,o_juso8,r_name8,r_tel8,r_phone8,r_email8,r_zip8, r_juso8, memo8, pay_method8, card_okno8, card_halbu8, card_kind8, bank_kind8,bank_sender8, total_cash8,state8)
				values ('$jumundays',$member_no,'$jumunday','$product_names',$product_nums,'$o_name','$o_tel','$o_phone','$o_email','$o_zip','$o_juso','$r_name','$r_tel','$r_phone','$r_email','$r_zip','$r_juso','$memo',$pay_method,0,$card_halbu,$card_kind,$bank_kind,'$bank_sender',$total_cash,$state);";
			$result=mysqli_query($db,$query);
			if(!$result) exit("에러:$query");
			}
			
			for($i=1; $i<=$n_cart; $i++)
			{
			if(!$cart[$i]==null) //cookie값 삭제
			setcookie("cart[$i]","");
			}
			$n_cart = 0; //>초기화
			setcookie("n_cart","");
			
			
			
			echo("<script>location.href='order_ok.php'</script>");
?>