<?php
$sub_menu = "200110";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from resume";

$sql_search = " where 1=1 ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}
/*
if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";
*/
if (!$sst) {
    $sst = "wdate";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함


$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '이력서관리';
include_once('./admin.head.php');

$sql = " select subject,
				no,
				mb_id,
				name,
				email,
				case when career_year = 0 and career_month =0 then '신입' else concat(career_year,'년 ',career_month,'개월') end  career,
				concat(phone1,'-',phone2,'-',phone3) as phone,
				case when status =0 then '미취업' else '취업' end status
		{$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";

$result = sql_query($sql);

$colspan = 16;
?>

<div class="local_ov01 local_ov">
    <?php /* echo $listall */?>
    <span class="btn_ov01"><span class="ov_txt">총이력수 </span>
    <span class="ov_num"> <?php echo number_format($total_count) ?>명 </span></span>
    <?/*
    <a href="?sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01"> 
        <span class="ov_txt">차단 </span>
        <span class="ov_num"><?php echo number_format($intercept_count) ?>명</span></a>
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01"> 
        <span class="ov_txt">탈퇴  </span>
        <span class="ov_num"><?php echo number_format($leave_count) ?>명</span></a>
    */?>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
    <option value="name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>

</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">


<input type="button" name="" id="btn02" onClick="location.href='http://peoplecar.kr/cs_resumeWrite.php'">
	<label for="btn02">
		<img id="cvButtom" src="/img/CV.png">
	</label>

</form>
<?/*
<div class="local_desc01 local_desc">
    <p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>
</div>
*/?>


<form name="fmemberlist" id="fmemberlist" action="./resume_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" id="mb_list_chk"  width="30px" >
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
		<th scope="col" >이력서제목</a></th>
        <th scope="col" ><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
		<th scope="col" ><?php echo subject_sort_link('name') ?>이름</a></th>
		<th scope="col" width="100px">경력여부</th>
        <th scope="col" width="200px"><?php echo subject_sort_link('email', '', 'desc') ?>이메일</a></th>
        <th scope="col" width="120px">휴대폰</th>
        <th scope="col" width="120px"><?php echo subject_sort_link('last_access', '', 'desc') ?>최근수정일자</a></th>
        <th scope="col" width="100px" id="mb_list_grp">상태</th>
        <th scope="col" width="100px" rowspan="2" id="mb_list_mng">관리</th>
    </tr>
    </thead>

    <tbody>
    <? 
	//while($row=sql_fetch_array($result)) {
	for ($i=0; $row=sql_fetch_array($result); $i++) {
    ?>
	<tr>
		<td headers="mb_list_chk" class="td_chk" rowspan="1">
			<input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
        <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
        <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
		</td>
		<!--td><input type="checkbox" name="chkall" value="1" id=""/></td-->
		<td><?=$row['subject']?></td>
		<td name="mb_id[<?php echo $i ?>]" id="mb_id[<?php echo $i ?>]"><?=$row['mb_id']?></td>
		<td><?=$row['name']?></td>
		<td><?=$row['career']?></td>
		<td><?=$row['email']?></td>
		<td><?=$row['phone']?></td>
		<td><?=$row['last_access']?></td>
		<td><?=$row['status']?></td>
		<td class="td_mng td_mng_s"><a href="./resume_view.php?no=<?=$row['no']?>" class="btn btn_03">관리</a></td>

	</tr>
	<?}?>
    
    </tbody>
</table>

<div class="btn_fixed_top">
    <!--<input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_02">-->
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
    <?php if ($is_admin == 'super') { ?>
    <a href="./member_form.php" id="member_add" class="btn btn_01">회원추가</a>
    <?php } ?>

</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
function fmemberlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }else{
			
		}
    }

    return true;
}
</script>

<?php
include_once ('./admin.tail.php');
?>


<?
/*

CREATE TABLE resume (
 no int(10) not null auto_increment primary key,
 mb_id varchar(20),
 name varchar(20),
 email varchar(30),
 infomation_use char(1) default '0',
 email_use char(1) default '0',
 phone1 varchar(3),
 phone2 varchar(4),
 phone3 varchar(4),
 last_access datetime,
 status char(1) default '0',
 subject varchar(100),
 place1 varchar(50),
 place2 varchar(50),
 img varchar(100),
 career_year int(10),
 career_month int(10),
 price varchar(100),
 work_start_day datetime,
 specialty varchar(100),
 employ_Kinds text,
 mysqlf_text text,
 hobby_text text,
 other_text text,
 resume_use char(1) default '0'
 
)

*/
?>