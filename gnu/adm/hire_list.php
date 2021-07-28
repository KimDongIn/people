<?php
$sub_menu = "200120";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from hire";

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

$g5['title'] = '채용관리';
include_once('./admin.head.php');
$no = 0;
$sql = " select 
			subject,no, mb_id,
			company_name,
			address1 as address,
			concat(phone1,'-',phone2,'-',phone3) as phone,
			DATE_FORMAT(work_s, '%Y. %m. %d.') as workStart,
			DATE_FORMAT(work_e, '%Y. %m. %d.') as workEnd,
			0 apply,
			people,
			case when status = 0 then '모집중' else '?' end status
			{$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";

$result = sql_query($sql);

$colspan = 16;
?>
<script>
	console.log('<? echo $sst?>');
</script>
<div class="local_ov01 local_ov">
	<?php /* echo $listall */?>
	<span class="btn_ov01"><span class="ov_txt">총공고수 </span>
		<span class="ov_num"> <?php echo number_format($total_count) ?>개 </span></span>
	<?/*
    <a href="?sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01">
	<span class="ov_txt">차단 </span>
	<span class="ov_num"><?php echo number_format($intercept_count) ?>명</span></a>
	<a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01">
		<span class="ov_txt">탈퇴 </span>
		<span class="ov_num"><?php echo number_format($leave_count) ?>명</span></a>
	*/?>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

	<label for="sfl" class="sound_only">검색대상</label>
	<select name="sfl" id="sfl">
		<option value="mb_id" <?php echo get_selected($_GET['sfl'], "mb_id"); ?>>공고명</option>
	</select>
	<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
	<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
	<input type="submit" class="btn_submit" value="검색">

</form>
<?/*
<div class="local_desc01 local_desc">
    <p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>
</div>
*/?>


<form name="fmemberlist" id="fmemberlist" action="/gnu/adm/hire_list_update.php?no=<?=$no?>" onsubmit="return fmemberlist_submit(this);" method="post">
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
					<th scope="col" id="mb_list_chk" rowspan="1" <?/*width="30px" */?>>
						<label for="chkall" class="sound_only">회원 전체</label>
						<input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
					</th>
					<th scope="col" ><?php echo subject_sort_link('no') ?>공고번호</a></th>
					<th scope="col"><?php echo subject_sort_link('mb_id') ?>채용공고명</th>
					<th scope="col" width="150px"><?php echo subject_sort_link('name') ?>회사명</th>
					<!--th scope="col" width="100px"><?php echo subject_sort_link('name') ?>지역</th--->
					<th scope="col" width="150px">문의전화</th>
					<th scope="col" width="200px">모집기간</th>
					<th scope="col" width="100px">지원/모집인원</th>

					<th scope="col" width="100px">상태</th>
					<th scope="col" width="100px">관리</th>
				</tr>
			</thead>

			<tbody>
				<? 
	//while($row=sql_fetch_array($result)) {
		for ($i=0; $row=sql_fetch_array($result); $i++) {
		$address = explode(" ",$row['address']);
    ?>
				<tr>
					<td headers="mb_list_chk" class="td_chk" rowspan="1">
						
						<input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
						<label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
						<input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
						<!--<input type="checkbox" name="chkall" value="1" id=""/>-->
					</td>
					<td name="no" id="no" value="<?=$row['no']?>"><?=$row['no']?></td>
					<input type="hidden" name="no[<?php echo $i ?>]" value="<?php echo $row['no'] ?>" id="no<?php echo $i ?>">
					<td><?=$row['subject']?></td>
					<td><?=$row['company_name']?></td>
					<!--td><?=$address[0]?> <?=$address[1]?></td-->
					<td><?=$row['phone']?></td>
					<td><?=$row['workStart']?> ~ <?=$row['workEnd']?></td>
					<td><?=$row['apply']?>/<?=$row['people']?></td>
					<td><?=$row['status']?></td>
					<td class="td_mng td_mng_s"><a href="./hire_view.php?no=<?=$row['no']?>" class="btn btn_03">관리</a></td>

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

	</div>
</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
	function fmemberlist_submit(f) {
		if (!is_checked("chk[]")) {
			alert(document.pressed + " 하실 항목을 하나 이상 선택하세요.");
			return false;
		}

		if (document.pressed == "선택삭제") {
			if (!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
				return false;
			}
		}

		return true;
	}

</script>

<?php
include_once ('./admin.tail.php');
?>
