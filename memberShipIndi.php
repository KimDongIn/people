
<?	
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	include_once(G5_LIB_PATH.'/register.lib.php');
	$area = sql_query("select * from area order by area_number asc");
?>

<!DOCTYPE html>
<html lang="kr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="imagetoolbar" content="no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>사람과 자동차</title>
	<link rel="shortcut icon" href="./img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/css/basic.css">
	<link rel="stylesheet" type="text/css" href="/css/gridSection.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/widthControl.css">
	<link rel="stylesheet" type="text/css" href="/css/boardWrite.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<script src="/gnu/js/jquery.register_form.js"></script>
	
	<!-- ID 중복 체크 21.05.26 s -->
	<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
	<script>	
	$(function() {
		// 중복 체크 버튼
		$('#id_check').click(function() {
			var getCheck= RegExp(/^[a-zA-Z0-9]{6,12}$/);
			//아이디 공백 확인
			if($("#reg_mb_id").val() == ""){
			alert("아이디 입력바람");
			$("#reg_mb_id").focus();
			return false;
			}
			//아이디 유효성 검사
			if(!getCheck.test($("#reg_mb_id").val())){
			alert("6글자 이상 12글자 이하로 입력해주세요");
			$("#reg_mb_id").val("");
			$("#reg_mb_id").focus();
			return false;
			}
			// 아이디 증복 검사
			var mb_id = $("#reg_mb_id").val();
			//alert(mb_id);
			$.ajax({ // $.ajax s
				mimeType: 'multipart/form-data',
				processData: false,
				contentType: false,
				url: "AjaxSearch.php?mb_id="+mb_id,
				type: 'POST',
				
				success: function(data) {
					if (data == 'no') {
						//console.log(mb_id);
						//console.log(data);
						alert('사용중인 아이디 입니다.');
					} else{
					//if (data == 'yes') {
						//console.log(mb_id);
						//console.log(data);
						alert('사용가능합니다.');
					}
				},
				error: function(xhr, status) {
					alert(xhr + " : " + status);
				}
			}); // $.ajax e
			return false;
		});
	});
	</script>
	<!-- ID 중복 체크 21.05.26 e -->
	
	<!--=================================-->
	<script>
		// 자바스크립트에서 사용하는 전역변수 선언
		var g5_url = "/gnu";
		var g5_bbs_url = "/gnu/bbs";
		var g5_is_member = "";
		var g5_is_admin = "";
		var g5_is_mobile = "";
		var g5_bo_table = "";
		var g5_sca = "";
		var g5_editor = "";
		var g5_cookie_domain = "";
	</script>
	<script src="/gnu/js/jquery-1.12.4.min.js"></script>
	<script src="/gnu/js/jquery-migrate-1.4.1.min.js"></script>
	<script src="/gnu/js/jquery.menu.js?ver=191202"></script>
	<script src="/gnu/js/common.js?ver=191202"></script>
	<script src="/gnu/js/wrest.js?ver=191202"></script>
	<script src="/gnu/js/placeholders.min.js"></script>
	<script src="/gnu/js/owlcarousel/owl.carousel.min.js"></script>
	<script src="/gnu/js/jquery.bxslider.js"></script>

<script>
	// 전체 체크박스 크릭 이벤트
	$(document).ready( function(){
		//최상단 체크박스 클릭
		$("#allServiceOn").click(function(){
			//클릭되었으면
			if($("#allServiceOn").prop("checked")){
				//모두 선택
				$("input[name=serviceOn]").prop("checked",true);
			//클릭이 안되있으면
			}else{
				// 선택 제거 
				$("input[name=serviceOn]").prop("checked",false);
			}
		})
	});
