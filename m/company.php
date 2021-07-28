<?	
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	//echo $member['mb_id'];
$mb_id = $member['mb_id'];

$area = sql_query("select * from area order by area_number asc");
//이력서 데이터
$query = "select * 
		FROM company a
		where 1=1
		and a.mb_id = '$mb_id'
";
$mem = sql_query($query);
$mb = sql_fetch_array($mem);
$placeQuery2 = sql_query("select no, area_details, area_number from area_detail where  area_number = '$mb[mb_addr1]' ");

if( $mb == "" ){//값이 X 나의 정보에서 
	$company_name		= $member['mb_company'];
	$master_name		= $member['mb_nick'];
	$email				= $member['mb_email'];
	$phone1				= $member['mb_hp'];
}else{
	$company_name		= $mb['company_name'];
	$master_name		= $mb['master_name'];
	$email				= $mb['email'];
	$phone1				= $mb['phone'];	
}


?>

<!DOCTYPE html>
<html lang="kr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>사람과 자동차</title>
	<link rel="shortcut icon" href="/img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/m/mobilCSS/main.css">
	<link rel="stylesheet" type="text/css" href="/m/mobilCSS/boardWrite.css">
		
	<!--이미지 s-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--이미지 e-->
	<!-- jquery 프로그렘-->
	<script type="text/javascript" src="/script/jquery-3.4.1.min.js"></script>
	<!--이미지 업로드-->
	<script type="text/javascript" src="/script/imgUplode.json"></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="/script/imgUplodeSG.json"></script>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
	
</head>


<script>
//formAction s
		$('#formAction').click(function() {
			var form = $('#companyForm')[0];
			var formData = new FormData(form);
			formData.append("profile", $("#profile_pt")[0].files[0]);
			$.ajax({
				mimeType: 'multipart/form-data',
				processData: false,
				contentType: false,
				url: "/m/company_update.php", // 요기에
				type: 'POST',
				data: formData,
				success: function(data) {
					console.log(data);
					if (data == 'already') {
						alert('채용공고가 이미 등록 되어있습니다. 마이페이지를 확인하십시오.');
					} else if (data == 'success') {
						alert('저장되었습니다.');
					}
				}, // success 

				error: function(xhr, status) {
					alert(xhr + " : " + status);
				}
			}); // $.ajax
			return false;

		}); //formAction e
		


</script>

<body>	
		<?
		include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/headerComp.php');
		?>

		<?
		include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/company.php');
		?>
		
		<?
		include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/footer.php');
		?>
</body>

</html>
<?/*
//기업정보 입력
$sql = "insert into company				
				set	mb_id 	    	='{$mb_id}',	//아이디
					name 			='{$name}',		//이름
					email 			='{$email}',	//이메일
					phone 			='{$phone1}',	//폰
					place1			='{$place1}',	//회사 주소1
					place2			='{$place2}',	//회사 주소2
					img 			= '{$actual_image_name}',
					last_access 	= '',		//마지막 액세스
					wdate			=now()
	";
$querySucess = sql_query($sql);
*/?>
