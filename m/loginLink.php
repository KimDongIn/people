<?
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
?>
<!DOCTYPE html>
<html lang="kr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>사람과 자동차</title>
	<link rel="shortcut icon" href="/img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/m/mobilCSS/main.css">
	<link rel="stylesheet" type="text/css" href="/m/mobilCSS/login.css">
</head>

<body>
	<!--- 해더 시작---------------------------------------------------------------------------------------------------->
	<? include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/header.php'); ?>
	<!--- 해더 끝---------------------------------------------------------------------------------------------------->


	<section>
		<div class="sectionSell">
			<div class="loginBox">

				<input type="radio" name="tabmenu" id="tab01" checked>
				<label for="tab01" class="memberBtn">개인</label>
				<input type="radio" name="tabmenu" id="tab02">
				<label for="tab02" class="memberBtn">기업</label>

				<div class="logBox">
					<form name="foutlogin" action="../gnu/bbs/login_check.php" onsubmit="return fhead_submit(this);" method="post" autocomplete="off">

						<div class="signBox">
							<input type="text" id="oi_id1" name="mb_id" required="" placeholder="Enter Your ID">
							<input type="password" name="mb_password" id="oi_pw1" required="" placeholder="Enter Your Password">
						</div>

						<div class="loginButton">
							<button type="submit" id="ol_submit1" value="로그인">로그인</button>
						</div>

					</form>
				</div>

<!--
				<div class="logBox">
					<form name="foutlogin" action="../gnu/bbs/login_check1.php" onsubmit="return fhead_submit(this);" method="post" autocomplete="off">

						<div class="signBox">
							<input type="text" id="oi_id2" name="mb_id" required="" placeholder="Enter Your ID">
							<input type="password" name="mb_password" id="oi_pw2" required="" placeholder="Enter Your Password">
						</div>

						<div class="loginButton">
							<button type="submit" id="ol_submit2" value="로그인">로그인</button>
						</div>

					</form>
				</div>
-->

				<div class="conbox con1">
					<div class="qukLogin">

						<div class="snsLogin">

							<a href="/gnu/bbs/login.php?provider=naver&amp;url=%2Fgnu%2F"><img src="/img/naver.png"></a>
							<a href="/gnu/bbs/login.php?provider=google&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-google"><img src="/img/google.png"></a>
							<a href="/gnu/bbs/login.php?provider=facebook&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-facebook"><img src="/img/face.png"></a>
							<a href="/gnu/bbs/login.php?provider=kakao&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-kakao"><img src="/img/kakao.png"></a>

						</div>

						<div class="membershopButton">
							<a href="/m/memberShipIndi.php" style="font-size: 1rem;">
								<span>아직 회원이 아니세요? <strong>회원가입</strong></span>
							</a>
						</div>

					</div>

				</div>


				<div class="conbox con2">

					<div class="qukLogin">

						<div class="snsLogin">
							<div><a href="/gnu/bbs/login.php?provider=naver&amp;url=%2Fgnu%2F"><img src="/img/naver.png"></a></div>
							<div><a href="/gnu/bbs/login.php?provider=google&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-google"><img src="/img/google.png"></a></div>
							<div><a href="/gnu/bbs/login.php?provider=facebook&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-facebook"><img src="/img/face.png"></a></div>
							<div><a href="/gnu/bbs/login.php?provider=kakao&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-kakao"><img src="/img/kakao.png"></a></div>
						</div>

						<div class="membershopButton">
							<a href="/m/memberShipComp.php" style="font-size: 1rem;">
								<span>아직 회원이 아니세요? <strong>회원가입</strong></span>
							</a>
						</div>

					</div>
				</div>

			</div>
		</div>
	</section>

	<!--- 풋터 시작---------------------------------------------------------------------------------------------------->
	<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/footer.php');
		?>
	<!--- 풋터 끝---------------------------------------------------------------------------------------------------->



</body>

</html>
