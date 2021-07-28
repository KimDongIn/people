
<?	
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	/*//echo $member['mb_id'];
//$no = sql_fetch_array("select * from resume where no = (select resume_num from member where price ={'$mb_id'})");


//$변수 = sql_fetch_array(sql_query("select * from resume where mb_id = (select mb_id from member where mb_id ={'$mb_id'})"));
    
    
//auth_check($auth[$sub_menu], 'w');
//$cnt = sql_fetch_array(sql_query("select count(*) as cnt from resume where mb_id = '{$mb_id}'"));
//echo $member['mb_id'];
//$no = sql_fetch_array("select * from resume where no = '$mb[no]'");
//이력서관리 입력정보
/*$query =" SELECT no,subject,mb_id,name,career_year,career_month,place1,place2,
				 email,phone1,phone2,phone3,img,status,infomation_use,email_use,
				 substring(work_start_day,1,10) as work_start_day,price,
				 specialty,employ_kinds,
				 myself_text,hobby_text,other_text
            FROM resume  
		   WHERE no ='${no}'		
		";
*/
$mb_id = $member['mb_id'];

$query =" SELECT a.no,a.subject,a.mb_id,a.name,a.career_year,a.career_month,
                 a.place1,
                 a.place2,
				 a.place3,
				 case when status =0 then '미취업' else '취업' end status,
				 case when status =0 then '비희망' else '희망' end room,
				 a.phone1,
				 a.email,a.img,a.infomation_use,a.email_use,
				 substring(a.work_start_day,1,10) as work_start_day,a.price,
				 (select group_concat(d.specialty)
				   from resume_specialty c,specialty d
				  where c.mb_id = a.mb_id 
				    and c.specialty = d.order_num
				) as specialty,
				 a.employ_kinds,
				 a.myself_text,a.hobby_text,a.other_text
            FROM resume a , g5_member b
		   WHERE a.no ='$_GET[no]'	
             AND a.mb_id = b.mb_id 
             
     ";
	 //echo $query;
$resume = sql_query($query);
$mb = sql_fetch_array($resume);



/*
$query =" SELECT a.no,a.subject,a.mb_id,a.name,a.career_year,a.career_month,a.place1,a.place2,
				 a.email,a.phone1,a.phone2,a.phone3,a.img,a.status,a.infomation_use,a.email_use,
				 substring(a.work_start_day,1,10) as work_start_day,a.price,
				 a.specialty,a.employ_kinds,
				 a.myself_text,a.hobby_text,a.other_text
            FROM resume a , g5_member b
		   WHERE a.no ='$_GET[no]'	
             AND a.mb_id = b.mb_id 
             AND b.mb_id = '$mb_id'
     ";*/
//echo $query;


//거주지
$placeQuery1 = sql_query("select no,place from place");
$placeQuery2 = sql_query("select no,place from place");

//전문분야
$specialtyQuery = sql_query("select no,specialty from specialty order by order_num");
$specialtyArray = explode(",",$mb['specialty']);
$br = 0;

//고용형태
$employKindsQuery = sql_query("select no,employ_kinds from employ_kinds  order by order_num");
$employKindsArray = explode(",",$mb['employ_kinds']);
$br1 = 0;

//자격증
$certificateQuery =sql_query("select * from resume_certificate where mb_id = '$mb[mb_id]'");

$g5['title'] .= '이력서관리 '.$html_title;
//include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

?>
<?php
/*
$sql_common = " from resume";

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

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

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

$g5['title'] = '이력서관리';

$sql = " select subject,
				no,
				mb_id,
				name,
				email,
				case when career_year = 0 and career_month =0 then '신입' else concat(career_year,'년 ',career_month,'개월') end  career,
				concat(phone1,'-',phone2,'-',phone3) as phone,
				case when status =0 then '미취업' else '취업' end status
		{$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";

$result = sql_query($sql);

$colspan = 16;*/
?>


<!DOCTYPE html>
<html lang="kr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>메인페이지</title>
	<link rel="shortcut icon" href="./img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/m/mobilCSS/main.css">
	<link rel="stylesheet" type="text/css" href="/m/mobilCSS/info.css">
</head>

<body>

		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/headerComp.php');
		?>
		
		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/resumeInfo.php');
		?>
	
		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/footer.php');
		?>

</body></html>
