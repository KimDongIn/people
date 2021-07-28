<?
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/lib/visit.lib.php'); // 방문자스킨을 사용할 경우 선언되어야 함
?>

<footer>
	<div class="footerSell">
		<div class="footerLogo" onclick="location.href='/index.php'">
			<img class="ovm" src="/img/ft_logo.png" alt="하단로고">
			<p> 회사명 : 사람과자동차<br>
				사업자등록번호 : 751-26-01067<br>
				주소 : 경기도 수원시 권선구 호매실로104번길 23-37<br>
				(호매실동, H&#38;차량기술)<br>
			</p>

		</div>

		<div class="PandCInfo">

			<p> 전화 : 031-893-4824<br>
				팩스 : 031-924-4824<br>
				이메일 : pcar114@naver.com<br>
				대표자 : 윤대권 <br>
				Copyright 2020. HPEERAGE All rights reserved<br>
			</p>

		</div>

		<div class="PandCInfo">
			<p> 통신판매업 신고번호 :<br>
				2021-수원권선-0422호<br>
				직업정보제공사업 신고번호 :<br>
				J1511020210001<br>
				<img class="bankLogo" src="/img/ibk_logo1.png" alt="은행로고"><br>
				계자번호 : 331-037276-01-014<br>
				예금주 : 윤대권
			</p>
		</div>

		<div>
			<?php echo visit(); // 접속자집계, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
		</div>
	</div>
</footer>
