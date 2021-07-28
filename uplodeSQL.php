<?php
	
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	$mb_level    = 	4;    // 인증 성공시 가맹점으로 리턴변수(개발자 개인변수)
//	$mb_level    = 	$member['mb_level'];    // 인증 성공시 가맹점으로 리턴변수(개발자 개인변수)
	$mb_id       = 	$member['mb_id'];
	

	//시간 체크
	$paydate = '2021-04-01 20:00:01';		//결제날짜
	$todate = date("Y-m-d H:i:s");			//오늘날짜
	// 현재날짜 - 결제날짜
	$DateDif 	= strtotime($todate) - strtotime($paydate) ;
	$Dday		= ceil($DateDif / (60*60 *24)) ; // 날짜차이
	/*
	// 기간 결제 확인
	if ($Dday > 30){
		
	}
	if ($mb_level == 3){
	
	} else if($mb_level == 5){
	
	}
	
	*/
		

	sql_query( "UPDATE g5_member 
		SET
		mb_level = '{$mb_level}', 
		mb_1 = '{$todate}'
		WHERE mb_id = '{$mb_id}';"
			  );

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div>
		<?php 
			echo $paydate // 결제날짜
		?>
	</div>
	<br>
	<div>
		<?php 
			echo  $todate// 오늘날짜
		?>
	</div>
	<br>
	<div>
		<?php 
			echo $Dday// 날짜차이
		?>
	</div>
	
	<div>레벨 : 
		<?php 
			echo $mb_level// 레벨
		?>
	</div>
	
	<div> 아이디 :
		<?php 
			echo $mb_id// 아이디
		?>
	</div>
</body>
</html>