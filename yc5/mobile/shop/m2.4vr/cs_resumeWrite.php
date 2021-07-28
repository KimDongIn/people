
<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	if(!$member['resume_num']==null){
		//echo("<script>alert('이력서가 이미 등록 되어있습니다. 마이페이지를 확인하십시오.');</script>");
		print "<script>alert('이력서가 이미 등록 되어있습니다. 마이페이지를 확인하십시오.'); location.replace('/myPageIndi.php'); </script>";
		
	}
	
/*	
	if( isset( $member['mb_name'] ) ) {
	$jb_login = TRUE;
	}
*/?>

<!DOCTYPE html>
<html lang="kr">

<?
	
	//지역벌쿼리
$area = sql_query("select * from area order by area_number asc");
	$placeQuery1 = sql_query("select no,place from place");
	$placeQuery2 = sql_query("select no,place from place");
	$specialtyQuery = sql_query("select no,specialty from specialty order by order_num");
	$employKindsQuery = sql_query("select no,employ_kinds from employ_kinds  order by order_num");
?>
<head>
	<meta charset="UTF-8">
	<title>이력서작성 - 사람과 자동차</title>
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
            url  : "cs_resumeWrite_update.php", // 요기에
            type : 'POST', 
            data : formData,
            success : function(data) {
				console.log(data);
				if(data == 'already'){
					alert('이력서가 이미 등록 되어있습니다. 마이페이지를 확인하십시오.');
					location.href="/myPageIndi.php";
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
					location.href="/myPageIndi.php";
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
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/headerIndi.php');
		?>
		
		<section>
	<div class="sectionSell">
		<div class="title">
			<h2>이력서 작성</h2>
		</div>
		<div class="boardSell">			
			<form name="indMembershep" id="resumeForm" name="resumeForm" method="post" enctype="multipart/form-data">
				<!--input type="hidden" name="mb_id" readonly value="<?echo $member['mb_id']?>" />
				<?/*회원아이디*/?>
				<input type="hidden" name="name" readonly value="<?echo $member['mb_name']?>" />
				<?/*회원이름*/?>
				<input type="hidden" name="email" readonly value="<?echo $member['mb_email']?>" />
				<?/*회원이메일*/?>
				<input type="hidden" name="phone1" readonly value="<?echo $member['mb_hp']?>" /-->
				<?/*회원연락처*/?>

				<?/*<input type="hidden" name="phone2" readonly value="<?echo $member['phone2']?>"/>
				<?/*회원연락처*/?>
				<?/*<input type="hidden" name="phone3" readonly value="<?echo $member['phone3']?>"/>
				<?/*회원연락처*/?>

				
				<div class="boardForm">
					<span> 기본정보 </span>
						<div class="col-all-12">
							<input type="text" name="mb_id" placeholder="아이디">
						</div>
						<div class="col-all-12">
							<input type="text" name="name" placeholder="이름">
						</div>
						<div class="col-all-12">
							<input type="text" name="email" placeholder="이메일">
						</div>
						<div class="col-all-12">
							<input type="text" name="phone1"placeholder="핸드폰">
						</div>
					<span> 인적사항 </span>
					<div class="board01 col-all-8">
						
						<div class="col-all-12">
							<input type="text" name="subject" id="subject" placeholder="제목">
						</div>

						<div class="col-all-6">
							<!--
							<input type="text" name="" id="" placeholder="경력">
							-->
							<select name="career_year" id="career_year">
								<option value="0">경력(년)</option>
								<?for($i =1;$i<=50;$i++){?>
								<option value="<?=$i?>"><?=$i?></option>
								<?}?>
							</select>
						</div>
						<div class="col-all-6">
							<select name="career_month" id="career_month">
								<option value="0">경력(월)</option>
								<?for($i =1;$i<=12;$i++){?>
								<option value="<?=$i?>"><?=$i?></option>
								<?}?>
							</select>
						</div>

						<div class="col-all-4">
							<input type="text" name="price" id="" placeholder="희망급여(연봉)">
						</div>
						
						<div class="unitName col-all-2">
							<span> 만원 </span>
						</div>

						<div class="col-all-6">
							<input type="text" name="work_start_day" class="datepicker1" readonly placeholder="출근 가능 일자">
						</div>


					</div>

					<div class="imgeBox col-all-4">
						<div id='View_area'></div>
						<div>
							<input type="file" name="profile_pt" id="profile_pt" onchange="previewImage(this,'View_area')">
						</div>
					</div>
					
					<!-- 이동 해야함!!
					<div class="boardForm">
						<div class="addres col-all-12">
						<input type="button" id="add_num" onclick="sample6_execDaumPostcode()" value="주소 찾기">
						<input type="text" name="address1" id="sample6_address" placeholder="주소">
						<input type="text" name="address2" id="sample6_detailAddress" placeholder="상세주소">
					</div>-->
					
					<div class="boardForm">
					<span> 희망근무지역 </span>
					</div>
						
						<div class="col-all-6">
							<select name="wr_4" class="y1" id="selectID">
								<option value="" required>광역시/도</option>
								<?
									while ($row = sql_fetch_array($area))
									{?>
										<option name="place1" value="<?=$row['area_number']?>"><?=$row['area']?></option>
									<?/*echo '<option name="place1" value="'.$row['area_number'].'">'.$row['area'].'</option>';
									'<input type="hidden" name="place1" readonly value="'.$row['area_number'].'"/>';*/?>
									<?}
									?>
							</select>
						</div>

						<div class="col-all-6">
							<select name="wr_6" class="y2" id="selectID2" required>
								<option value="" required>시/구/군</option>
							</select>
						</div>
						<div class="col-all-12">
							<input type="text" name="place3" id="place3" placeholder="상세주소">
						</div>

					</div>
					
					<div class="boardForm">
					<span> 숙식제공여부 </span>
						<div class="col-all-4">
							<input class="imgCheckbox" name="room" type="radio" id="15">
							<label for="15">제공</label>
						</div>

						<div class="col-all-4">
							<input class="imgCheckbox" name="room" type="radio" id="16">
							<label for="16">비제공</label>
						</div>
					</div>

					<div class="boardForm">
					<span>전문분야</span>
						
						<?  $i = 1;
							while($specialty = sql_fetch_array($specialtyQuery)){ ?>
							<div class="col-all-4">
								<input name="specialty[]" class="imgCheckbox" type="checkbox" id="specialty<?=$specialty['no']?>" value="<?=$specialty['no']?>">
								<label for="specialty<?=$specialty['no']?>"><?=$specialty['specialty']?></label>
							</div>
						<?}?>
						
					</div>


					<div class="boardForm">
					<span> 취업상황 </span>
						<div class="col-all-4">
							<input class="imgCheckbox" name="status" type="radio" id="13">
							<label for="13">취업</label>
						</div>

						<div class="col-all-4">
							<input class="imgCheckbox" name="status" type="radio" id="14">
							<label for="14">미취업</label>
						</div>
					</div>
					

					<div class="boardForm">
					<span>고용형태</span>

						<?  while($employKinds = sql_fetch_array($employKindsQuery)){?>
							<div  class="col-all-3">
								<input name="employ_kinds[]" class="imgCheckbox" type="radio" id="box<?=$employKinds['no']?>" value="<?=$employKinds['no']?>">
								<label for="box<?=$employKinds['no']?>"><?=$employKinds['employ_kinds']?></label>
							</div>
						<?}?>
						

					</div>

					<div class="boardForm">
					<span>보유자격증</span>

						<div class="col-all-12">
							<!--
							<textarea name="" rows="16" placeholder="보유자격증"></textarea>
							-->
							<table id="certificateTable">
								<thead>
								<tr>
									<th>자격증명</th>
									<th>기관명</th>
									<th>자격일</th>
									<th>
										<input type="button" id="certificateAdd" value="+">
									</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td><input type="text" name="certificate[]" value="" maxlength="20" placeholder="자격증명"/></td>
									<td><input type="text" name="certificate_agency[]" value=""  maxlength="30" placeholder="발급기관명"/></td>
									<td><input type="text" name="certificate_date[]" maxlength="8" placeholder="날짜형식 20200101" value=""/></td>
									<td></td>
								</tr>
								</tbody>
							</table>	
						</div>

						<span>자기소개서</span>
						<div class="col-all-12">
							<textarea name="myself_text" rows="16" placeholder="자기소개서"></textarea>
						</div>

						<span>특기</span>
						<div class="col-all-12">
							<textarea name="hobby_text" rows="16" placeholder="특기"></textarea>
						</div>

						<span>기타사항</span>
						<div class="col-all-12">
							<textarea name="other_text" rows="16" placeholder="기타사항"></textarea>
						</div>
					</div>

				
					<button class="submitBtn" id="formAction" onClick="formAction"> 등록 </button>
			

				</div>
			</form>
		</div>
	</div>
</section>


		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/footerIndi.php');
		?>

</body></html>
