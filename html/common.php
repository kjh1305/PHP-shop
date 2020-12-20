<?
	$admin_id ="admin";
	$admin_pw ="1234";
	
	$page_line=5;
	$page_block=5;

	$db=mysqli_connect("localhost","shop8","1234","shop8");
	if (!$db) exit("DB연결에러");


	$a_idname=array("전체","이름","ID");
	$n_idname=count($a_idname);
	//분류
	$a_menu=array("분류선택","간식","사료","위생/배변","미용/목욕","건강관리","장난감/훈련","패션/의류","목줄/하네스","하우스");
	$n_menu=count($a_menu);
	//상품
	$a_status=array("상품상태","판매중","판매중지","품절");
	$n_status=count($a_status);
	//아이콘
	$a_icon=array("아이콘","New","Hit","Sale");
	$n_icon=count($a_icon);
	//제품
	$a_text1=array("","제품이름","제품번호");
	$n_text1=count($a_text1);

	$a_text2=array("신상품순 정렬","고가격수 정렬","저가격수 정렬","상품명 정렬");
	$n_text2=count($a_text2);
	
	
	$baesongbi = 2500;
	$max_baesongbi= 50000;
	
	$a_state=array("","주문신청","주문확인","입금확인","배송중","주문완료","주문취소");
	$n_state=count($a_state);
	
	$a_jumunstate=array("전체","주문신청","주문확인","입금확인","배달중","주문완료","주문취소");
	$n_jumunstate=count($a_jumunstate);
	
	$a_bun=array("주문번호","고객명","상품명");
	$n_bun=count($a_bun);
	
	$a_day[0]="일";
	for($aaa=1; $aaa<=31; $aaa++){
	$a_day[]=sprintf('%02d',$aaa);		
	}
	$n_day=count($a_day);

	$a_day2[0]="월";
	for($bbb=1; $bbb<=12; $bbb++){
	$a_day2[]=sprintf('%02d',$bbb);		
	}
	$n_day2=count($a_day2);
	
	$a_year[0]="년";
	for($ccc=2020; $ccc<=2030; $ccc++){
	$a_year[]=sprintf('%04d',$ccc);		
	}
	$n_year=count($a_year);
?>