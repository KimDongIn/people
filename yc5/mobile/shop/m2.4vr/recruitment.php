<!DOCTYPE html>
<html lang="kr">

<?
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	
	
$sql = "select *,a.career,a.place1,a.place2,a.place3,a.img,
		substring(a.work_s,1,10) as work_s,
		substring(a.work_e,1,10) as work_e,
		(select group_concat(c.specialty)
				   from hire_specialty c,specialty b
				  where c.mb_id = a.mb_id 
				    and c.specialty = b.order_num
					and c.hire_num = a.no
				) as specialty,
		a.price_chk
		from hire a, g5_member b
		where a.no = '$_GET[no]'
		and a.mb_id = b.mb_id

		";
$hire = sql_query($sql);
$mb = sql_fetch_array($hire);	

$placeQuery1 = sql_query("select no,place from place");
	$placeQuery2 = sql_query("select no, area_details, area_number from area_detail where  area_number = '$mb[place1]' ");
	$specialtyQuery = sql_query("select no,specialty from specialty order by order_num");
	
	$employKindsQuery = sql_query("select no,employ_kinds from employ_kinds  order by order_num");
	$area = sql_query("select * from area order by area_number asc");
	

?>

<head>
	<meta charset="UTF-8">
	<title>사람과 자동차</title>
	<link rel="shortcut icon" href="./img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/css/basic.css">
	<link rel="stylesheet" type="text/css" href="/css/gridSection.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/widthControl.css">
	<link rel="stylesheet" type="text/css" href="/css/boardWrite.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="/script/imgUplodeSG.json"></script>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
</head>

<script>
	/*회원가입 버튼*/
	function goJoinForm() {
		location.href = "/membership.php";
	}
	$(function() {
		$('#datepicker1').datepicker({
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
	$(function() {

		//date
		$("#work_s").datepicker({
			dateFormat: 'yy-mm-dd',
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
		
		$("#work_e").datepicker({
			dateFormat: 'yy-mm-dd',
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

		$('#certificateAdd').click(function() {

			var data = "<tr><td><input type=\"text\" name=\"certificate[]\" /></td>";
			data += "<td><input type=\"text\" name=\"certificate_agency[]\"  /></td>";
			data += "<td><input type=\"text\"  name=\"certificate_date[]\" placehoder=\"날짜형식 20200101\"  /></td>";
			data += "<td><button name=\"delStaff\">삭제</button></td></tr>";
			$('#certificateTable > tbody').append(data);

		});

		$(document).on("focus", "button[name=delStaff]", function() {
			var trHtml = $(this).parent().parent();
			trHtml.remove(); //tr 테그 삭제

		}); 

	});

	function checkDisable(frm) {
		if (frm.price_chk.checked == true) {
			frm.price.disabled = true;
		} else {
			frm.price.disabled = false;
		}
	}

	function checkDble(frm) {
		if (frm.career_chk.checked == true) {
			frm.career.disabled = true;
		} else {
			frm.career.disabled = false;
		}
	}


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
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/headerComp.php');
		?>
		
		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/recruitment.php');
		?>


		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/footerComp.php');
		?>

</body></html>

