
<?	
include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');

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

/**********검색조건 지역일경우 s *********/
if($searchSelect == 'area')
{
	//지역 선택 조건
	if($_GET['area']){
		$areaSearch = "and place1 = '".$_GET['area']."'";
	}else{
		$areaSearch = "and place1 = '02' "; //서울로 default
	}
	//시,구 선택 조건
	if($_GET['addArray']){
		$areaSearch2 ="and place2 in( ";
		for($i=0;$i<count($addArray);$i++){
			$areaSearch2 .="'$addArray[$i]',";
		}
		$areaSearch2 = substr($areaSearch2,0,-1);
		$areaSearch2 .=")";
	}
}/**********검색조건 지역일경우 e *********/


/**********검색조건 직종일경우 s *********/
if($searchSelect == 'job')
{
	if($_GET['specialtyArray']){
		$areaSearch2 ="and mb_id in ( select d.mb_id from resume_specialty d where d.specialty in ( ";
		for($i=0;$i<count($specialtyArray);$i++){
			$areaSearch2 .="'$specialtyArray[$i]',";
		}
		$areaSearch2 = substr($areaSearch2,0,-1);
		$areaSearch2 .="))";
	}
}/**********검색조건 직종일경우 e *********/


//날짜 데이터 가져올때 사용하는 문법 date_format(컬럼,'%Y-%m-%d') as 별칭,
$sql = " select a.subject, a.no, a.mb_id, a.name,
				a.email, a.price, a.img,a.specialty,
				date_format(a.wdate,'%Y-%m-%d') as wdate,
				case when a.career_year = 0 then '' else concat(a.career_year,'년') end career_year,
				case when a.career_month = 0 then '' else concat(a.career_month,'개월') end career_month,
				case when a.career_year = 0 and a.career_month =0 then '신입' else concat(a.career_year,'년 ',a.career_month,'개월') end  career
		   from resume a , hire_application b, g5_member c
		  where 1 = 1
		  and c.mb_id = b.resume_id
		  
		  and b.resume_num = a.no

		";
		//echo $sql;
$result = sql_query($sql);
//echo $result;
//and a.mb_id = b.resume_id
//a.no = b.resume_num
/*
(select area from area where area_number = a.place1) as place1,
				(select area_details from area_detail where area_number = a.place1 and no = a.place2) as place2,
				(select employ_kinds from employ_kinds where no = a.employ_kinds) as employ_kinds,
*/
//지역벌쿼리
$area = sql_query("select * from area order by area_number asc");
//분야별쿼리
$specialty = sql_query("select * from specialty order by order_num asc");
//$specialty = sql_query("select no,specialty from specialty order by order_num");
?>
<!DOCTYPE html>
<html lang="kr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>채용리스트</title>
	<link rel="shortcut icon" href="./img/favicon.ico">
	
	<link rel="stylesheet" type="text/css" href="/m/mobilCSS/main.css">
	<!--<link rel="stylesheet" type="text/css" href="/css/index.css">-->
	<link rel="stylesheet" type="text/css" href="/m/mobilCSS/list.css">

	<script src="/gnu/js/jquery-1.12.4.min.js"></script>
	<script>

	</script>
</head>


<body>
	<div class="selldiv">

		<!--- 해더 시작---------------------------------------------------------------------------------------------------->
		<?
		include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/headerComp.php');
	?>
		<!--- 해더 끝---------------------------------------------------------------------------------------------------->

		<section>
			<div class="sectionSell">
				<div class="supportList">

					<!-- 게시판 셀------------------------------------------------------->
					<?
						$i = 1;
						while($resumeList=sql_fetch_array($result)) {
						$address = explode(" ",$row['address']);
					?>
					<div class="supportCont">
						
						
						<!--
						<div class="supportInfo1">	
								<img src="/upload/profile/<?=$resumeList['img']?>">
						</div>
						-->

						<div class="supportInfo2">
								<!--제목-->
								<div>
									<a href="#"><strong><?=$resumeList['subject']?></strong></a>
								</div>
								

								<!--내용-->
								<div>
									<div>경력</div>
									<div><?=$resumeList['career_year']?> <?=$resumeList['career_month']?> </div>
								</div>

								<div>
									<div>모집분야</div>
									<div> 판금<? //=$resumeList['specialty'] ?> </div>
								</div>

								<div>
									<div>지역</div>
									<div> 경기도 <br>용인시<?//=$resumeList['place1']?> <?//=$resumeList['place2']?> </div>
								</div>

								<div>
									<div>연봉</div>
									<div><?=$resumeList['price']?>만원</div>
								</div>
						</div>
						<!-- 채용 버튼 -->
						<div class="supportInfo3">
							<!--이력서 보기 -->
							<div>
								<a href="./resumeInfo.php?no=<?=$resumeList['no']?>">이력서</a>
							</div>
							<div>
								<!-- 날짜 -->
								<p><?=$resumeList['wdate']?></p>
							</div>
						</div>
					</div>
					<?}?>



				</div>
			
			</div>
		</section>


		<?
		include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/footer.php');
		?>


	</div>
</body></html>
