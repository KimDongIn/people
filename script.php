

<script type="text/javascript" src="/script/jquery-3.4.1.min.js"></script>
<script>
	// 자바스크립트에서 사용하는 전역변수 선언
	var g5_url = "/gnu";
	var g5_bbs_url = "/gnu/bbs";
	var g5_is_member = "1";
	var g5_is_admin = "";
	var g5_is_mobile = "";
	var g5_bo_table = "";
	var g5_sca = "";
	var g5_editor = "";
	var g5_cookie_domain = "";


	/*회원가입 버튼*/
	function goJoinForm() {
		location.href = "/memberShip.php";
	}


	jQuery(function($) {
		$(".sns-wrap").on("click", "a.social_link",
			function(e) {
				e.preventDefault();

				var pop_url = $(this).attr("href");
				var newWin = window.open(
					pop_url,
					"social_sing_on",
					"location=0,status=0,scrollbars=1,width=600,height=500"
				);

				if (!newWin || newWin.closed || typeof newWin.closed == 'undefined'){
					alert('브라우저에서 팝업이 차단되어 있습니다. 팝업 활성화 후 다시 시도해 주세요.');

				return false;
				};
			}
		);
	} )
</script>