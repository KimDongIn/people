<?php
//$sub_menu = "200110";
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');

//auth_check($auth[$sub_menu], 'w');

//이력서관리 입력정보
$query =" SELECT subject,mb_id,name,career_year,career_month,place1,place2,
				 email,phone1,phone2,phone3,img,status,infomation_use,email_use,
				 substring(work_start_day,1,10) as work_start_day,price,
				 specialty,employ_kinds,
				 myself_text,hobby_text,other_text
            FROM resume
		   WHERE no ='${no}'		
		";
$resume = sql_query($query);
$mb = sql_fetch_array($resume);

//거주지
$placeQuery1 = sql_query("select no,place from place");
$placeQuery2 = sql_query("select no,place from place");

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

$g5['title'] .= '이력서관리 '.$html_title;
//include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
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
	});
</script>
<form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

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
            <input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_id_class ?>" size="15"  maxlength="20">
            <?php if ($w=='u'){ ?><a href="./boardgroupmember_form.php?mb_id=<?php echo $mb['mb_id'] ?>" class="btn_frmline">접근가능그룹보기</a><?php } ?>
        </td>
         <th scope="row"><label for="mb_name">이름(실명)<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="name" value="<?php echo $mb['name'] ?>" id="mb_name" required class="required frm_input" size="15"  maxlength="20"></td>
    </tr>

    <tr>
        <th scope="row"><label for="career_year">경력</label></th>
        <td>	
			<select name="career_year">
				<? for($i=1;$i<=50;$i++){?>
					<option value="<?=$i?>" <? if($i == $mb['career_year']){ echo " selected "; } ?>><?=$i?>년</option>
				<?}?>
			</select>
			<select name ="career_month">
				<? for($j=1;$j<12;$j++){?>
					<option value="<?=$j?>" <? if($j == $mb['career_month']){ echo " selected "; } ?>><?=$j?>개월</option>
			<?}?>
			</select>
		</td>
        <th scope="row">거주지</th>
        <td>
			<select name="place1">
			<? while($place1 = sql_fetch_array($placeQuery1)){?>
				<option value='<?=$place1['no']?>' <? if($place1['no'] == $mb['place1']){ echo " selected "; } ?>><?=$place1['place']?></option>
			<?}?>
			</select>
			<select name="place2">
			<? while($place2 = sql_fetch_array($placeQuery2)){?>
				<option value='<?=$place2['no']?>' <? if($place2['no'] == $mb['place2']){ echo " selected "; } ?>><?=$place2['place']?></option>
			<?}?>
			</select>
		</td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_email">E-mail<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_email" value="<?php echo $mb['email'] ?>" id="mb_email" maxlength="100" required class="required frm_input email" size="30"></td>
        <th scope="row"><label for="mb_hp">휴대폰번호</label></th>
        <td>
			<input type="text" name="phone1" value="<?php echo $mb['phone1'] ?>" id="phone1" class="frm_input" size="3" maxlength="3">
			<input type="text" name="phone2" value="<?php echo $mb['phone2'] ?>" id="phone2" class="frm_input" size="4" maxlength="4">
			<input type="text" name="phone3" value="<?php echo $mb['phone3'] ?>" id="phone3" class="frm_input" size="4" maxlength="4">
		</td>
    </tr>
     <tr>
        <th rowspan="4"scope="row"><label for="mb_img">증명사진</label></th>
        <td rowspan="4">
			
			<? if(strlen($mb['img']) > 0) {?>
				<img src="/upload/profile/<?=$mb['img']?>" width="85px" height="105px"/>
			<?}else{?>
				등록되지않았습니다.
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
		<th scope="row">정보 공개 여부</th>
		<td>
			<input type="radio" name="information_use" value="1" id="information_use_yes" <?if($mb['information_use'] == 1){ echo " checked";}?> >
            <label for="information_use_yes">예</label>
            <input type="radio" name="information_use" value="0" id="information_use_no"  <?if($mb['information_use'] == 0){ echo " checked";}?> >
            <label for="information_use_no">아니오</label>
		</td>
	</tr>
   
	<tr>
		<th scope="row">취업 여부</th>
		<td>
			<input type="radio" name="status" value="1" id="status_yes" <?if($mb['status'] == 1){ echo " checked";}?> >
            <label for="status_yes">예</label>
            <input type="radio" name="status" value="0" id="status_no" <?if($mb['status'] == 0){ echo " checked";}?> >
            <label for="status_no">아니오</label>
		</td>
	</tr>
	<tr>
		<th scope="row">이메일 공개 여부</th>
		<td>
			<input type="radio" name="email_use" value="1" id="email_use_yes" <?if($mb['email_use'] == 1){ echo " checked";}?> >
            <label for="email_use_yes">예</label>
            <input type="radio" name="email_use" value="0" id="email_use_no"  <?if($mb['email_use'] == 0){ echo " checked";}?> >
            <label for="email_use_no">아니오</label>
		</td>
	</tr>

	<tr>
		<th scope="row"><label for="mb_img">이력서 제목</label></th>
        <td ><input type="text" name="subject" value="<?=$mb['subject']?>" id="subject" class="frm_input" size="70" maxlength="70"></td>
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
				<input type="checkbox" name="specialty[]" value="<?=$specialty['no']?>" id="specialty<?=$specialty['no']?>" <? if($specialtyChk == true){ echo " checked ";}?>  >
				<label style="margin-right:5px" for="specialty<?=$specialty['specialty']?>"><?=$specialty['specialty']?></label>
			<? 
				}
			?>
        </td>
		<th scope="row"><label for="mb_img">고용형태</label></th>
		<td>
			<? 
				while($employKinds = sql_fetch_array($employKindsQuery)){ 
					$data = $employKinds['no'];
					$employKindsChk = in_array($data , $employKindsArray);
					
					if(($br1 % 4 ) == 0){ echo "</div><div>"; }
					$br1++;
			?>
				<input type="checkbox" name="employKinds[]" value="<?=$employKinds['no']?>" id="specialty<?=$employKinds['no']?>" <? if($employKindsChk == true){ echo " checked ";}?>  >
				<label style="margin-right:5px" for="employKinds<?=$employKinds['employ_kinds']?>"><?=$employKinds['employ_kinds']?></label>
			<? 
				}
			?>
		</td>
	</tr>
	<tr>
        <th scope="row"><label for="career_year">출근가능일자</label></th>
        <td><input type="text" name="work_start_day" id="datepicker1" readonly placeholder="" class="frm_input" value="<?=$mb['work_start_day']?>" ></td>
        <th scope="row">희망급여</th>
        <td><input type="text" name="price" placeholder="" class="frm_input" value="<?=$mb['price']?>" ></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_profile">자기 소개</label></th>
        <td ><textarea name="mb_profile" id="mb_profile"><?php echo $mb['myself_text'] ?></textarea></td>
		<th scope="row"><label for="mb_profile">자격증</label></th>
        <td>
			<?while($certificate = sql_fetch_array($certificateQuery)){?>
				<?=$certificate['certificate']?>[<?=$certificate['certificate_agency']?>]<br/>
			<?}?>
		</td>
    </tr>
	 <tr>
        <th scope="row"><label for="mb_profile">특기</label></th>
        <td ><textarea name="mb_profile" id="mb_profile"><?php echo $mb['hobby_text'] ?></textarea></td>
 
        <th scope="row"><label for="mb_profile">기타</label></th>
        <td ><textarea name="mb_profile" id="mb_profile"><?php echo $mb['other_text'] ?></textarea></td>
    </tr>

    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <a href="./member_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="확인" class="btn_submit btn" accesskey='s'>
</div>
</form>

<script>
function fmember_submit(f)
{
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
//run_event('admin_member_form_after', $mb, $w);

//include_once('./admin.tail.php');
?>
