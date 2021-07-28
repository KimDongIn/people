<?
include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
$sql_common = " from hire";
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

$g5['title'] = '이력서관리';
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
				company_name,
				career,
				concat(phone1,'-',phone2,'-',phone3) as phone,
				status
		{$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";

$result = sql_query($sql);

$colspan = 16;/*
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

$colspan = 16;*/

?>
<section>
	<div class="sectionColor1">
		<div class="sectionSell">
			<div class="interfaceBoard">

				<div class="bannerList">
					<div class="slidBanner">
						<ul>
							<li><img src="/img/banner_01.png"></li>
							<li><img src="/img/banner_02.png"></li>
							<li><img src="/img/banner_03.png"></li>
						</ul>
					</div>

				</div>



				<div class="sectionLink">

					<div class="loginDate">
						<div>
							<?echo $member['mb_name'];?>님
						</div>

						<div>
							<input type="button" name="" id="" onclick="logoutForm()">
							<label for="">
								<a href="./logout.php">
									<img id="logouButtom" src="./img/logoutButton.png">
								</a>
							</label>
						</div>
					</div>

					<div class="qukconnect">

						<!--개인-->
						<div class="col col-all-4">
							<a href="/recruitmentList.php" alt="채용정보">
								<img src="/img/con1.png" alt="con_img">
							</a>
						</div>

						<div class="col col-all-4">
							<a href="/resumeWrite.php" alt="이력서등록">
								<img src="/img/con2.png" alt="con_img">
							</a>
						</div>

						<div class="col col-all-4">
							<a href="/myPageIndi.php" alt="나의이력서">
								<img src="/img/con3.png" alt="con_img">
							</a>
						</div>
						<!--추가 기본사항-->
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

					</div>
				</div>
			</div>

			<!-- 광고 베너
			<div class="interfaceBoard">

					<div class="slidBanner2">
						<ul>
							<li><img src="/img/banner_03.png"></li>
							<li><img src="/img/banner_04.png"></li>
							<li><img src="/img/banner_03.png"></li>
							<li><img src="/img/banner_04.png"></li>
							
							<li><img src="/img/banner_03.png"></li>
							<li><img src="/img/banner_04.png"></li>
							<li><img src="/img/banner_03.png"></li>
							<li><img src="/img/banner_04.png"></li>
							
							<li><img src="/img/banner_03.png"></li>
							<li><img src="/img/banner_04.png"></li>
							<li><img src="/img/banner_03.png"></li>
							<li><img src="/img/banner_04.png"></li>
							
							<li><img src="/img/banner_03.png"></li>
							<li><img src="/img/banner_04.png"></li>
							<li><img src="/img/banner_03.png"></li>
							<li><img src="/img/banner_04.png"></li>
						</ul>
					</div>

			
			</div> -->

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
				<a href="./recruitmentInfo.php?no=<?=$row['no']?>" class="btn btn_03">
					<?//$_GET[] = $row['no']?>
					<div class="vipTitel">
						<?=$row['subject']?>
					</div>

					<div class="vipImg">
						<!--오류!!! 이미지 경로 잃음-->
						<img src="upload/comp_img/<?echo $row['img']?>" onerror="/img/icon.png">
					</div>

					<div class="vipText1"><?=$row['company_name']?></div>

					<!--<div class="" style="height: 10%;"><?//=$row['place1']?></div>-->
					<div class="vipText2"><?=$last_access[0]?>
					</div>
					
<!--					<div class="vipText2"><?=$row['place1']?></div>-->
					<!--반복문 --->
				</a>
			</div>
			<?}?>
			<?$sql = "select count(*) as cnt from hire"; //==>resume=이력서 저장테이블명
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
									<img src="../img/icon.png">
								</div>

								<div class="vipText1">구인업체 모집중</div>

								<div class="vipText2"></div>

							</a>
						</div>

			<?}?>
			<!--div class="col">
				<a href="#" alt="퀵메뉴1">

					<div class="vipTitel">
						차와사람들
					</div>
					<div class="vipImg">
						<img src="/img/icon.png" alt="">
					</div>
					<div class="vipText1">파트너 모집중</div>
					<div class="vipText2">신청하세요</div>

				</a>
			</div-->



		</div>
	</div>

</section>
