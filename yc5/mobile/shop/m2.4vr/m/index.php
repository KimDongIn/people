<?	
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	$mb_id = $member['mb_id'];
	$no = sql_fetch_array(sql_query("select no from resume where mb_id = '{$mb_id}' "));
	$num = $no['no'];
	$sql = "update g5_member
					set resume_num		='{$num}'
					WHERE mb_id = '{$mb_id}'
			";
	sql_query($sql);
	
	
		//include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');

		//auth_check($auth[$sub_menu], 'r');

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
		*/
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

		$g5['title'] = '채용관리';
		//include_once('./admin.head.php');

	/*	$sql = " select 
					subject,
					company_name,
					address1 as address,
					concat(phone1,'-',phone2,'-',phone3) as phone,
					DATE_FORMAT(work_s, '%Y. %m. %d.') as workStart,
					DATE_FORMAT(work_e, '%Y. %m. %d.') as workEnd,
					0 apply,
					people,
					case when status = 0 then '모집중' else '?' end status
					{$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";

		$result = sql_query($sql);

		$colspan = 16;*/
$sql = " select 
			mb_id,
			subject,
			company_name,
			career,
			address1 as address,
			price,
			bonus,
			concat(phone1,'-',phone2,'-',phone3) as phone,
			DATE_FORMAT(work_s, '%Y. %m. %d.') as workStart,
			DATE_FORMAT(work_e, '%Y. %m. %d.') as workEnd,
			
			people,
			case when status = 0 then '모집중' else '?' end status
		{$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows}
	";	

$result = sql_query($sql);
//$mb = sql_fetch_array($resume);
$colspan = 16;
?>

<?php
	//로그인 필요 함수
	if( isset( $member['mb_name'] ) ) {
	$jb_login = TRUE;
	}
?>

<!DOCTYPE html>
<html lang="kr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>메인페이지</title>
	<link rel="shortcut icon" type="" href="/img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/m/mobilCSS/main.css">
	<link rel="stylesheet" type="text/css" href="/m/mobilCSS/index.css">

</head>
	<script>
	
	/*개인*/
	function memberShipBtn1() {
		alert("로그인이 필요합니다.");
		location.href="/m/loginLink.php"
	}
	/*기업*/
	function memberShipBtn2() {
		alert("로그인이 필요합니다.");
		location.href="/m/loginLink.php"
	}
	

	/* 이력서 보기 */
	function recruitmentBtn(num, lv) {
		var no = num;
		//var level = 4 ;
		var level = lv;
		var url = "/m/resumeInfo.php?no=" + no;
		
		if( level >= 4 ){
			//alert(url);
			location.href=url;
		}
		else if( level < 4 && level != 0 ){
			alert("결제가 필요합니다.");
			location.href="/m/payment.php"
		}
		else{
			alert("로그인이 필요합니다.");
			location.href="/m/loginLink.php"
		}
	}
		
	/* 아이디 찾기 팜업창*/
	function showPopup() {
		window.open("/m/gnu/bbs/password_lost.php", "아이디 비번 찾기", "width=400, height=300, left=100, top=50"); 
	}
	
	</script>

	<?
		include_once($_SERVER["DOCUMENT_ROOT"].'/script.php');
	?>

<body>

	<? if ($member['mb_level'] == 0){?>
		<!--- 로그인전 시작---------------------------------------------------------------------------------------------------->
		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/header.php');

			include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/index.php');
		?>
		<!--- 로그인전 끝---------------------------------------------------------------------------------------------------->
	<? } else if( $member['mb_level']%2 == 0 && $member['mb_level'] != 0 ){ ?>
			<!--- 기업 로그인 시작------------------------------------------------------------------------------------------------->
			<?
				include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/headerComp.php');

				include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/indexComp.php');
			?>
			<!--- 기업 로그인 끝------------------------------------------------------------------------------------------------->
		
	<? } else if ($member['mb_level']%2 == 1 && $member['mb_level'] != 0 ){ ?>
			<!--- 개인 로그인 시작---------------------------------------------------------------------------------------------------->
			<?
				include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/headerIndi.php');

				include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/indexIndi.php');
			?>
			<!--- 개인 로그인 끝---------------------------------------------------------------------------------------------------->
	<?}?>
		

		<!--- 풋터 시작---------------------------------------------------------------------------------------------------->
		
		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/footer.php');
		?>
		
		<!--- 풋터 끝---------------------------------------------------------------------------------------------------->

</body>
</html>