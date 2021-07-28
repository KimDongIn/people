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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>사람과 자동차</title>
	<link rel="shortcut icon" href="/img/favicon.ico">
	
	<link rel="stylesheet" type="text/css" href="/m/mobilCSS/main.css">
	<link rel="stylesheet" type="text/css" href="/m/mobilCSS/info.css">
</head>

<body>

	<? if ($member['mb_level'] == 0){?>
	<!--- 로그인전 시작---------------------------------------------------------------------------------------------------->
	<?
		include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/header.php');

	?>
	<!--- 로그인전 끝---------------------------------------------------------------------------------------------------->
	<? }else if( $member['mb_level']%2 == 0 && $member['mb_level'] != 0 ){ ?>
	<!--- 기업 로그인 시작------------------------------------------------------------------------------------------------->
	<?
		include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/headerComp.php');
	?>
	<!--- 기업 로그인 끝------------------------------------------------------------------------------------------------->

	<? } else if ($member['mb_level']%2 == 1 && $member['mb_level'] != 0 ){ ?>
	<!--- 개인 로그인 시작---------------------------------------------------------------------------------------------------->
	<?
		include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/headerIndi.php');
	?>
	<!--- 개인 로그인 끝---------------------------------------------------------------------------------------------------->
	<?}
		include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/aboutUs.php');
		include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/footer.php');
	?>
	

</body></html>
