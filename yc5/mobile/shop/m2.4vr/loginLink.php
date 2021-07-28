<!DOCTYPE html>
<html lang="kr">

<head>
	<meta charset="UTF-8">
	<title>사람과 자동차</title>
	<link rel="shortcut icon" href="/img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/css/basic.css">
	<link rel="stylesheet" type="text/css" href="/css/gridSection.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/widthControl.css">
	<link rel="stylesheet" type="text/css" href="/css/login.css">
</head>

<body>

		<section>
			<div class="sectionSell">
				<div class="loginSell">

					<input type="radio" name="tabmenu" id="tab01" checked>
					<label for="tab01" class="memberBtn">개인</label>

					<input type="radio" name="tabmenu" id="tab02">
					<label for="tab02" class="memberBtn">기업</label>


					<div class="conbox con1">
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

									<a href="/gnu/plugin/social/popup.php?provider=naver&amp;url=%2Fgnu%2F"><img src="/img/naver.png"></a>
									<a href="/gnu/plugin/social/popup.php?provider=google&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-google"><img src="/img/google.png"></a>
									<a href="/gnu/plugin/social/popup.php?provider=facebook&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-facebook"><img src="/img/face.png"></a>
									<a href="/gnu/plugin/social/popup.php?provider=kakao&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-kakao"><img src="/img/kakao.png"></a>

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
									<div><a href="/gnu/plugin/social/popup.php?provider=naver&amp;url=%2Fgnu%2F"><img src="/img/naver.png"></a></div>
									<div><a href="/gnu/plugin/social/popup.php?provider=google&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-google"><img src="/img/google.png"></a></div>
									<div><a href="/gnu/plugin/social/popup.php?provider=facebook&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-facebook"><img src="/img/face.png"></a></div>
									<div><a href="/gnu/plugin/social/popup.php?provider=kakao&amp;url=%2Fgnu%2F" class="sns-icon social_link sns-kakao"><img src="/img/kakao.png"></a></div>
								</div>

								<div class="membershopButton">
									<a href="/memberShipComp.php" style="font-size: 10px;">
										<span>아직 회원이 아니세요? <strong>회원가입</strong></span>
									</a>
								</div>
							</form>
						</div>
					</div>

				</div>
			</div>
		</section>



</body></html>
