<?
	include "common.php";
	
	$no = $_REQUEST[no];
	$num = $_REQUEST[num];
	$opts1 = $_REQUEST[opts1];
	$opts2 = $_REQUEST[opts2];
	$cart = $_COOKIE[cart];
	$n_cart = $_COOKIE[n_cart];
	$kind = $_REQUEST[kind];
	if(!$n_cart) $n_cart=0;

	switch ($kind) {
		case "insert" :
		case "order" :
						$n_cart++;
						$cart[$n_cart] = implode("^",array($no, $num, $opts1, $opts2));
						list($no, $num, $opts1, $opts2)=explode("^",$cart[$n_cart]);
						setcookie("cart[$n_cart]",$cart[$n_cart]);
						setcookie("n_cart",$n_cart);
			break;
		
		case "delete" :
						$pos = $_REQUEST[pos];
						setcookie("cart[$pos]","");
						//$cart[$pos]; 쿠키삭제
			break;
			
		case "update" : 
						$pos = $_REQUEST[pos];	
						list($no, $num, $opts1, $opts2)=explode("^",$cart[$pos]);//알아오기
						$num = $_REQUEST[num];
						$cart[$pos] = implode("^",array($no, $num, $opts1, $opts2));
						setcookie("cart[$pos]",$cart[$pos]);
										//수량수정
										//이전 값에 새 수량으로 제품정보 합치기.
										//$pos번째에 제품정보 저장
			break;
		
		case "deleteall" : //장바구니 전체 비우기
		for($i=1; $i<=$n_cart; $i++)
		{
			if(!$cart[$i]==null) //cookie값 삭제
			setcookie("cart[$i]","");
		}
			$n_cart = 0; //>초기화
			setcookie("n_cart","");
			
		}
			
		if($kind=="order")
			echo("<script>location.href='order.php'</script>");
		else
			echo("<script>location.href='cart.php'</script>");
	
?>