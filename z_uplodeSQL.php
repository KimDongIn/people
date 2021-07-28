<?php
	
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');

//	$mb_id					="회원아이디";	
//	$name					="회원이름";
//	$email					="email@test.com";
//	$phone1					="0101111111";
//	$phone2					="";
//	$phone3					="";
//
//	$last_access			="2021-04-28";//마지막 접속
//	$status 				="";// ??
//	$career					="10";//경력
//	$age					="30";//나이
//	$actual_image_name		="";//이미지
//	
//	$people					="1";//채용인원
//	$work_s					="2021-02-28";//모집기간s
//	$work_e					="2021-03-28";//모집기간e
//	$price_chk				="1";//임금협상
//	$price					="2000";//연봉
//	
//	$bonus					="";//상여금
//	$specialty				="";//직업군
//	$employ_kinds			="";//고용형태
//	$detailed				="1";//상세모집요강
//	$business_time			="1";//근무시간
//	
//	$welfare				="1";//회사복지
//	$place1					="02";//주소1
//	$place2					="101";//주소2
//	$place3					="";//주소3
//	$wdate					="2021-04-28";//작성날짜
//	
//	$address1				="02";//회사주소1
//	$address2				="101";//회사주소2
//	$post					="";
//	$exam					="";
//	$company_name			="에이치피어리지";//회사명
//
//	$company_total_people	="3";//사원수
//	$company_gender			="";//회사 성비
//	$subject				="성실한 근무자 구합니다.";//채용공고 제목
//	$status					="";
//	$resume_application		="";
//
//	$vip					="";
//	$company_num			="";
//
//
//// 업로드 쿼리
//	$sql = "insert into hire				
//				set	mb_id 	    			='{$mb_id}',	
//					name 					='{$name}',	
//					email 					='{$email}',	
//					phone1 					='{$phone1}',	
//					phone2 					='{$phone2}',	
//					phone3 					='{$phone3}',
//					
//					last_access 			='{$last_access}',					
//					company_status			='{$status}',	
//					career					='{$career}',	
//					age						='{$age}',
//					img 					='{$actual_image_name}',
//					
//					people					='{$people}',
//					work_s					='{$work_s}',
//					work_e					='{$work_e}',
//					price_chk				='{$price_chk}',
//					price					='{$price}',
//					
//					bonus					='{$bonus}',
//					specialty				='{$specialty}',
//					employ_kinds			='{$employ_kinds}',
//					detailed				='{$detailed}',
//					business_time			='{$business_time}',
//					
//					welfare					='{$welfare}',
//					place1					='{$place1}',
//					place2					='{$place2}',
//					place3					='{$place3}',
//					wdate					='{$wdate}',
//					
//					address1				='{$address1}',
//					address2				='{$address2}',
//					post					='{$post}',
//					exam					='{$exam}',
//					company_name			='{$company_name}',
//					
//					company_total_people	='{$company_total_people}',
//					company_gender			='{$company_gender}',		
//					subject 				='{$subject}',
//					status					='{$status}',
//					resume_application		='{$resume_application}',
//					
//					vip						='{$vip}',
//					company_num				='{$company_num}'
//	";
//$resert = sql_query( $sql );

//	sql_query( "UPDATE g5_member 
//		SET
//		mb_level = '{$mb_level}', 
//		mb_1 = '{$todate}'
//		WHERE mb_id = '{$mb_id}';"
//			  );
	
//$sql = "SELECT *
//		FROM hire a, company b
//		WHERE a.mb_id = b.mb_id
//		";
//$hire = sql_query($sql);
//$mb = sql_fetch_array($hire);

$qury = "SELECT COUNT(*)
		FROM `hire_application`
		WHERE mb_id = carhnt
";

$cunt = sql_fetch_array(sql_query($qury));

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>

<body>

<? echo $cunt['COUNT(*)'] ?>
</body></html>