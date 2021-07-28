<?php
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

//$g5['title'] = '채용관리';
//include_once('./admin.head.php');

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

$sql = " select a.subject,
				a.no,
				a.company_name,
				a.img,
				a.email,
				(select area from area where area_number = a.place1) as place1,
				(select area_details from area_detail where area_number = a.place1 and no = a.place2) as place2,
				(select group_concat(b.specialty)
				from resume_specialty c,specialty b
				where c.mb_id = a.mb_id 
					and c.specialty = b.order_num
				) as specialty,
				(select employ_kinds from employ_kinds where no = a.employ_kinds) as employ_kinds,
					date_format(a.wdate,'%Y-%m-%d') as wdate,
				concat(a.phone1,'-',a.phone2,'-',a.phone3) as phone,
				a.price,
				a.bonus,
				a.detailed,
				a.business_time,
				a.welfare,
				date_format(a.wdate,'%Y-%m-%d') as wdate,
				DATE_FORMAT(a.work_s, '%Y. %m. %d.') as workStart,
				DATE_FORMAT(a.work_e, '%Y. %m. %d.') as workEnd,
				0 apply,
				a.people,
				case when status = 0 then '모집중' else '?' end status
				from hire a
				where 1=1
				{$areaSearch} 
				{$areaSearch2} 
				{$specialtySearch}
				{$specialtySearch2}
				{$sql_order} limit {$from_record}, {$rows} ";
/*
select
	a.subject,		//채용 제목
	a.no,			//채용 번호
	a.company_name,	//기업 이름
	a.img,			//기업 로고
	a.email,		//기업 이메일
	(select area from area where area_number = a.place1) as place1,		//주소1
	(select area_details from area_detail where area_number = a.place1 and no = a.place2) as place2,		//주소2
	
	(select
		group_concat(b.specialty)		
		from resume_specialty c,specialty b			
		where
			c.mb_id = a.mb_id 
			and c.specialty = b.order_num
	) as specialty,
	(select employ_kinds from employ_kinds where no = a.employ_kinds) as employ_kinds,
		date_format(a.wdate,'%Y-%m-%d') as wdate,
	concat(a.phone1,'-',a.phone2,'-',a.phone3) as phone,
	a.price,
	a.bonus,
	a.detailed,
	a.business_time,
	a.welfare,
	date_format(a.wdate,'%Y-%m-%d') as wdate,
	DATE_FORMAT(a.work_s, '%Y. %m. %d.') as workStart,
	DATE_FORMAT(a.work_e, '%Y. %m. %d.') as workEnd,
	0 apply,
	a.people,
	case when status = 0 then '모집중' else '?' end status
	from hire a
	where 1=1
	{$areaSearch} 
	{$areaSearch2} 
	{$specialtySearch}
	{$specialtySearch2}
	{$sql_order} limit {$from_record}, {$rows}
*/



