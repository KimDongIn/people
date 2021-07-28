
<?	
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	//echo $g5_member['mb_id'];
/*
$u_mb_id = $member['mb_id'] 
= $g5_member['mb_id'];

$sql_common = " from hire";

$sql_search = " where 1=1 ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}
/*
if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";
*//*
if (!$sst) {
    $sst = "wdate";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함


$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';
*/
$g5['title'] = '기업 정보';
//include_once('./admin.head.php');
$mb_id = $member['mb_id'];
$sql = " select a.no,a.mb_id, a.subject, a.company_name,
			a.email,
			(select area from area where area_number = a.place1) as place1,
				(select area_details from area_detail where area_number = a.place1 and no = a.place2) as place2,place3,
			 (select group_concat(d.specialty)
				   from hire_specialty c,specialty d
				  where c.mb_id = a.mb_id 
				    and c.specialty = d.order_num
					and c.hire_num = a.no
				) as specialty,
			a.employ_kinds,
			a.career, a.img, address1 as address,
			a.price, a.detailed, a.age,a.business_time,a.welfare,
			case when bonus = 0 then '무' else '유' end bonus,
			a.phone1,a.price_chk,
			DATE_FORMAT(work_s, '%Y. %m. %d.') as workStart,
			DATE_FORMAT(work_e, '%Y. %m. %d.') as workEnd,
			a.people,
			b.mb_hp
		FROM hire a , g5_member b
		WHERE a.no = '$_GET[no]'
		AND a.mb_id = b.mb_id
	";	
//0 apply,
//case when status = 0 then '모집중' else '?' end status
//echo $sql;
$result = sql_query($sql);
$hi = sql_fetch_array($result);
$colspan = 16;
//이력서관리 입력정보
/*$query =" SELECT subject,mb_id,name,career_year,career_month,place1,place2,
				 email,phone1,phone2,phone3,img,status,infomation_use,email_use,
				 substring(work_start_day,1,10) as work_start_day,price,
				 specialty,employ_kinds,
				 myself_text,hobby_text,other_text
            FROM hire
		   WHERE no ='${no}'		
		";
$hire = sql_query($query);
$hi = sql_fetch_array($hire);*/
//거주지
$placeQuery1 = sql_query("select no,place from place");
$placeQuery2 = sql_query("select no,place from place");

//전문분야
//$specialtyQuery = sql_query("select no,specialty from specialty order by order_num");
//$specialtyArray = explode(",",$hi['specialty']);
//$br = 0;

//고용형태
$employKindsQuery = sql_query("select no,employ_kinds from employ_kinds  order by order_num");
$employKindsArray = explode(",",$hi['employ_kinds']);
$br1 = 0;

//자격증
$certificateQuery =sql_query("select * from resume_certificate where mb_id = '$mb[mb_id]'");

//$g5['title'] .= '이력서관리 '.$html_title;
//include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js


?>


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

	<link rel="stylesheet" type="text/css" href="/css/info.css">

<script>// alert('<? echo $member['resume_num'] ?>')</script>
</head>

<body>

	
	<?
		include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/headerIndi.php');
	?>

	<?
		include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/recruitmentInfo.php');
	?>

	<?
		include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/footerIndi.php');
	?>

</body></html>