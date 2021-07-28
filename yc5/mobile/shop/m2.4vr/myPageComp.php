
<?	
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');


$mb_id = $member['mb_id'];
$mb_img = $member['mb_img'];
$img = sql_fetch_array(sql_query("select img from g5_member where mb_id = '{$mb_id}'"));
//$mb_img = $img['mb_img'];

$no = sql_fetch_array(sql_query("select no from where mb_id = '{$mb_id}' "));
	$num = $no['no'];
//	$sql = "update g5_member
//					set company_num		='{$num}'
//					WHERE mb_id = '{$mb_id}'
//			";
//	sql_query($sql);
//	$sql = "update hire
//					set company_num		='{$num}'
//					WHERE mb_id = '{$mb_id}'
//			";
//	sql_query($sql);
//	$sql = "update hire
//					set img		='{$mb_img}'
//					WHERE mb_id = '{$mb_id}'
//			";
//	sql_query($sql);
$query =" SELECT a.no,a.subject,a.mb_id,a.name,a.career,
				 a.address1,a.address2,a.price,
				 substring(a.work_s,1,10) as work_s,
				 (select group_concat(d.specialty)
				   from hire_specialty c,specialty d
				  where c.mb_id = a.mb_id 
				    and c.specialty = d.order_num
					and c.hire_num = a.no
				) as specialty,
				 a.img,
				 a.place1,a.place2,a.place3,
				 case when bonus = 1 then '유' else '무' end bonus,
				 case when price_chk = 1 then '면접시 협의' else '' end price_chk,
				 a.business_time, a.detailed, a.welfare,
				 (select count(*) from hire_application where hire_num = a.no) as cnt
            FROM hire a , g5_member b
             WHERE 1 = 1
			 AND a.mb_id = b.mb_id
			 AND b.mb_id = '$mb_id'
		";
		
$hire = sql_query($query);
$sql =" SELECT a.no,a.mb_id,a.img
			 FROM hire a , g5_member b
             WHERE 1 = 1
			 AND a.mb_id = b.mb_id
			 AND b.mb_id = '$mb_id'
		";
		
$hi1 = sql_query($sql);
$hi = sql_fetch_array($hi1);

$specialtyQuery = sql_query("select no,specialty from specialty order by order_num");
$specialtyArray = explode(",",$hi['specialty']);

$area = sql_query("select * from area order by area_number asc");
$areaArray = sql_fetch_array($area);
$query = "select a.no,a.area_details,a.area_number
				from area_detail a
				where 1=1
				";
$area_detail = sql_query($query);
$area_detailsArray = sql_fetch_array($area_detail);
	//$placeQuery1 = sql_query("select no,place from place");
	//$placeQuery2 = sql_query("select no, area_details, area_number from area_detail where  area_number = '$mb[place1]' ");
?>
<!-- 탈퇴 스크립트 추가 s 2021.01.19-->
<script>
function member_leave() {  // 회원 탈퇴 tto
    if (confirm("회원에서 탈퇴 하시겠습니까?"))
        location.href = '<?php echo G5_BBS_URL ?>/member_confirm.php?url=member_leave.php';
}
</script>
<!-- 탈퇴 스크립트 추가 e 2021.01.19-->
<!DOCTYPE html>
<html lang="kr">

<head>
	<meta charset="UTF-8">
	<title>사람과 자동차</title>
	<link rel="shortcut icon" href="./img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/css/basic.css">
	<link rel="stylesheet" type="text/css" href="/css/gridSection.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/widthControl.css">

	<link rel="stylesheet" type="text/css" href="/css/myPage.css">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="/script/slidBanner.json"></script>


</head>

<body>

		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/headerComp.php');
		?>
		
		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/myPageComp.php');
		?>

		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/footerComp.php');
		?>

</body></html>