$result = sql_query($sql);

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
	<title>채용리스트</title>

	<?//include_once($_SERVER["DOCUMENT_ROOT"].'/_head.php');?>

	<link rel="shortcut icon" href="./img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/css/basic.css">
	<link rel="stylesheet" type="text/css" href="/css/gridSection.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/widthControl.css">
	<link rel="stylesheet" type="text/css" href="/css/list.css">
	<script src="/gnu/js/jquery-1.12.4.min.js"></script>
	<script>
		/*지역클릭시 구/동 */
		$(function() {

			//지역 선택 시 구,동 리스트 변경
			$(".areaList02").css("display", "block");
			$(".labelInputCheck").click(function() {
				var classFullName = $(this).attr('class');
				var classNm = classFullName.split(" ");
				var name = classNm[0].substring(5, 8);
				//기본 초기화
				$(".areaBox").css("display", "none");
				$(".areaBox > .add").prop("checked", false);

				//선택사항 전체부터 체크
				$(".areaList" + name).css("display", "block");
				$(".areaList" + name + " > .add").prop("checked", false);
				$(".areaList" + name + " > .all").prop("checked", true);
			});

			//지역 선택 후 검색 시 해당 시,구 나오도록 변경
			var area = "<?=$_GET['area']?>";
			if (area > 0) {
				$(".areaBox").css("display", "none");
				$(".areaList" + area).css("display", "block");
			}
			//일반 시,구를 누를경우 전체 체크해제
			$('.add').click(function() {
				$(".all").prop("checked", false);
			});

			//전체 선택 시 시,구를 전부 체크해제
			$('.all').click(function() {
				$(".add").prop("checked", false);
			});

			//직종별 전체 클릭시 직종별 전부 체크해제
			$('.allSpecialty').click(function() {
				$(".specialtyArray").prop("checked", false);
			});

			//직종별 선택시 
			$('.specialtyArray').click(function() {
				$(".allSpecialty").prop("checked", false);
			});
			//지역별,직종별 선택 시
			$('.radioJobJquery').change(function() {
				var job = $("input[name=search1]:checked").val();
				//$(".all").prop("checked", true);
				//$(".areaBox > .add").prop("checked", false);
				//$(".jabSelect  > .specialtyArray").prop("checked", false);
				$(".searchSelect").val(job);

			});
		});
		/*직업 선택시*/
		/*	$(function() {
				
				//직업 선택 시
				$(".specialty").css("display","block");
				$( ".labelInputCheck1" ).click(function() {
					var classFullName = $(this).attr('class');
					var classNm = classFullName.split(" ");
					var name = classNm[0].substring(5,8);
					//기본 초기화
					//$(".areaBox").css("display","none");
					//$(".areaBox > .add").prop("checked", false);
					//선택사항 전체부터 체크
					$(".specialtyList"+name).css("display","block");
					
				});
				//직업 선택 후 검색 시 해당 직업 나오도록 변경
				var specialty = "<?=$_GET['specialty']?>";
				if(specialty > 0){
					$(".specialtyBox").css("display","none");
					$(".specialtyList"+specialty).css("display","block");
				}
				//직업을 누를경우 전체 체크해제
				$('.arr').click( function() {
					$(".all").prop("checked", false);
				});
				
				//전체 선택 시 시,구를 전부 체크해제
				$('.all').click( function() {
					$(".arr").prop("checked", false);
				});
			});*/

	</script>
</head>


