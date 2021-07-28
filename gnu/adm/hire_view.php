<?php
$sub_menu = "200120";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

//채용공고 입력정보

$query =" select *,a.career,a.place1,a.place2,a.place3,a.email,a.company_name,
		substring(a.work_s,1,10) as work_s,
		substring(a.work_e,1,10) as work_e,
		(select group_concat(c.specialty)
				   from hire_specialty c,specialty b
				  where c.mb_id = a.mb_id 
				    and c.specialty = b.order_num
					and c.hire_num = a.no
				) as specialty,
		a.price_chk
            FROM hire a
		   WHERE a.no ='${no}'		
		";
$hire = sql_query($query);
$mb = sql_fetch_array($hire);

//거주지
$area = sql_query("select * from area order by area_number asc");
	$placeQuery1 = sql_query("select no,place from place");
	$placeQuery2 = sql_query("select no, area_details, area_number from area_detail where  area_number = '$mb[place1]' ");

//전문분야
$specialtyQuery = sql_query("select no,specialty from specialty order by order_num");
$specialtyArray = explode(",",$mb['specialty']);
$br = 0;

//고용형태
$employKindsQuery = sql_query("select no,employ_kinds from employ_kinds  order by order_num");
$employKindsArray = explode(",",$mb['employ_kinds']);
$br1 = 0;

//자격증
$certificateQuery =sql_query("select * from resume_certificate where mb_id = '$mb[mb_id]'");

