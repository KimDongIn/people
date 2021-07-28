<!DOCTYPE html>
<html lang="kr">
<?	
	session_start();
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	echo $member['mb_id'];
?>

<?php
	
	if( isset( $member['mb_name'] ) ) {
	$jb_login = TRUE;
	}
?>

<head>
	<meta charset="UTF-8">
	<title>메인페이지</title>
	<link rel="shortcut icon" href="./img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/css/animationSwitch.css">
	<link rel="stylesheet" type="text/css" href="/css/gridSection.css">
	<link rel="stylesheet" type="text/css" href="/css/mainCSS.css">
	<link rel="stylesheet" type="text/css" href="/css/widthControl.css">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="/script/slidBanner.json"></script>

</head>

<script>

		jQuery(function($) {
			$(".sns-wrap").on("click", "a.social_link", function(e) {
				e.preventDefault();

				var pop_url = $(this).attr("href");
				var newWin = window.open(
					pop_url,
					"social_sing_on",
					"location=0,status=0,scrollbars=1,width=600,height=500"
				);

				if (!newWin || newWin.closed || typeof newWin.closed == 'undefined')
					alert('브라우저에서 팝업이 차단되어 있습니다. 팝업 활성화 후 다시 시도해 주세요.');

				return false;
			});
		});

</script>

<body>

