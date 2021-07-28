
<?	
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	//echo $member['mb_id'];
	//(select place from place where no = a.place1) as place1,
	// case when status =0 then '미취업' else '취업' end 
	
	$query =" SELECT a.no,a.subject,a.mb_id,a.name,a.career_year,a.career_month,
                 a.place1,
                 a.place2,a.place3,a.room,
				 a.status,
				 concat(phone1,'-',phone2,'-',phone3) as phone,
				 a.email,a.img,a.infomation_use,a.email_use,
				 substring(a.work_start_day,1,10) as work_start_day,a.price,
				 (select group_concat(c.specialty)
				   from resume_specialty c,specialty b
				  where c.mb_id = a.mb_id 
				    and c.specialty = b.order_num
				) as specialty,
				 a.employ_kinds,
				 a.myself_text,a.hobby_text,a.other_text
            FROM resume a , g5_member b
		   WHERE a.no ='$_GET[no]'	
             AND a.mb_id = b.mb_id 
             
     ";
	 //echo $query;
$resume = sql_query($query);
$mb = sql_fetch_array($resume);


$area = sql_query("select * from area order by area_number asc");
	$placeQuery1 = sql_query("select no,place from place");
	$placeQuery2 = sql_query("select no, area_details, area_number from area_detail where  area_number = '$mb[place1]' ");
	

//echo $mb['mb_id'];
	//$placeQuery1 = sql_query("select no,place from place");
	//$placeQuery2 = sql_query("select no,place from place");
	$specialtyQuery = sql_query("select no,specialty from specialty order by order_num");
	$employKindsQuery = sql_query("select no,employ_kinds from employ_kinds  order by order_num");
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

	<link rel="stylesheet" type="text/css" href="/css/boardWrite.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="/script/imgUplodeSG.json"></script>
	
	<!--날짜 달력 선택-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
	<script> alert(<? echo $_GET[no] ?>);</script>

</head>

<script>
	$(function() {
		$("#datepicker1").datepicker({
			dateFormat: 'yy.mm.dd',
			prevText: '이전 달',
			nextText: '다음 달',
			monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
			monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
			dayNames: ['일', '월', '화', '수', '목', '금', '토'],
			dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
			dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
			showMonthAfterYear: true,
			changeMonth: true,
			changeYear: true,
			yearSuffix: '년'
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


<body>

		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/headerIndi.php');
		?>

		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/resume.php');
		?>
		
		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/footerIndi.php');
		?>
		
</body></html>
