
<?	
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	//echo $member['mb_id'];
	
$mb_id = $member['mb_id'];

	$no = sql_fetch_array(sql_query("select no from resume where mb_id = '{$mb_id}' "));
	$num = $no['no'];
	$sql = "update g5_member
					set resume_num		='{$num}'
					WHERE mb_id = '{$mb_id}'
			";
	sql_query($sql);
//이력서 데이터
$query = "select * ,
		(select area from area where area_number = a.place1) as place1,
		(select area_details from area_detail where area_number = a.place1 and no = a.place2) as place2
		FROM resume a , g5_member b
		where a.no = b.resume_num
		and a.mb_id = b.mb_id
		and b.mb_id = '$mb_id'
";
$resume = sql_query($query);
$mb = sql_fetch_array($resume);


$re_num = $member["resume_num"];
$resumeimg = "SELECT img
			FROM resume
			WHERE no = '$re_num'"; 
$re_img = sql_fetch_array( sql_query($resumeimg) );
/*
$query =" SELECT a.no,a.subject,a.mb_id,a.name,a.career_year,a.career_month,
                 (select place from place where no = a.place1) as place1,
                 (select place from place where no = a.place2) as place2,
				 case when status =0 then '미취업' else '취업' end status,
				 concat(phone1,'-',phone2,'-',phone3) as phone,
				 a.email,a.img,a.infomation_use,a.email_use,
				 substring(a.work_start_day,1,10) as work_start_day,a.price,
				 a.specialty,a.employ_kinds,
				 a.myself_text,a.hobby_text,a.other_text
			FROM resume a , g5_member b
			WHERE a.no ='$_GET[no]'	
             AND a.mb_id = b.mb_id 
             AND b.mb_id = '$mb_id'
     ";

$resume = sql_query($query);
$ru = sql_fetch_array($resume);	 
echo $ru['mb_id'];*/
/*
$query =" SELECT a.no,,a.mb_id,a.name,a.img,a.price,
            FROM resume a , g5_member b
		   WHERE a.no ='$_GET[no]'	
             AND a.mb_id = b.mb_id 
             AND b.mb_id = '$mb_id'
     ";*/
//echo $query;

//채용 공고 데이터
/*$query1 =" SELECT a.no,a.subject,a.mb_id,a.name,a.career,
				 a.address1,a.address2,a.price,
				 substring(a.work_s,1,10) as work_s,
				 a.specialty,a.img,
				 case when bonus = 1 then '유' else '무' end bonus,
				 case when price_chk = 1 then '면접시 협의' else '' end price_chk,
				 a.business_time, a.detailed, a.welfare
            FROM hire a , hire_application b, resume c
             WHERE 1 = 1
			 AND b.resume_id = '$mb_id'
			 AND b.resume_num = c.no

		";*/
/*
AND c.mb_id = b.resume_id
			 AND a.mb_id = b.mb_id
			 AND a.no = b.hire_num
			 AND b.resume_num = c.no
*/
	$sql = "select *,a.subject,a.price,a.company_name,a.address1,a.address2,
				(select area from area where area_number = a.place1) as place1,
				(select area_details from area_detail where area_number = a.place1 and no = a.place2) as place2,a.price_chk,
			 (select group_concat(d.specialty)
				   from hire_specialty e,specialty d
				  where e.mb_id = a.mb_id 
				    and e.specialty = d.order_num
					and e.hire_num = a.no
				) as specialty
	          from hire_application b, 
			       hire a ,
				   resume c
			 where c.no = b.resume_num
			   and a.no = b.hire_num
			   and c.mb_id = '$mb_id'";
$hire = sql_query($sql);


$ss = "select *
		from hire a, hire_application b
			where a.no = b.hire_num
			";
$hire_txt = sql_query($ss);
$sub=sql_fetch_array($hire_txt);

//거주지
$placeQuery1 = sql_query("select no,place from place");
$placeQuery2 = sql_query("select no,place from place");

//전문분야
$specialtyQuery = sql_query("select no,specialty from specialty order by order_num");
$specialtyArray = explode(",",$mb['specialty']);
$br = 0;
$specialty = sql_fetch_array($specialtyQuery);

//고용형태
$employKindsQuery = sql_query("select no,employ_kinds from employ_kinds  order by order_num");
$employKindsArray = explode(",",$mb['employ_kinds']);
$br1 = 0;

//자격증
$certificateQuery =sql_query("select * from resume_certificate where mb_id = '$mb[mb_id]'");

//지역벌쿼리
$area = sql_query("select * from area order by area_number asc");

$g5['title'] .= '이력서관리 '.$html_title;
//include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 j
?>
<!-- 탈퇴 스크립트 추가 s 2021.01.19-->
<script>
function member_leave() {  // 회원 탈퇴 tto
    if (confirm("회원에서 탈퇴 하시겠습니까?"))
        location.href = '<?php echo G5_BBS_URL ?>/member_confirm.php?url=member_leave.php';
}
</script>
<!DOCTYPE html>
<html lang="kr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>나의페이지</title>
	<link rel="shortcut icon" href="./img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/m/mobilCSS/main.css">
	<link rel="stylesheet" type="text/css" href="/m/mobilCSS/myPage.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="/script/slidBanner.json"></script>


</head>

<body>

		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/headerIndi.php');
		?>
		
		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/myPageIndi.php');
		?>

	
		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/footer.php');
		?>
	
</body></html>