<div>
	<?php
      if ( $jb_login ) {
    ?>
		<h1>결과 참</h1>
		
	<?php
    } else {?>
	
		<h1>결과 거짓</h1>

	<?php
    }?>
	</div>






	<div class="selldiv" style="">

		<header style="">
			<div class="headerSell">

				<div class="top_log">
					<a href="/index.php">
						<img id="" src="/img/logo.png" alt="회사로고">
					</a>
				</div>
				<!--
			<div class="search_bar">
				검색창 구역
			</div>
			-->
			</div>
		</header>


		<input type="checkbox" id="menuicon" style="display: none;">
		<nav>
			<div class="navSell">
				<div class="navBox">
					<!--위치 조정 필요할듯-->
					<div class="navSideLink">
						<label for="menuicon" class="menubtn">
							<span></span>
							<span></span>
							<span></span>
						</label>
					</div>

					<div class="navSwich" style="">
						<ul>
							<li><a href="/resumeList.php"><strong>인재정보</strong></a></li>
							<li><a href="/recruitmentList.php"><strong>채용정보</strong></a></li>
							<li><a href="/resumeWrite.php"><strong>이력서쓰기</strong></a></li>
							<li><a href="/recruitmentWrite.php"><strong>채용공고쓰기</strong></a></li>
						</ul>
					</div>

					<div class="myHomeLink" style="">
						<a href="/mypage.php" title="mypage">
							<img id="mypage_con" src="/img/my_page.png" alt="mypage">
						</a>
					</div>
				</div>
			</div>
		</nav>


		<!--사이드바 메뉴-->
		<div class="hideNavBar">
			<div class="contents">




			</div>
		</div>


		<section style="background-color: #cef2fd;">
			<div class="sectionSell">
				<div class="interfaceBoard">

					<div class="bannerList">
						<ul>

							<li>
								<img src="/img/banner_01.png">
							</li>
							<li>
								<img src="/img/banner_02.png">
							</li>
							<li>
								<img src="/img/banner_01.png">
							</li>
							<li>
								<img src="/img/banner_02.png">
							</li>

						</ul>
					</div>
					
					<div class="sideBanner">
					</div>




					<div class="sectionLink" style="">
					<!--if문 시작 ------------------------------------------------------>

					<div class="loginDate" style="">
						<div style="width: 40%; float: left;"><?echo $member['mb_name'];?>님</div>

						<div style="width: 40%; float: right;">
							
							<input type="button" name="" id=""  onclick="/gnu/bbs/logout.php">
							<label for="">
								<img id="logoutButtom" src="/img/logoutButton.png">
							</label>
						</div>
					</div>
							
					<!--if문 끝 ------------------------------------------------------>
					
					<div class="qukconnect">

								<div class="col col-lg-4 col-lm-4 col-md-4 col-sm-4 col-xs-4">
									<a href="/recruitmentList.php" alt="인재정보">
										<img src="/img/con1.png" alt="con_img">
									</a>
								</div>

								<div class="col col-lg-4 col-lm-4 col-md-4 col-sm-4 col-xs-4">
									<a href="/recruitmentWrite.php" alt="채용정보등록">
										<img src="/img/con2.png" alt="con_img">
									</a>
								</div>

								<div class="col col-lg-4 col-lm-4 col-md-4 col-sm-4 col-xs-4">
									<a href="#" alt="이력서찾기">
										<img src="/img/con3.png" alt="con_img">
									</a>
								</div>

								<div class="col col-lg-4 col-lm-4 col-md-4 col-sm-4 col-xs-4">
									<a href="/resumeList.php" alt="채용정보">
										<img src="/img/con4.png" alt="con_img">
									</a>
								</div>

								<div class="col col-lg-4 col-lm-4 col-md-4 col-sm-4 col-xs-4">
									<a href="/resumeWrite.php" alt="무료구직정보등록">
										<img src="/img/con5.png" alt="con_img">
									</a>
								</div>

								<div class="col col-lg-4 col-lm-4 col-md-4 col-sm-4 col-xs-4">
									<a href="#" alt="자사공고찾기">
										<img src="/img/con6.png" alt="con_img">
									</a>
								</div>

								<div class="col col-lg-4 col-lm-4 col-md-4 col-sm-4 col-xs-4">
									<a href="#" alt="퀵메뉴1">
										<img src="/img/void.png" alt="con_img">
									</a>
								</div>
								<div class="col col-lg-4 col-lm-4 col-md-4 col-sm-4 col-xs-4">
									<a href="#" alt="퀵메뉴1">
										<img src="/img/void.png" alt="con_img">
									</a>
								</div>
								<div class="col col-lg-4 col-lm-4 col-md-4 col-sm-4 col-xs-4">
									<a href="#" alt="퀵메뉴1">
										<img src="/img/void.png" alt="con_img">
									</a>
								</div>
							</div>


					</div>

					
				</div>
			</div>
		</section>


		<section>
			<div class="sectionSell">
				<div class="vipBoard">
					<!--
				<div class="col col-lg-3 col-lm-3 col-md-4 col-sm-6 col-xs-6">
					<a href="#" alt="퀵메뉴1">
						<img src="/img/Group%201.png" alt="">
					</a>
				</div>
				-->

					<div class="col">
						<a href="#" alt="퀵메뉴1">

							<div class="vipTitel" style="height: 10%;">
								차와사람들
							</div>
							<div class="vipImg" style="height: 70%;">
								<img src="/img/icon.png" alt="">
							</div>
							<div class="" style="height: 10%;">파트너 모집중</div>
							<div class="" style="height: 10%;">신청하세요</div>

						</a>
					</div>
					<div class="col">
						<a href="#" alt="퀵메뉴1">

							<div class="vipTitel" style="height: 10%;">
								차와사람들
							</div>
							<div class="vipImg" style="height: 70%;">
								<img src="/img/icon.png" alt="">
							</div>
							<div class="" style="height: 10%;">파트너 모집중</div>
							<div class="" style="height: 10%;">신청하세요</div>

						</a>
					</div>
					<div class="col">
						<a href="#" alt="퀵메뉴1">

							<div class="vipTitel" style="height: 10%;">
								차와사람들
							</div>
							<div class="vipImg" style="height: 70%;">
								<img src="/img/icon.png" alt="">
							</div>
							<div class="" style="height: 10%;">파트너 모집중</div>
							<div class="" style="height: 10%;">신청하세요</div>

						</a>
					</div>
					<div class="col">
						<a href="#" alt="퀵메뉴1">

							<div class="vipTitel" style="height: 10%;">
								차와사람들
							</div>
							<div class="vipImg" style="height: 70%;">
								<img src="/img/icon.png" alt="">
							</div>
							<div class="" style="height: 10%;">파트너 모집중</div>
							<div class="" style="height: 10%;">신청하세요</div>

						</a>
					</div>
					<div class="col">
						<a href="#" alt="퀵메뉴1">

							<div class="vipTitel" style="height: 10%;">
								차와사람들
							</div>
							<div class="vipImg" style="height: 70%;">
								<img src="/img/icon.png" alt="">
							</div>
							<div class="" style="height: 10%;">파트너 모집중</div>
							<div class="" style="height: 10%;">신청하세요</div>

						</a>
					</div>
					<div class="col">
						<a href="#" alt="퀵메뉴1">

							<div class="vipTitel" style="height: 10%;">
								차와사람들
							</div>
							<div class="vipImg" style="height: 70%;">
								<img src="/img/icon.png" alt="">
							</div>
							<div class="" style="height: 10%;">파트너 모집중</div>
							<div class="" style="height: 10%;">신청하세요</div>

						</a>
					</div>
					<div class="col">
						<a href="#" alt="퀵메뉴1">

							<div class="vipTitel" style="height: 10%;">
								차와사람들
							</div>
							<div class="vipImg" style="height: 70%;">
								<img src="/img/icon.png" alt="">
							</div>
							<div class="" style="height: 10%;">파트너 모집중</div>
							<div class="" style="height: 10%;">신청하세요</div>

						</a>
					</div>




				</div>
			</div>
		</section>


		<footer>
			<div class="footerSell">
				<center class="foodText">
					<p>회사명 : peoplecar 사업자등록번호 : 000-00-000000<br>
						주소 : 경기도 수원시 권선구 호매실로104번길 23-37 호매실동 1412-4 이메일 : vtac@hanmail.net 대표자 : 이해택 <br>
						Copyright 2020. HPEERAGE All rights reserved</p>
				</center>
			</div>
		</footer>

	</div>
</body>

</html>