</script>

	<script>
		$(function() {
			$("#reg_zip_find").css("display", "inline-block");

		});

		// submit 최종 폼체크
		function fregisterform_submit(f) {
			// 회원아이디 검사
			if (f.w.value == "") {
				var msg = reg_mb_id_check();
				if (msg) {
					alert(msg);
					f.mb_id.select();
					return false;
				}
			}

			if (f.w.value == "") {
				if (f.mb_password.value.length < 3) {
					alert("비밀번호를 3글자 이상 입력하십시오.");
					f.mb_password.focus();
					return false;
				}
			}

			if (f.mb_password.value != f.mb_password_re.value) {
				alert("비밀번호가 같지 않습니다.");
				f.mb_password_re.focus();
				return false;
			}

			if (f.mb_password.value.length > 0) {
				if (f.mb_password_re.value.length < 3) {
					alert("비밀번호를 3글자 이상 입력하십시오.");
					f.mb_password_re.focus();
					return false;
				}
			}

			// 이름 검사
			if (f.w.value == "") {
				if (f.mb_name.value.length < 1) {
					alert("이름을 입력하십시오.");
					f.mb_name.focus();
					return false;
				}

				/*
				var pattern = /([^가-힣\x20])/i;
				if (pattern.test(f.mb_name.value)) {
				    alert("이름은 한글로 입력하십시오.");
				    f.mb_name.select();
				    return false;
				}
				*/
			}


			// 닉네임 검사
			if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
				var msg = reg_mb_nick_check();
				if (msg) {
					alert(msg);
					f.reg_mb_nick.select();
					return false;
				}
			}

			// E-mail 검사
			if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
				var msg = reg_mb_email_check();
				if (msg) {
					alert(msg);
					f.reg_mb_email.select();
					return false;
				}
			}


			if (typeof f.mb_icon != "undefined") {
				if (f.mb_icon.value) {
					if (!f.mb_icon.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
						alert("회원아이콘이 이미지 파일이 아닙니다.");
						f.mb_icon.focus();
						return false;
					}
				}
			}

			if (typeof f.mb_img != "undefined") {
				if (f.mb_img.value) {
					if (!f.mb_img.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
						alert("회원이미지가 이미지 파일이 아닙니다.");
						f.mb_img.focus();
						return false;
					}
				}
			}

			if (typeof(f.mb_recommend) != "undefined" && f.mb_recommend.value) {
				if (f.mb_id.value == f.mb_recommend.value) {
					alert("본인을 추천할 수 없습니다.");
					f.mb_recommend.focus();
					return false;
				}

				var msg = reg_mb_recommend_check();
				if (msg) {
					alert(msg);
					f.mb_recommend.select();
					return false;
				}
			}

			if (!chk_captcha()) return false;

			document.getElementById("btn_submit").disabled = "disabled";

			return true;
		}

		jQuery(function($) {
			//tooltip
			$(document).on("click", ".tooltip_icon", function(e) {
				$(this).next(".tooltip").fadeIn(400).css("display", "inline-block");
			}).on("mouseout", ".tooltip_icon", function(e) {
				$(this).next(".tooltip").fadeOut();
			});
		});
	</script>
	<script>
$(function() {
	//formAction s
		$('#selectID').change(function() {

		var city = $("#selectID").val();
			$.ajax({
				mimeType: 'multipart/form-data',
				processData: false,
				contentType: false,
				url: "ajaxPHP.php?city="+city, // 요기에
				type: 'POST',
				
				success: function(data) {
					//console.log(data);
					$("#selectID2").empty();
					//$('#selectID2').append('<option value="">시 / 군</option>');
					$("#selectID2").append(data);
					
				}, // success 

				error: function(xhr, status) {
					alert(xhr + " : " + status);
				}
			}); // $.ajax
			return false;
		}); //formAction e
	});

	
</script>

	<script src="/gnu/js/jquery.register_form.js"></script>

	<script>
		var g5_captcha_url = "/gnu/plugin/kcaptcha";
	</script>
	<script src="/gnu/plugin/kcaptcha/kcaptcha.js"></script>
	<!--=================================-->
	<script>
		// 닉넴임 중복 s
		
		$("#idcheck").click(function(){
			alert('1');
			/* var msg = reg_mb_id_check();

			if(msg == "" || msg == null){
				if(!confirm("가입할 수 있는 아이디입니다.\n현재 아이디를 사용하시겠습니까?")){
					document.getElementById("reg_mb_id").value = "";
				}
			}
			else
			{
				alert(msg);
			}
			
			if ($msg = exist_mb_id($mb_id))     alert($msg); */
		});
		
		
		// 닉넴임 중복 e
	</script>
</head>


<body>

		<?
//			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/headerIndi.php');
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/header.php');
		?>


		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/memberShipIndi.php');
		?>


		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/footerIndi.php');
		?>


</body></html>
