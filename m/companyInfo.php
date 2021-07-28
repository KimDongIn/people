<?	
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	//alert($member['mb_id']);
	$comp_id = $_GET['mb_id'];

//	echo $mb_id;
	$area = sql_query("select * from area order by area_number asc");
	$areaArray = sql_fetch_array($area);
//	$sql = "select *, a.mb_id,a.img1,a.img2,a.img3,a.img4,b.mb_id, c.company_num
//				FROM company a , g5_member b, hrie
//				WHERE a.mb_id = '$mb_id'
//				AND a.no = c.company_num
//			 ";
	//컴퍼니 데이터 , 회사 데이터
	$sql ="select *
			FROM company a , g5_member b
			WHERE b.mb_id = '{$comp_id}'
			AND a.no = b.company_num";
//AND a.mb_id = b.mb_id
$hi1 = sql_query($sql);
$company = sql_fetch_array($hi1);

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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="/script/slidBanner.json"></script>

</head>

<body>
		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/headerIndi.php');
		?>


		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/companyInfo.php');
		?>

	
		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/footer.php');
		?>
	
</body>

</html>
