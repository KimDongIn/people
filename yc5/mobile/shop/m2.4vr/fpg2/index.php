<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
/*
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
				case when career_year = 0 and career_month =0 then '신입' else concat(career_year,'년 ',career_month,'개월') end  career,
				concat(phone1,'-',phone2,'-',phone3) as phone,
				case when status =0 then '미취업' else '취업' end status
		{$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";

$result = sql_query($sql);

$colspan = 16;*/
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
/*로그인*/
$id = $member['mb_id'];

/*if($id%2==0){
	include_once("/indexIndi.php");
}else($id%2==1){
	include_once("/indexComp.php");
}*/


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




					<input type="radio" name="tabmenu" id="tab01">
					<label for="tab01">

					</label>

					<input type="radio" name="tabmenu" id="tab02">
					<label for="tab02">

					</label>
					<input type="radio" name="tabmenu" id="tab00" checked>


					<div class="conbox con1">

						<label for="tab00">
							<img src="/img/close.png" alt="con_img">
						</label>


						<div class="qukLogin">

							<form name="foutlogin" action="/gnu/bbs/login_check.php" onsubmit="return fhead_submit(this);" method="post" autocomplete="off">

								<div class="signBox">
									<input type="text" id="oi_id" name="mb_id" required="" placeholder="Enter Your ID">
									<input type="password" name="mb_password" id="oi_pw" required="" placeholder="Enter Your Password">
								</div>

								<div class="loginButton">
									<button type="submit" id="ol_submit" value="로그인">로그인</button>
								</div>

								<div class="snsLogin" style="">

									<a href="/gnu/plugin/social/popup.php?provider=naver&amp;url=%2Fgnu%2F" onClick="window.open(this.href, '_blank', 'width=400px,height=600px,toolbars=no,scrollbars=no'); return false;"><img src="/img/naver.png"></a>
									<a href="/gnu/plugin/social/popup.php?provider=google&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-google" onClick="window.open(this.href, '_blank', 'width=400px,height=600px,toolbars=no,scrollbars=no'); return false;"><img src="/img/google.png"></a>
									<a href="/gnu/plugin/social/popup.php?provider=facebook&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-facebook" onClick="window.open(this.href, '_blank', 'width=400px,height=600px,toolbars=no,scrollbars=no'); return false;"><img src="/img/face.png"></a>
									<a href="/gnu/plugin/social/popup.php?provider=kakao&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-kakao" onClick="window.open(this.href, '_blank', 'width=400px,height=600px,toolbars=no,scrollbars=no'); return false;"><img src="/img/kakao.png"></a>

								</div>

								<div class="membershopButton">
									<a href="/memberShipIndi.php" style="font-size: 10px;">
										<span>아직 회원이 아니세요? <strong>회원가입</strong></span>
									</a>
								</div>
							</form>
						</div>

					</div>

					<div class="conbox con2">

						<label for="tab00"><img src="/img/close.png" alt="con_img"></label>


						<div class="qukLogin">
							<form name="foutlogin" action="/gnu/bbs/login_check1.php" onsubmit="return fhead_submit(this);" method="post" autocomplete="off">

								<div class="signBox">
									<!--input type="text" id="recruit_id" name="mb_id" required="" placeholder="Enter Your ID">
									<input type="password" name="mb_password" id="recruit_pw" required="" placeholder="Enter Your Password"-->
									<input type="text" id="oi_id" name="mb_id" required="" placeholder="Enter Your ID">
									<input type="password" name="mb_password" id="oi_pw" required="" placeholder="Enter Your Password">
								</div>

								<div class="loginButton">
									<button type="submit" id="ol_submit" value="로그인">로그인</button>
								</div>

								<div class="snsLogin">
									<a href="/gnu/plugin/social/popup.php?provider=naver&amp;url=%2Fgnu%2F" onClick="window.open(this.href, '_blank', 'width=400px,height=600px,toolbars=no,scrollbars=no'); return false;"><img src="/img/naver.png"></a>
									<a href="/gnu/plugin/social/popup.php?provider=google&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-google" onClick="window.open(this.href, '_blank', 'width=400px,height=600px,toolbars=no,scrollbars=no'); return false;"><img src="/img/google.png"></a>
									<a href="/gnu/plugin/social/popup.php?provider=facebook&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-facebook" onClick="window.open(this.href, '_blank', 'width=400px,height=600px,toolbars=no,scrollbars=no'); return false;"><img src="/img/face.png"></a>
									<a href="/gnu/plugin/social/popup.php?provider=kakao&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-kakao" onClick="window.open(this.href, '_blank', 'width=400px,height=600px,toolbars=no,scrollbars=no'); return false;"><img src="/img/kakao.png"></a>
								</div>

								<div class="membershopButton">
									<a href="/memberShipComp.php" style="font-size: 10px;">
										<span>아직 회원이 아니세요? <strong>회원가입</strong></span>
									</a>
								</div>
							</form>
						</div>


					</div>




					<div class="conbox con0">
						<div class="minMembership">

							<div class="qukMemberBtn">
								<a href="/memberShipIndi.php" alt="회원가입">회원가입</a>
								<span>/</span>
								<!-- 아디디 비번 찾기는 고도몰과 링크!!-->
								<a onClick="showPopup();" id="ol_password_lost">ID/PW 찾기</a>
								<!--
								<a href="http://peoplecar.kr/gnu/bbs/password_lost.php" id="ol_password_lost">ID/PW 찾기</a>
								-->
							</div>


