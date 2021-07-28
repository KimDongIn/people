<!DOCTYPE html>
<html lang="kr">

<head>
	<meta charset="UTF-8">
	<title>사람과 자동차</title>
	<link rel="shortcut icon" type="" href="/img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/css/basic.css">
	<link rel="stylesheet" type="text/css" href="/css/gridSection.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/index.css">
	<link rel="stylesheet" type="text/css" href="/css/widthControl.css">

</head>



<body>

	<header>

		<div class="headerSell">

			<div class="top_log col-all-3">
				<a href="/index.php">
					<img id="" src="/img/logo.png" alt="회사로고">
				</a>
			</div>

		</div>
	</header>

	<nav>

		<div class="navSell">

			<input type="checkbox" id="menuicon" style="display: none;">
			<div class="navSideLink">
				<label for="menuicon" class="menubtn">
					<span></span>
					<span></span>
					<span></span>
				</label>
			</div>

			<div class="hideNavBar">
				<div class="contents">

					<ul>
					<li><a href="/indexComp.php"><strong>기업메인</strong></a></li>
					<li><a href="/indexIndi.php"><strong>개인메인</strong></a></li>

					<li><a href="/myPageComp.php"><strong>마이페이지 기업</strong></a></li>
					<li><a href="/myPageIndi.php?no=<?=$member['resume_num']?>"><strong>마이페이지 개인</strong></a></li>

					<li><a href="/memberShipComp.php"><strong>회원가입기업</strong></a></li>
					<li><a href="/memberShipIndi.php"><strong>회원가입개인</strong></a></li>

					<li><a href="/memberComp.php"><strong>회원정보관리(기업)</strong></a></li>
					<li><a href="/memberIndi.php"><strong>회원정보관리(개인)</strong></a></li>

				</ul>

				<ul>
					<li><a href="/company.php"><strong>기업정보 관리</strong></a></li>
					<li><a href="/recruitment.php"><strong>채용공고 관리</strong></a></li>
					<li><a href="/recruitmentWrite.php"><strong>채용공고 쓰기</strong></a></li>

					<li><a href="/resume.php"><strong>이력서 관리</strong></a></li>
					<li><a href="/resumeWrite.php"><strong>이력서 쓰기</strong></a></li>

					<li><a href="/inquiryWrite.php"><strong>문의 게시판 쓰기</strong></a></li>

					<li><a href="/resumeList.php"><strong>이력서게시판's</strong></a></li>
					<li><a href="/recruitmentList.php"><strong>채용게시판's3</strong></a></li>
				</ul>

				<ul>
					<li><a href="/recruitmentInfo.php"><strong>채용내용</strong></a></li>
					<li><a href="/companyInfo.php"><strong>기업정보</strong></a></li>
					<li><a href="/resumeInfo.php?no=<?=$row['no']?>"><strong>이력서 내용</strong></a></li>
					<li><a href="/inquiryList.php"><strong>문의 게시판</strong></a></li>
					<li><a href="/inquiryInfo.php"><strong>문의 게시판 정보</strong></a></li>
				</ul>


				</div>
			</div>
		</div>
	</nav>


	<footer>
		<div class="footerSell" style="; height: 300px;">
			<div class="footerLogo">
				<img src="/img/ft_logo.png" alt="하단로고">
			</div>

			<div class="footerLink">
				<ul>
					<li><a href="#">인제정보</a></li>
					<li><a href="#">채용정보</a></li>
					<li><a href="#">이력서쓰기</a></li>
					<li><a href="#">채용공고쓰기</a></li>
				</ul>
			</div>

			<div class="PandCInfo">
				<p>회사명 : peoplecar<br>
					사업자등록번호 : 000-00-000000<br>
					주소 : 경기도 수원시 권선구 호매실로104번길 23-37 호매실동 1412-4<br>
					이메일 : vtac@hanmail.net<br>
					대표자 : 이해택 <br>
					Copyright 2020. HPEERAGE All rights reserved</p>
			</div>
			<div>
				<p>내용을 넣어주세요</p>
			</div>




			<!--
				<center class="foodText">
					<p>회사명 : peoplecar 사업자등록번호 : 000-00-000000<br>
						주소 : 경기도 수원시 권선구 호매실로104번길 23-37 호매실동 1412-4 이메일 : vtac@hanmail.net 대표자 : 이해택 <br>
						Copyright 2020. HPEERAGE All rights reserved</p>
				</center>
				-->
		</div>
	</footer>

</body></html>
