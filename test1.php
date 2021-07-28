<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	if(!$member['resume_num']==null){
		//echo("<script>alert('이력서가 이미 등록 되어있습니다. 마이페이지를 확인하십시오.');</script>");
		print "<script>alert('이력서가 이미 등록 되어있습니다. 마이페이지를 확인하십시오.'); location.replace('/myPageIndi.php'); </script>";
	}
?>

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

	<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
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

		//formAction s
		$('#formAction').click(function() {

			var form = $('#resumeForm')[0];
			var formData = new FormData(form);
			formData.append("profile", $("#profile_pt")[0].files[0]);


			if (formData.get('subject') == "") {
				alert("제목을 입력하십시오.");
				return false;
			}

			// 이름 검사
			if (formData.get('name') == "") {
				alert("이름을 입력하십시오.");
				return false;
			}

			// 이메일 검사
			if (formData.get('email') == "") {
				alert("이메일을 입력하십시오.");
				return false;
			}

			// 전화번호
			if (formData.get('phone1') == "") {
				alert("전화번호를 입력하십시오.");
				return false;
			}

			$.ajax({
				mimeType: 'multipart/form-data',
				processData: false,
				contentType: false,
				url: "resumeWrite_update2.php",
				type: 'POST',
				data: formData,
				success: function(data) {
					//					console.log(data);

					if (data == 'already') {
						alert('이력서가 이미 등록 되어있습니다. 마이페이지를 확인하십시오.');
						location.href = "/myPageIndi.php";
					} else if (data == 'profileNull') {
						alert('프로필 사진을 등록하십시오.');
						//location.href="myPageIndi.php";
					} else if (data == 'profileSize') {
						alert('프로필 사진이 5MB 넘습니다. 용량을 줄여 등록하십시오.');
					} else if (data == 'profileFail') {
						alert('프로필을 등록 할 수 없습니다.');
					} else if (data == 'success') {
						alert('저장되었습니다.');
						location.href = "/myPageIndi.php";
					}
				}, // success 

				error: function(xhr, status) {
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
				url: "ajaxPHP.php?city=" + city, // 요기에
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

	<section>
		<div class="sectionSell">
			<div class="title">
				<h2>이력서 작성</h2>
			</div>
			<div class="boardSell">
				<form name="indMembershep" id="resumeForm" name="resumeForm" method="post" enctype="multipart/form-data">
					<input type="hidden" name="mb_id" readonly value="<?echo $member['mb_id']?>" />
					<?/*회원아이디*/?>
					<!--				<input type="hidden" name="name" readonly value="<?echo $member['mb_name']?>" />-->
					<?/*회원이름*/?>
					<!--				<input type="hidden" name="email" readonly value="<?echo $member['mb_email']?>" />-->
					<?/*회원이메일*/?>
					<!--				<input type="hidden" name="phone1" readonly value="<?echo $member['mb_hp']?>" />-->
					<?/*회원연락처*/?>

					<?/*<input type="hidden" name="phone2" readonly value="<?echo $member['phone2']?>"/>
					<?/*회원연락처*/?>
					<?/*<input type="hidden" name="phone3" readonly value="<?echo $member['phone3']?>"/>
					<?/*회원연락처*/?>


					<div class="boardForm">
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
								<input type="text" name="price" id="" placeholder="희망급여(연봉)" required>
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

						<div class="board01 col-all-12">
							<div class="col-all-12">
								<input type="text" name="name" placeholder="이름" />
							</div>
							<div class="col-all-12">
								<input type="text" name="email" value="<?echo $member['mb_email']?>" placeholder="이메일" />
							</div>
							<div class="col-all-12">
								<input type="text" name="phone1" value="<?echo $member['mb_hp']?>" placeholder="전화번호" />
							</div>


						<div class="chceadBox col-all-12">
							<span> 성별 </span>
							<div class="col-all-4">
								<input class="imgCheckbox" name="sex" type="radio" value="1" id="21">
								<label class="radioBtn" for="21">남</label>
							</div>

							<div class="col-all-4">
								<input class="imgCheckbox" name="sex" type="radio" value="2" id="22">
								<label class="radioBtn" for="22">녀</label>
							</div>
						</div>
							
						<!--생년월일-->
						<div class="col-all-12">
							<input type="date" name="birth"/>
						</div>

						<div class="col-all-12">
							<select name="education" class="" id="">
								<option required>최종학력</option>
								<option value="1">중학교졸업</option>
								<option value="2">중학교중퇴</option>
								<option value="3">고등학교졸업</option>
								<option value="4">고등학교중퇴</option>
								<option value="5">대학교졸업</option>
								<option value="6">대학원졸업</option>
							</select>
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
						<div class="col-all-12" style="display:none">
							<input type="text" name="place3" id="place3" placeholder="상세주소">
						</div>

					</div>

					<div class="boardForm">
						<span> 숙식제공여부 </span>
						<div class="col-all-4">
							<input class="imgCheckbox" name="room" type="radio" id="15">
							<label for="15">희망</label>
						</div>

						<div class="col-all-4">
							<input class="imgCheckbox" name="room" type="radio" id="16">
							<label for="16">비희망</label>
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
							<label for="13">취업준비중</label>
						</div>

						<div class="col-all-4">
							<input class="imgCheckbox" name="status" type="radio" id="14">
							<label for="14">재직중</label>
						</div>
					</div>


					<div class="boardForm">
						<span>고용형태</span>

						<?  while($employKinds = sql_fetch_array($employKindsQuery)){?>
						<div class="col-all-3">
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
										<td><input type="text" name="certificate[]" value="" maxlength="20" placeholder="자격증명" /></td>
										<td><input type="text" name="certificate_agency[]" value="" maxlength="30" placeholder="발급기관명" /></td>
										<td><input type="text" name="certificate_date[]" maxlength="8" placeholder="날짜형식 20200101" value="" /></td>
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
				</form>
			</div>
		</div>
	</section>

</body>

</html>
