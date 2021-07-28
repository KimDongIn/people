<?	
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	$mb_id = $member['mb_id'];
	$no = sql_fetch_array(sql_query("select no from resume where mb_id = '{$mb_id}' "));
	$num = $no['no'];
	$sql = "update g5_member
					set resume_num		='{$num}'
					WHERE mb_id = '{$mb_id}'
			";
	sql_query($sql);
?>


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
	<link rel="stylesheet" type="text/css" href="/css/info.css">
</head>

<body>

	<? if ($member['mb_level'] == 0){?>
	<!--- 로그인전 시작---------------------------------------------------------------------------------------------------->
	<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/header.php');

			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/aboutUs.php');
			
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/footer.php');
		?>
	<!--- 로그인전 끝---------------------------------------------------------------------------------------------------->
	<? } else if( $member['mb_level']%2 == 0 && $member['mb_level'] != 0 ){ ?>
	<!--- 기업 로그인 시작------------------------------------------------------------------------------------------------->
	<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/headerComp.php');

			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/aboutUs.php');
			
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/footerComp.php');
		?>
	<!--- 기업 로그인 끝------------------------------------------------------------------------------------------------->

	<? } else if ($member['mb_level']%2 == 1 && $member['mb_level'] != 0 ){ ?>
	<!--- 개인 로그인 시작---------------------------------------------------------------------------------------------------->
	<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/headerIndi.php');

			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/aboutUs.php');
			
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/footerIndi.php');
		?>
	<!--- 개인 로그인 끝---------------------------------------------------------------------------------------------------->
	<?}?>

</body></html>
