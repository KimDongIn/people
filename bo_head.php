
<?	
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	//echo $member['mb_id'];
?>

<!DOCTYPE html>
<html lang="kr">

<head>
	<meta charset="UTF-8">
	<title>문의게시판</title>
	<link rel="shortcut icon" href="http://peoplecar.kr/img/favicon.ico">
	

	<link rel="stylesheet" type="text/css" href="/css/basic.css">
	<link rel="stylesheet" type="text/css" href="/css/gridSection.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/widthControl.css">
	<link rel="stylesheet" type="text/css" href="/css/widthControl.css">

	<link rel="stylesheet" type="text/css" href="/css/list.css">
</head>

<body>
		<!-- 추가로 헤드에 조권문 붙이기!! level 따라서 Comp / Indi
		
		<? if ($member['mb_level'] == 0){?>
		<!--- 로그인전 시작---------------------------------------------------------------------------------------------------->
		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/header.php');
		?>
		<!--- 로그인전 끝---------------------------------------------------------------------------------------------------->
	<? } else if( $member['mb_level']%2 == 0 && $member['mb_level'] != 0 ){ ?>
		<!--- 기업 로그인 시작------------------------------------------------------------------------------------------------->
		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/headerComp.php');
		?>
		<!--- 기업 로그인 끝------------------------------------------------------------------------------------------------->
		
	<? } else if ($member['mb_level']%2 == 1 && $member['mb_level'] != 0 ){ ?>
		<!--- 개인 로그인 시작---------------------------------------------------------------------------------------------------->
		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/headerIndi.php');
		?>
		<!--- 개인 로그인 끝---------------------------------------------------------------------------------------------------->
	<?}?>
		
		
		
		<?
			//include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/header.php');
		?>
		<?
			//include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/header.php');
		?>
		<?
			//include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/header.php');
		?>
		
		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/inquiryList.php');
			
		?>