$g5['title'] .= '채용공고 관리 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="/script/imgUplodeSG.json"></script>
<script>
	$(function() {

		//date
		$("#datepicker1").datepicker({
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
				url: "https://peoplecar.kr/ajaxPHP.php?city=" + city, // 요기에
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

<style>
	.View_area {
		width: 50%;
	}

	.View_area img {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

</style>
<!--form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data"-->
<form id="hireForm" action="https://peoplecar.kr/recruitment_update.php" name="hireForm" method="post" enctype="multipart/form-data">
	<input type="hidden" name="w" value="<?php echo $w ?>">
	<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
	<input type="hidden" name="stx" value="<?php echo $stx ?>">
	<input type="hidden" name="sst" value="<?php echo $sst ?>">
	<input type="hidden" name="sod" value="<?php echo $sod ?>">
	<input type="hidden" name="page" value="<?php echo $page ?>">
	<input type="hidden" name="token" value="">
	<input type="hidden" name="no" readonly value="<?echo $mb['no']?>" />
	<?/*이력서 번호*/?>
	<div class="tbl_frm01 tbl_wrap">
		<table>
			<caption><?php echo $g5['title']; ?></caption>
			<colgroup>
				<col class="grid_4">
				<col>
				<col class="grid_4">
				<col>
			</colgroup>
			<tbody>
				<tr>
					<th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
					<td>
						<input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_id_class ?>" size="15" maxlength="20">
						<?php if ($w=='u'){ ?><a href="./boardgroupmember_form.php?mb_id=<?php echo $mb['mb_id'] ?>" class="btn_frmline">접근가능그룹보기</a><?php } ?>
					</td>
					<th scope="row"><label for="mb_name">이름(실명)<strong class="sound_only">필수</strong></label></th>
					<td><input type="text" name="name" value="<?php echo $mb['name'] ?>" id="mb_name" required class="required frm_input" size="15" maxlength="20"></td>
				</tr>

				<tr>
					<th scope="row"><label for="career_year">경력</label></th>
					<td>
						<select name="career">
							<? for($i=1;$i<=50;$i++){?>
							<option value="<?=$i?>" <? if($i==$mb['career']){ echo " selected " ; } ?>><?=$i?>년</option>
							<?}?>
						</select>
					</td>
					<th scope="row">거주지</th>
					<td>
						<select name="wr_4" class="y1" id="selectID" required>
							<option value="">광역시/도</option>
							<?
					while ($row = sql_fetch_array($area)){?>
							<option value="<?=$row['area_number']?>" <? if($row['area_number']==$mb['place1']){ echo " selected " ; } ?>><?=$row['area']?></option>
							<?}?>
						</select>

						<select name="wr_6" class="y2" id="selectID2" required>
							<option value="">시/구/군</option>
							<?while($place2 = sql_fetch_array($placeQuery2)){ ?>
							<option value="<?=$place2['no']?>" <? if($place2['no']==$mb['place2']){ echo " selected " ;}?>><?=$place2['area_details']?></option>
							<?}?>
						</select>
						<input type="text" name="place3" id="place3" placeholder="상세주소" value="<?=$mb['place3']?>">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="email">E-mail<strong class="sound_only">필수</strong></label></th>
					<td><input type="text" name="email" value="<?php echo $mb['email'] ?>" id="email" maxlength="100" required class="required frm_input email" size="30"></td>
					<th scope="row"><label for="mb_hp">휴대폰번호</label></th>
					<td>
						<input type="text" name="phone1" value="<?php echo $mb['phone1'] ?>" id="phone1" class="frm_input" size="20" maxlength="20">
						<!--input type="text" name="phone2" value="<?php echo $mb['phone2'] ?>" id="phone2" class="frm_input" size="4" maxlength="4">
			<input type="text" name="phone3" value="<?php echo $mb['phone3'] ?>" id="phone3" class="frm_input" size="4" maxlength="4"-->
					</td>
				</tr>
				<tr>
					<th rowspan="4" scope="row"><label for="mb_img">업체사진</label></th>
					<td rowspan="4">

						<? if(strlen($mb['img']) > 0) {?>
						<div id='View_area' class="View_area">
							<img src="/upload/comp_img/<?=$mb['img']?>" width="85px" height="105px" />
						</div>
						<input type="file" name="profile" id="profile" onchange="previewImage(this,'View_area')">
						<?}else{?>
						<div id='View_area' class="View_area">
						</div>
						<input type="file" name="profile" id="profile" onchange="previewImage(this,'View_area')">
						<?}?>

						<?php
            $mb_dir = substr($mb['mb_id'],0,2);
            $icon_file = G5_DATA_PATH.'/member_image/'.$mb_dir.'/'.get_mb_icon_name($mb['mb_id']).'.gif';
            if (file_exists($icon_file)) {
                $icon_url = str_replace(G5_DATA_PATH, G5_DATA_URL, $icon_file);
                echo '<img src="'.$icon_url.'" alt="">';
                echo '<input type="checkbox" id="del_mb_img" name="del_mb_img" value="1">삭제';
            }
            ?>
					</td>
				</tr>
				<tr>
					<th scope="row">기업명</th>
					<td>
						<input type="text" name="company_name" value="<?=$mb['company_name']?>" id="company_name" class="frm_input" size="70" maxlength="70">
					</td>
				</tr>

				<tr>
					<th scope="row">취업 여부</th>
					<td>
						<input type="radio" name="status" value="1" id="status_yes" <?if($mb['status']==1){ echo " checked" ;}?> >
						<label for="status_yes">예</label>
						<input type="radio" name="status" value="0" id="status_no" <?if($mb['status']==0){ echo " checked" ;}?> >
						<label for="status_no">아니오</label>
					</td>
				</tr>
				<tr>
					<!--th scope="row">이메일 공개 여부</th>
		<td>
			<input type="radio" name="email_use" value="1" id="email_use_yes" <?if($mb['email_use'] == 1){ echo " checked";}?> >
            <label for="email_use_yes">예</label>
            <input type="radio" name="email_use" value="0" id="email_use_no"  <?if($mb['email_use'] == 0){ echo " checked";}?> >
            <label for="email_use_no">아니오</label>
		</td-->
				</tr>

				<tr>
					<th scope="row"><label for="mb_img">채용공고 제목</label></th>
					<td><input type="text" name="subject" value="<?=$mb['subject']?>" id="subject" class="frm_input" size="70" maxlength="70"></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<th scope="row"><label for="mb_img">전문분야</label></th>
					<td>
						<? 
				while($specialty = sql_fetch_array($specialtyQuery)){ 
					$data = $specialty['no'];
					$specialtyChk = in_array($data , $specialtyArray);
					
					if(($br % 4 ) == 0){ echo "</div><div>"; }
					$br++;
			?>
						<input type="checkbox" name="specialty[]" value="<?=$specialty['no']?>" id="specialty<?=$specialty['no']?>" <? if($specialtyChk==true){ echo " checked " ;}?> >
						<label style="margin-right:5px" for="specialty<?=$specialty['specialty']?>"><?=$specialty['specialty']?></label>
						<? 
				}
			?>
					</td>
					<th scope="row"><label for="mb_img">고용형태</label></th>
					<td>
						<?  while($employKinds = sql_fetch_array($employKindsQuery)){
							
							$arrayEmployKinds = explode(",",$mb['employ_kinds']);
							?>
						<div class="col-all-3">
							<input name="employ_kinds[]" class="imgCheckbox" type="checkbox" id="box<?=$employKinds['no']?>" <? if(in_array($employKinds['no'],$arrayEmployKinds)){echo " checked " ;}?>
							value="<?=$employKinds['no']?>">
							<label for="box<?=$employKinds['no']?>"><?=$employKinds['employ_kinds']?></label>
						</div>
						<?}?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="career_year">모집기간</label></th>
					<td>
						<input type="text" id="work_s" name="work_s" placeholder="모집시작" value="<?=$mb['work_s']?>">
						<input type="text" id="work_e" name="work_e" placeholder="마감" value="<?=$mb['work_e']?>">
					</td>

					<th scope="row">희망급여</th>
					<td>
						<input type="checkbox" name="price_chk" onClick=checkDisable(this.form) id="18" value="1" <? if($mb['price_chk']==1){echo " checked " ;}?>>
						<label for="18">면접 시 협의</label>
						<input type="text" name="price" placeholder="" class="frm_input" value="<?=$mb['price']?>">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="mb_profile">상세모집요강</label></th>
					<td><textarea name="detailed" rows="16"><?=$mb['detailed']?></textarea></td>
					<th scope="row"><label for="mb_profile">자격증</label></th>
					<td>
						<?while($certificate = sql_fetch_array($certificateQuery)){?>
						<?=$certificate['certificate']?>[<?=$certificate['certificate_agency']?>]<br />
						<?}?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="mb_profile">근무시간</label></th>
					<td><textarea name="business_time" rows="16"><?=$mb['business_time']?></textarea></td>

					<th scope="row"><label for="mb_profile">회사지원</label></th>
					<td><textarea name="welfare" rows="16"><?=$mb['welfare']?></textarea></td>
				</tr>

			</tbody>
		</table>
	</div>

	<div class="btn_fixed_top">
		<a href="./hire_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
		<input class="btn_submit btn" accesskey='s' type="submit" value="수정">
	</div>
</form>

<script>
	function fmember_submit(f) {
		if (!f.mb_icon.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_icon.value) {
			alert('아이콘은 이미지 파일만 가능합니다.');
			return false;
		}

		if (!f.mb_img.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_img.value) {
			alert('회원이미지는 이미지 파일만 가능합니다.');
			return false;
		}

		return true;
	}

</script>
<?php
run_event('admin_member_form_after', $mb, $w);

include_once('./admin.tail.php');
?>
