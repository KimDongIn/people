<?	
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	//echo $member['mb_id'];
?>
<!DOCTYPE html>
<html lang="kr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>문의게시판</title>
	<link rel="shortcut icon" href="./img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/m/mobilCSS/main.css">
	<link rel="stylesheet" type="text/css" href="/m/mobilCSS/list.css">
	<script>
		function inquryLink(){
			alert("로그인이 필요합니다.");
			location.href = "/m/loginLink.php";
		}
	</script>
</head>

<body>

	<? if ($member['mb_level'] == 0){											//	<!--로그인전 시작-->
	
		include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/header.php');
		include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/inquiryList.php');

	 }else if( $member['mb_level']%2 == 0 && $member['mb_level'] != 0 ){		//	<!--기업 로그인-->
	
		include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/headerComp.php');
		include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/inquiryList.php');

	 } else if ($member['mb_level']%2 == 1 && $member['mb_level'] != 0 ){		//	<!--- 개인 로그인-->
	
		include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/headerIndi.php');
		include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/inquiryList.php');

	}
		include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/footer.php');
	?>

</body>

</html>