<!--
							<div class="qukSnsLogin">
								<a href="/gnu/plugin/social/popup.php?provider=naver&amp;url=%2Fgnu%2Fbbs%2Fregister.php" class="sns-icon social_link sns-naver" alt="네이버로그인" onClick="window.open(this.href, '_blank', 'width=400px,height=600px,toolbars=no,scrollbars=no'); return false;">
									<img src="/img/naver_icon.png" alt="">
								</a>
								<a href="/gnu/plugin/social/popup.php?provider=facebook&amp;url=%2Fgnu%2Fbbs%2Fregister.php" class="sns-icon social_link sns-facebook" alt="페북로그인" onClick="window.open(this.href, '_blank', 'width=400px,height=600px,toolbars=no,scrollbars=no'); return false;">
									<img src="/img/facebook.png" alt="">
								</a>
								<a href="/gnu/plugin/social/popup.php?provider=kakao&amp;url=http%3A%2F%2Fpeoplecar.kr%2Fgnu%2Fadm%2F" class="sns-icon social_link sns-kakao" alt="카카오로그인" onClick="window.open(this.href, '_blank', 'width=400px,height=600px,toolbars=no,scrollbars=no'); return false;">
									<img src="/img/kakao_icon.png" alt="">
								</a>
								<a href="/gnu/plugin/social/popup.php?provider=google&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-google" alt="구글로그인" onClick="window.open(this.href, '_blank', 'width=400px,height=600px,toolbars=no,scrollbars=no'); return false;">
									<img src="/img/google-plus.png" alt="">
								</a>
							</div>
-->



						</div>


						<div class="qukconnect">
							<div class="col col-all-4">
								<a onclick="memberShipBtn1();" alt="">
									<img src="/img/con1.png" alt="con_img">
								</a>
							</div>
							<div class="col col-all-4">
								<a onclick="memberShipBtn1();" alt="">
									<img src="/img/con2.png" alt="con_img">
								</a>
							</div>
							<div class="col col-all-4">
								<a onclick="memberShipBtn1();" alt="">
									<img src="/img/con3.png" alt="con_img">
								</a>
							</div>

							<div class="col col-all-4">
								<a onclick="memberShipBtn2();" alt="채용정보">
									<img src="/img/con4.png" alt="con_img">
								</a>
							</div>

							<div class="col col-all-4">
								<a onclick="memberShipBtn2();" alt="무료구직정보등록">
									<img src="/img/con5.png" alt="con_img">
								</a>
							</div>

							<div class="col col-all-4">
								<a onclick="memberShipBtn2();" alt="자사공고찾기">
									<img src="/img/con6.png" alt="con_img">
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
							<div class="col col-all-4">
								<a alt="퀵메뉴1">
									<img src="/img/void.png" alt="con_img">
								</a>
							</div>
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
			
			</div>
			-->
		</div>
	</div>


	<div class="sectionSell">
		<!--	
	<div class="vipBoard">

			<div class="col">
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
			</div>
		</div>
		
-->
		<div class="vipBoard">

			<?// 조건 = 리스트가 없을때
				/* if($h1['cnt']==0){
					//리스트 8개					
					for($i = 0; $i < 8; $i++ ){?>
						<div class="col">
							<a class="btn btn_03">

								<div class="vipTitel">
									사람과 자동차
								</div>

								<div class="vipImg">
									<!--오류!!! 이미지 경로 잃음-->
									<img src="../img/icon.png">
								</div>

								<div class="vipText1">
									구인업체 모집중
								</div>

								<div class="vipText2"></div>

							</a>
						</div>

			<?}}//else{ */
					$i = 1;
					while($row=sql_fetch_array($result)) {
					$address = explode(" ",$row['address']);
					//location.href='./resumeInfo.php?no=<?=$row['resume_num']'
					//onClick="location.href='./resumeInfo.php?no=<?=$member['resume_num']'"
				?>
			<div class="col">
				<!--a href="/resumeInfo.php?no=<?//=$row['no']?>"-->
				<!--
							<a href="./recruitmentInfo.php?no=<?=$row['no']?>" class="btn btn_03">
						-->
				<a onclick="recruitmentBtn();" class="btn btn_03">

					<?//$_GET[] = $row['no']?>
					<div class="vipTitel">
						<?=$row['subject']?>
					</div>

					<div class="vipImg">
						<!--오류!!! 이미지 경로 잃음-->
						<img src="../upload/comp_img/<?echo $row['img']?>">
					</div>

					<div class="vipText1"><?=$row['company_name']?></div>


					<!--<div class="" style="height: 10%;"><?//=$row['place1']?></div>-->
					<div class="vipText2"><?=$last_access[0]?></div>

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
