<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	if(!$member['resume_num']==null){
		//echo("<script>alert('이력서가 이미 등록 되어있습니다. 마이페이지를 확인하십시오.');</script>");
		print "<script>alert('이력서가 이미 등록 되어있습니다. 마이페이지를 확인하십시오.'); location.replace('/m/myPageIndi.php'); </script>";
	}?>

<!DOCTYPE html>
<html lang="kr">
<?
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	//지역벌쿼리
$area = sql_query("select * from area order by area_number asc");
	$placeQuery1 = sql_query("select no,place from place");
	$placeQuery2 = sql_query("select no,place from place");
	$specialtyQuery = sql_query("select no,specialty from specialty order by order_num");
	$employKindsQuery = sql_query("select no,employ_kinds from employ_kinds  order by order_num");
?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>이력서작성 - 사람과 자동차</title>
	<link rel="shortcut icon" href="./img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/m/mobilCSS/main.css">
	<link rel="stylesheet" type="text/css" href="/m/mobilCSS/boardWrite.css">

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
	
	//date
	$(".datepicker1").datepicker({
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
	
	$('#certificateAdd').click(function(){
		
		var data = "<tr><td><input type=\"text\" name=\"certificate[]\" /></td>";
			data +="<td><input type=\"text\" name=\"certificate_agency[]\"  /></td>";
			data +="<td><input type=\"text\"  name=\"certificate_date[]\" placehoder=\"날짜형식 20200101\"  /></td>";
			data +="<td><button name=\"delStaff\">삭제</button></td></tr>";
		$('#certificateTable > tbody').append(data);
		
	});
	
	$(document).on("focus","button[name=delStaff]",function(){
        var trHtml = $(this).parent().parent(); 
        trHtml.remove(); //tr 테그 삭제
        
    });
		
		
	//formAction s
	$('#formAction').click(function(){
		var form = $('#resumeForm')[0];
		var formData = new FormData(form);
		formData.append("profile",$("#profile_pt")[0].files[0]);

		$.ajax({
			mimeType: 'multipart/form-data',
			processData: false,
            contentType: false,
            url  : "resumeWrite_update.php", // 요기에
            type : 'POST', 
            data : formData,
            success : function(data) {
				console.log(data);
				if(data == 'already'){
					alert('이력서가 이미 등록 되어있습니다. 마이페이지를 확인하십시오.');
					location.href="/m/myPageIndi.php";
				}
				else if(data == 'profileNull'){
					alert('프로필 사진을 등록하십시오.');
					//location.href="myPageIndi.php";
				}
				else if(data == 'profileSize'){
					alert('프로필 사진이 5MB 넘습니다. 용량을 줄여 등록하십시오.');
				}
				else if(data == 'profileFail'){
					alert('프로필을 등록 할 수 없습니다.');
				}
				else if(data == 'success'){
					alert('저장되었습니다.');
					location.href="/m/index.php";
				}
            }, // success 
    
            error : function(xhr, status) {
                alert(xhr + " : " + status);
            }
        }); // $.ajax */
		return false;
		
	}); //formAction e
	
	
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
			include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/headerIndi.php');
		?>
		
		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/resumeWrite.php');
		?>

		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/footer.php');
		?>

</body></html>
