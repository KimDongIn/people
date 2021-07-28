<?
if(!isset($_SERVER["HTTPS"])) {
  header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
  exit;
}

	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	$mb_id = $member['mb_id'];
	$no = sql_fetch_array(sql_query("select no from resume where mb_id = '{$mb_id}' "));
	$num = $no['no'];
	$sql = "update g5_member
					set resume_num		='{$num}'
					WHERE mb_id = '{$mb_id}'
			";
	sql_query($sql);
	
	//mobile
	/*$mobileKeyWords = array ('iPhone', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'Windows CE', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson', 'Mobile', 'Symbian', 'Opera Mobi', 'Opera Mini', 'IEmobile');
	for($i = 0 ; $i < count($mobileKeyWords) ; $i++)
	{
		if(strpos($_SERVER[''HTTP_USER_AGENT''],$mobileKeyWords[$i]) == true)
		{
			header("Location: http://m.peoplecar.kr");
			exit;
		}
	}*/
	
/*
 // HTTP_USER_AGENT 로 체크해보면 다음과 같은 결과를 보여줍니다.
 // 결과: Mozilla/5.0 (Linux; U; Android 2.2; ko-k... 

 // 모바일 목록
 $mobilechk = '/(iPod|iPhone|Android|BlackBerry|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS)/i'; 

 // 모바일 접속인지 PC로 접속했는지 체크합니다.
 if(preg_match($mobilechk, $_SERVER['HTTP_USER_AGENT'])) {
    echo '모바일 접속입니다.';
 } else { 
    echo 'PC 접속입니다.'; 
 } 
 */
 //Check Mobile
$mAgent = array("iPhone","iPod","Android","Blackberry", 
    "Opera Mini", "Windows ce", "Nokia", "sony" );
$chkMobile = false;
for($i=0; $i<sizeof($mAgent); $i++){
    if(stripos( $_SERVER['HTTP_USER_AGENT'], $mAgent[$i] )){
        $chkMobile = true;
        break;
    }
}
if($chkMobile) {
    //모바일일 경우
	header( 'Location: https://peoplecar.kr/m/index.php' );
	//break;
	exit;
} else {
    //PC일 경우
	//header( 'Location: http://peoplecar.kr' );
	//exit;
	//break;
}
	
	
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

include_once(G5_PATH.'/head.sub.php');


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
	<title>사람과 자동차</title>
	<link rel="shortcut icon" type="" href="/img/favicon.ico">
	
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/index.css">
	
	<script type="text/javascript" src="/script/jquery-3.4.1.min.js"></script>
	
	<? include_once(G5_LIB_PATH.'/popular.lib.php'); ?>

</head>
	<script>
	
	/*개인*/
	function memberShipBtn1() {
		alert("로그인이 필요합니다.");
		location.href="/memberShipIndi.php"
	}
	/*기업*/
	function memberShipBtn2() {
		alert("로그인이 필요합니다.");
		location.href="/memberShipComp.php"
	}
	

	/* 이력서 보기 */
	function recruitmentBtn(num, lv) {
		var no = num;
		//var level = 4 ;
		var level = lv;
		var url = "/resumeInfo.php?no=" + no;
		
		if( level > 1 ){
			//alert(url);
			location.href=url;
		}
//		else if( level < 4 && level != 0 ){
//			alert("결제가 필요합니다.");
//			location.href="/yc5/shop/item.php"
//		}
		else{
			alert("로그인이 필요합니다.");
			location.href="/loginLink.php"
		}
	}
		
	/* 아이디 찾기 팜업창*/
	function showPopup() {
		window.open("/gnu/bbs/password_lost.php", "아이디 비번 찾기", "width=400, height=300, left=100, top=50"); 
	}
	
	</script>
	
	
<script>
	//페이지 시작시 사진 수량만큼 width 늘리기
	$(function() {
		//겔러리 사진 수량
		var gallIndex = $(".bannerList ul li").length;
		var gallwidth = gallIndex * 100 + "%";
		$(".bannerList ul").width(gallwidth);
		
		for(var i=0; i< (gallIndex -1); i++) {
			$(".g_item ul").append("<li></li>");
		}
		$(".g_item ul li").eq(0).addClass("on");
	})



	$().ready(function() {

		var gallIndex = $(".bannerList ul li").length;
		// 함수 실행시간
		// 겔러리 이미지가 2개 이상일때 돌기 
		//			alert(gallIndex);
		//			if (gallIndex > 4) {
		var gall = setInterval(bannerListFun, 4500);
		var inter = true;
		var idx = 0;
		//사진 가로 크기
		var photoWidth = $(".bannerList ul li").width();

		function bannerListFun() {
			// 겔러리 사진 수량
			// 전체수량 = li개수 - 중복출력 수(1)
			var imgNum = gallIndex - 2;
			//현재 페이지 수

			//페이지번호
			idx++;

			//처음 0 -> 1+ 페이지 이동
			$(".bannerList ul").animate({
				"left": -photoWidth * (idx) + "px"
			}, 1500);
			$(".g_item ul li").eq(idx).addClass("on").siblings().removeClass("on");

			//마지막 줄이면 인덱스가 총페이지num이랑 같으면

			if (idx > imgNum) {

				$(".bannerList ul").animate({
					"left": 0
				}, 0);
				$(".g_item ul li").eq(0).addClass("on").siblings().removeClass("on");
				idx = 0;
			}
		}
		//마우스 오버시 슬라이드 stop
		$(".bannerList, .g_item ").hover(function() {
			if (inter == true) {
				clearInterval(gall);
				inter = false;
			}
		}, function() {
			if (inter == false) {
				gall = setInterval(bannerListFun, 4500);
				inter = true;
			}
		});
		//
		
		$(".g_item ul li").on('click', function() {
			$(this).addClass("on").siblings().removeClass("on");
			idx = $(this).index();
			$(".bannerList ul").animate({
				"left": -photoWidth * (idx) + "px"
			}, 1500);
		});
	});



</script>

	<?
		include_once($_SERVER["DOCUMENT_ROOT"].'/script.php');
	?>

<body>
	
	

	<?
	include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
	
	
	if ($member['mb_level'] == 0){
		
		include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/header.php');
		include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/index.php');
		
	} else if( $member['mb_level']%2 == 0 && $member['mb_level'] != 0 ){ 
		
		include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/headerComp.php');
		include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/indexComp.php');

	} else if ($member['mb_level']%2 == 1 && $member['mb_level'] != 0 ){ 
		
		include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/headerIndi.php');
		include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/indexIndi.php');		
	}
			
	
	include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/footer.php');
	
	?>
	
	<?php include_once(G5_PATH."/tail.sub.php"); ?>
</body>
</html>