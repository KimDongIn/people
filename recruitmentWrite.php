<!DOCTYPE html>
<html lang="kr">

<?
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	
	$placeQuery1 = sql_query("select no,place from place");
	$placeQuery2 = sql_query("select no,place from place");
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
		<?/*
			//formAction s
			$('#formAction').click(function(){
				var form = $('#hireForm')[0];
				var formData = new FormData(form);
				formData.append("company",$("#company_pt")[0].files[0]);

				$.ajax({
					mimeType: 'multipart/form-data',
					processData: false,
		            contentType: false,
		            url  : "recruitmentWrite_update.php", // 요기에
		            type : 'POST', 
		            data : formData,
		            success : function(data) {
						console.log(data);
						if(data == 'already'){
							alert('채용공고가 이미 등록 되어있습니다. 마이페이지를 확인하십시오.');
						}
						else if(data == 'profileNull'){
							alert('프로필 사진을 등록하십시오.');
						}
						else if(data == 'profileSize'){
							alert('프로필 사진이 5MB 넘습니다. 용량을 줄여 등록하십시오.');	
						}
						else if(data == 'profileFail'){
							alert('프로필을 등록 할 수 없습니다.');	
						}
						else if(data == 'success'){
							alert('저장되었습니다.');	
						}
		            }, // success 
		    
		            error : function(xhr, status) {
		                alert(xhr + " : " + status);
		            }
		        }); // $.ajax
				return false;
				
			}); //formAction e
			*/?>

		//formAction s
		$('#formAction').click(function() {
			var form = $('#hireForm')[0];
			var formData = new FormData(form);
			formData.append("profile", $("#profile_pt")[0].files[0]);

			$.ajax({
				mimeType: 'multipart/form-data',
				processData: false,
				contentType: false,
				url: "recruitmentWrite_update.php", // 요기에
				type: 'POST',
				data: formData,
				success: function(data) {
					console.log(data);
					//if (data == 'already') {
					//	alert('채용공고가 이미 등록 되어있습니다. 마이페이지를 확인하십시오.');
					//} else
					if (data == 'profileNull') {
						alert('프로필 사진을 등록하십시오.');
					} else if (data == 'profileSize') {
						alert('프로필 사진이 5MB 넘습니다. 용량을 줄여 등록하십시오.');
					} else if (data == 'profileFail') {
						alert('프로필을 등록 할 수 없습니다.');
					} else if (data == 'success') {
						alert('저장되었습니다.');
						location.href="/myPageComp.php";
					}
				}, // success 

				error: function(xhr, status) {
					alert(xhr + " : " + status);
				}
			}); // $.ajax
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
	/*
	function sample6_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var addr = ''; // 주소 변수
                var extraAddr = ''; // 참고항목 변수

                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    addr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    addr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                if(data.userSelectedType === 'R'){
                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if(data.buildingName !== '' && data.apartment === 'Y'){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if(extraAddr !== ''){
                        extraAddr = ' (' + extraAddr + ')';
                    }
                    // 조합된 참고항목을 해당 필드에 넣는다.
                    //document.getElementById("sample6_extraAddress").value = extraAddr;
                
                } else {
                    document.getElementById("sample6_extraAddress").value = '';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                //document.getElementById('sample6_postcode').value = data.zonecode;
                document.getElementById("sample6_address").value = addr;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("sample6_detailAddress").focus();
            }
        }).open();
    }*/

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
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/recruitmentWrite.php');
		?>


		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/footerComp.php');
		?>

</body></html>
<?/*
//채용공고 입력
$sql = "insert into hire				
				set	mb_id 	    	='{$mb_id}',	//아이디
					name 			='{$name}',		//이름
					email 			='{$email}',	//이메일
					phone1 			='{$phone1}',	//폰1
					phone2 			='{$phone2}',	//폰2
					phone3 			='{$phone3}',	//폰3
					last_access 	= '',		//마지막 액세스
					subject 		='{$subject }',	//채용공고 제목
					career			='{$career}',	//경력
					age				='{$age}',		//나이
					place1			='{$place1}',	//회사 주소1
					place2			='{$place2}',	//회사 주소2
					img 			= '{$actual_image_name}',
					people			='{$people}',	//모집인원
					work_s			='{$work_s}',	//모집기간s
					work_e			='{$work_e}',	//모집기간e
					price1			='{$price1}',	//협의
					price			='{$price}',	//연봉
					bonus			='{$bonus}',	//상여금
					specialty		='{$specialty}',	//모집분야(12가지)
					employ_kinds	='{$employ_kinds}',	//고용형태(7가지)
					detailed		='{$detailed}',	//상세모집요강
					business_time	='{$business_time}',//근무시간
					welfare			='{$welfare}',	//사내복지
					wdate			=now()
					address1				='{$address1}',	회사주소
					address2				='{$address2}', 회사주소
					post					='{$post}',		회사주소
					exam					='{$exam}',		면접일
					company_name			='{$company_name}',	회사명
					company_total_people	='{$company_total_people}', //총 지원자수
					company_gender			='{$company_gender}',	//지원자 성비
					status					='{$status}',			//회사 상태(모집중/모집마감/조기마감)
					company_employee		='{$company_employee}'	//회사 사원수
	";
$querySucess = sql_query($sql);
*/?>