<body>

	<?
		include_once ($_SERVER["DOCUMENT_ROOT"].'/headerIndi.php');
	?>

	<section class="sectionColor1">
			<div class="sectionSell">
			
				<!--사이드 바-->
				<div class="sideSearchBar">

					<label for="" >
						검색창
					</label>

					<label for="areaSearch">
						지역별
					</label>

					<label for="jabSearch">
						직종별
					</label>

				</div>

				<!-- 검색구역! -->
				<div class="searchSell">

					<!-- 분류1 스위치----------------------------------->
					<input type="radio" name="search1" class="radioJobJquery" id="areaSearch" value="area" <? if(!$searchSelect or $searchSelect=='area' ){ echo " checked " ;}?>>
					<label for="areaSearch">
						지역별
					</label>
					<input type="radio" name="search1" class="radioJobJquery" id="jabSearch" value="job" <? if($searchSelect=='job' ){ echo " checked " ;}?>>
					<label for="jabSearch">
						직종별
					</label>

					<!--카테고리 1 지역1-->
					<div class="areaSell">
						<form id="" name="" action="?" onsubmit="" enctype="" autocomplete="off">
							<input type="hidden" name="searchSelect" class="searchSelect" value="<?=$searchSelect?>" />
							<!-- 지역 선택 스위치 s-->

							<div class="areaSelect select">
								<?
									$i = 1;
									while($areaList = sql_fetch_array($area)){ 
								?>
									<input type="radio" name="area" id="area<?=$areaList['area_number']?>" value="<?=$areaList['area_number']?>" <? if($i==1 or $_GET['area']==$areaList['area_number']){ echo " checked " ; }?>>
									<label class="label<?=$areaList['area_number']?> labelInputCheck" for="area<?=$areaList['area_number']?>"><?=$areaList['area']?></label>
								<?$i++;}?>

							</div><!-- 지역 선택 스위치 e-->

							<?	
								$area1 = sql_query("select * from area order by no asc");
								while($areaList1 = sql_fetch_array($area1)){
									$areaNumber = $areaList1['area_number'];
							?>

							<div class="areaBox areaList<?=str_pad($areaList1['area_number'], 2, "0", STR_PAD_LEFT)?>">
								<input type="checkbox" class="all" name="all" id="all<?=str_pad($areaList1['no'], 2, "0", STR_PAD_LEFT)?>" value="all" <? if($_GET['area']==$areaNumber && $_GET['all']){ echo " checked " ;}?>>
								<label class="labelBtn" for="all<?=str_pad($areaList1['no'], 2, "0", STR_PAD_LEFT)?>">전체</label>
								<?
								$areaDetail = sql_query("select * from area_detail where area_number = '$areaNumber' order by area_details asc");
								while($areaDetailList = sql_fetch_array($areaDetail)){
									if($addArray){
										if(in_array(str_pad($areaDetailList['no'], 2, "0", STR_PAD_LEFT),$addArray)){
											$addChk = "checked";
										}else{
											$addChk="";
										}
									}?>
								<input type="checkbox" name="addArray[]" class="add" id="add<?=str_pad($areaDetailList['no'], 2, "0", STR_PAD_LEFT)?>" value="<?=str_pad($areaDetailList['no'], 2, "0", STR_PAD_LEFT)?>" <?=$addChk?>>
								<label class="labelBtn" for="add<?=str_pad($areaDetailList['no'], 2, "0", STR_PAD_LEFT)?>"><?=$areaDetailList['area_details']?></label>
								<? } ?>
							</div>
							<? } ?>
							<button class="submitBtn" type="submit" id="">검색</button>
						</form>
					</div>


					<!--지역별 끝------------------------------------------------------>

					<!--분류2 카테고리 2 직종별-->
					<div class="jabSell">
						<form id="" name="" action="?" onsubmit="" method="" enctype="" autocomplete="off">
							<input type="hidden" name="searchSelect" class="searchSelect" value="<?=$searchSelect?>" />
							<div class="jabSelect select" style="">
								<?
									$i = 1;
								?>
								<input type="checkbox" class="allSpecialty" name="all" id="allSpecialty" value="all" <? if($_GET['all']){ echo " checked " ;}?> >
								<label class="labelInputCheck1" for="allSpecialty">전체</label>

								<?
									while($specialtyList = sql_fetch_array($specialty))
									{ 
										
										if($specialtyArray){
											if(in_array($specialtyList['order_num'],$specialtyArray)){
												$addChk = "checked";
											}else{
												$addChk="";
											}
										}
								?>

								<input type="checkbox" name="specialtyArray[]" class="specialtyArray" id="specialty<?=$specialtyList['order_num']?>" <?=$addChk?> value="<?=$specialtyList['order_num']?>">
								<label class="label<?=$specialtyList['order_num']?> labelInputCheck1" for="specialty<?=$specialtyList['order_num']?>"><?=$specialtyList['specialty']?></label>


								<?$i++;}?>


							</div>
							<button class="submitBtn" type="submit"> 검색 </button>
						</form>

					</div>
					
					<!--반복문 출력--------------------------------------------------------------->
					<div class="boardList">
				<table>
				
					<?
						$i = 1;
						while($hireList=sql_fetch_array($result)) {
						$address = explode(" ",$row['address']);
					?>

					<tr>
						<th class="sec1">
							<input type="checkbox">
						</th>

						<td class="sec2">
							<div>
								<img src="upload/profile<?echo $hireList['img']?>">
							</div>
						</td>

						<td class="sec3">
							<div class="infomation">
								<!--제목-->
								<a href="#">
									<strong>채용 제목</strong>
								</a>

								<!--내용-->
								<div>
									<div>경력</div>
									<div> <?=$hireList['career_year']?> </div>
								</div>

								<div>
									<div>모집분야</div>
									<div> <?=$hireList['specialty']?> </div>
								</div>

								<div>
									<div>지역</div>
									<div> <?=$hireList['place1']?> <?=$hireList['place2']?> </div>
								</div>

								<div>
									<div>고용형태</div>
									<div> <?=$hireList['employ_kinds']?> </div>
								</div>

								<div>
									<div>연봉</div>
									<div> <?=$hireList['price']?></div>
								</div>

							</div>
						</td>
						<!-- 채용 버튼 -->
						<td class="sec4">
							<!--이력서 보내기 -->
							<input type="button" id="btn1" onclick="">
							<label for="btn1">
								채용등록
							</label>

							<p><?=$hireList['wdate']?></p>
							<!-- 시간이 추가되면 변수 추가
							<p>시간시간</p>
							-->

						</td>
					</tr>
					<?}?>

				</table>
			</div>

				</div>
				<!-- 채용공고 리스트 끝------------------------------------------------>
			</div>
		</section>

		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/footer.php');
		?>
	

</body></html>

