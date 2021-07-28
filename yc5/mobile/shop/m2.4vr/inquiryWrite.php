
<?	
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	//echo $member['mb_id'];
?>

<!DOCTYPE html>
<html lang="kr">

<head>
	<meta charset="UTF-8">
	<title>문의게시판</title>
	<link rel="shortcut icon" href="./img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/css/basic.css">
	<link rel="stylesheet" type="text/css" href="/css/gridSection.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/widthControl.css">
	<link rel="stylesheet" type="text/css" href="/css/boardWrite.css">
</head>

<body>

		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/header.php');
		?>
		
		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/inquiryWrite.php');
		?>


		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/footer.php');
		?>

</body></html>