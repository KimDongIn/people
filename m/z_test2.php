<?
//echo $member['mb_name'];
include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');

$sql_common = " from resume";
$sql_search = " where 1=1 ";
$placeQuery1 = sql_query("select no,place from place");
$placeQuery2 = sql_query("select no,place from place");
$specialtyQuery = sql_query("select no,specialty from specialty order by order_num");
$employKindsQuery = sql_query("select no,employ_kinds from employ_kinds  order by order_num");
//거주지
$placeQuery1 = sql_query("select no,place from place");
$placeQuery2 = sql_query("select no,place from place");

//전문분야
$specialtyQuery = sql_query("select no,specialty from specialty order by order_num");
$specialtyArray = explode(",",$mb['specialty']);
$br = 0;
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

//$g5['title'] = '이력서관리';
$sql = " select subject,
				no,
				mb_id,
				name,
				email,
				img,
				place1,
				place2,
				specialty,
				employ_kinds,
				case when career_year = 0 and career_month =0 then '신입' else concat(career_year,'년 ',career_month,'개월') end  career,
				concat(phone1,'-',phone2,'-',phone3) as phone,
				case when status =0 then '재직중' else '취업' end status
		{$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";

$result = sql_query($sql);

$colspan = 16;
//echo $g5_memnber['mb_name'];

/*======================================*/
/*리스트 추력*/
$listSql = " select @ROWNUM := @ROWNUM + 1 AS ROWNUM,
				a.no, a.mb_id, a.name, 
				(select area from area where area_number = a.place1) as place1,
				(select area_details from area_detail
				where area_number = a.place1
				and no = a.place2) as place2,
				a.subject,
				date_format(wdate, '%m-%d') as wdate,
				a.employ_kinds,
				(select group_concat(d.specialty)
					from resume_specialty d,specialty e
					where d.mb_id = a.mb_id 
					and d.specialty = e.order_num ) as specialty,
				a.career_year, a.career_month
				from resume a,
				(select @ROWNUM :=0) r
				where 1=1
				order by wdate desc
				";
$listBoard = sql_query($listSql);
/*======================================*/
?>

<section>
	<div class="sectionColor1">
		<div class="sectionSell">
			<div class="subBanner">
				<a href="http://pf.kakao.com/_PsxjTs" alt="">
					<img src="/img/banner/banner_icon1.png" alt="con_img">
				</a>
			</div>
			<div class="interfaceBoard">

				<div class="bannerList">
					<ul class="clearfix slidBanner">
						<!--
						<li><img src="/img/banner/banner_01.png"></li>
						<li><img src="/img/banner/banner_02.png"></li>
-->
						<li><img src="/img/banner/banner_03.png"></li>
						<li><img src="/img/banner/banner_04.png"></li>
						<li><img src="/img/banner/banner_05.png"></li>
						<li><img src="/img/banner/banner_06.png"></li>
						<li><img src="/img/banner/banner_07.png"></li>
						<li><img src="/img/banner/banner_01.png"></li>
					</ul>
				</div>
			</div>
		</div>
	</div>


	<div class="sectionSell">
		<div class="qukconnect" style="clear: both">

			<!--기업-->
			<div class="col col-all-4">
				<a href="/m/resumeList.php" alt="이력서정보">
					<img src="/img/con4.png" alt="con_img">
				</a>
			</div>

			<div class="col col-all-4">
				<a href="/m/recruitmentWrite.php" alt="채용등록">
					<img src="/img/con5.png" alt="con_img">
				</a>
			</div>

			<div class="col col-all-4">
				<a href="/m/myPageComp.php" alt="자사공고">
					<img src="/img/con6.png" alt="con_img">
				</a>
			</div>
			<!--추가 기본사항-->
			<!--
			<div class="col col-all-4">
				<a href="#" alt="퀵메뉴1">
					<img src="/img/void.png" alt="con_img">
				</a>
			</div>
			<div class="col col-all-4">
				<a href="#" alt="퀵메뉴1">
					<img src="/img/void.png" alt="con_img">
				</a>
			</div>
			<div class="col col-all-4">
				<a href="#" alt="퀵메뉴1">
					<img src="/img/void.png" alt="con_img">
				</a>
			</div>
-->
		</div>

	</div>
	<div class="sectionSell">
		<div class="vipBoard">

			<?
				$i = 1;
				while($row=sql_fetch_array($result)) {
					//$address = explode(" ",$row['address']);
					//location.href='./resumeInfo.php?no=<?=$row['resume_num']'
					//onClick="location.href='./resumeInfo.php?no=<?=$member['resume_num']'"
				?>
			<div class="col">
				<!--a href="/resumeInfo.php?no=<?//=$row['no']?>"-->
				<!--
				<a href="./resumeInfo.php?no=<?=$row['no']?>" class="btn btn_03">
				-->
				<a onclick="recruitmentBtn('<?=$row['no']?>', <?=$member["mb_level"]?>);" class="btn btn_03">
					<?//$_GET[] = $row['no']?>
					<div class="vipTitel">
						<?=$row['subject']?>
					</div>

					<div class="vipImg">
						<!--오류!!! 이미지 경로 잃음-->
						<img src="/upload/profile/<?=$row['img']?>" onerror="this.src='/img/icon.png'">
					</div>

					<div class="vipText1"><?=$row['name']?></div>

					<!--<div class="" style="height: 10%;"><?//=$row['place1']?></div>-->
					<div class="vipText2"><?=$last_access[0]?></div>

				</a>
			</div>
			<?}?>

			<?$sql = "select count(*) as cnt from resume"; //==>resume=이력서 저장테이블명
				$hire = sql_query($sql);
				$h1=sql_fetch_array($hire);
				
				//$h1['cnt'] => 테이블에 들어있는 이력서 갯수
				//[0, 1, 2, 3, 4, 5, 6, 7] 8-$h1['cnt'] *8개에서 테이블에 들어있는 이력서 갯수를 뺀수
				//그 숫자만큼 for문 돈다 8개 이하일때는 무조건 저 for문을 들어가서 돌게된다
				for($i = 0; $i < 8-$h1['cnt']; $i++ ){?>
			<div class="col">
				<a class="btn btn_03">

					<div class="vipTitel">
						자동차와 사람들
					</div>

					<div class="vipImg">
						<img src="/img/icon_gray.png">
					</div>

					<div class="vipText1">지원자 모집중</div>

					<div class="vipText2"></div>

				</a>
			</div>

			<?}?>
		</div>
	</div>
</section>

<section>
	<div class="sectionSell">
		<div class="listBoard list1">
			<table>
				<tr>
					<th>등록일</th>
					<th>제목</th>
					<th>분야</th>
					<th>지역</th>
				</tr>
				<!--
				<tr>
					<th>등록일</th>
					<th>기업체명</th>
					<th>제목</th>
					<th>구인분야</th>
					<th>마감일</th>
				</tr>
-->
				<?
					$i = 1;
					while($resumDate = sql_fetch_array($listBoard)) {
						
						//전문직업
						$specialtyArr = explode( ',', $resumDate['specialty'] );
						$specialty="";
						$i=0; $j=0;
						$specialtyQur = sql_query("SELECT * FROM specialty");

						while($spqur = sql_fetch_array($specialtyQur)){

							$spnum = $spqur['order_num'];
							if(in_array( $spnum, $specialtyArr)) {
								if( $j == 0){
									$specialty = $specialty.$spqur['specialty'];
									$j++;
								}else{
									$specialty = $specialty.", ".$spqur['specialty'];
								}
							}
						//	if($specialtyArr[$i] ==  $spqur['order_num']){
						//	};
							$i++;
						};
				?>
				<tr>
					<td><?=$resumDate['wdate']?></td>
					<td onclick="recruitmentBtn('<?=$resumDate['no']?>', <?=$member["mb_level"]?>);">
						<a><?=$resumDate['subject']?></a>
					</td>
					<td><?=$specialty?></td>
					<td><?=$resumDate['place1']?> <?=$resumDate['place2']?></td>
				</tr>
				
				<?	
					};
				?>
			</table>
		</div>
	</div>
</section>


<?
					
					


				
					
?>
