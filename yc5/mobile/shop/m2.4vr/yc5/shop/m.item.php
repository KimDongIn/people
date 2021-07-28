<?php
include_once('./_common.php');

//if (G5_IS_MOBILE) {
//    include_once(G5_MSHOP_PATH.'/item.php');
//    return;
//}

$it_id = isset($_GET['it_id']) ? get_search_string(trim($_GET['it_id'])) : '';
$it_seo_title = isset($it_seo_title) ? $it_seo_title : '';

$it = get_shop_item_with_category($it_id, $it_seo_title);

//if (! (isset($it['it_id']) && $it['it_id']))
//    alert('자료가 없습니다.');

$it_id = $_REQUEST['it_id'] = $it['it_id'];

if( isset($row['it_seo_title']) && ! $row['it_seo_title'] ){
    shop_seo_title_update($row['it_id']);
}

//if (!($it['ca_use'] && $it['it_use'])) {
//    if (!$is_admin)
//        alert('현재 판매가능한 상품이 아닙니다.');
//}

//echo "<script>alert('".$_REQUEST['it_id']."');</script>";
//echo "<script>alert('".$it_id."');</script>";
//echo "<script>alert('".$it['it_id']."');</script>";

include_once(G5_LIB_PATH.'/iteminfo.lib.php');

// 분류 테이블에서 분류 상단, 하단 코드를 얻음
$sql = " select ca_skin_dir, ca_include_head, ca_include_tail, ca_cert_use, ca_adult_use from {$g5['g5_shop_category_table']} where ca_id = '{$it['ca_id']}' ";
$ca = sql_fetch($sql);

// 본인인증, 성인인증체크
if(!$is_admin) {
    $msg = shop_member_cert_check($it_id, 'item');
    if($msg)
        alert($msg, G5_SHOP_URL);
}

// 오늘 본 상품 저장 시작
// tv 는 today view 약자
$saved = false;
$tv_idx = (int)get_session("ss_tv_idx");
if ($tv_idx > 0) {
    for ($i=1; $i<=$tv_idx; $i++) {
        if (get_session("ss_tv[$i]") == $it_id) {
            $saved = true;
            break;
        }
    }
}

if (!$saved) {
    $tv_idx++;
    set_session("ss_tv_idx", $tv_idx);
    set_session("ss_tv[$tv_idx]", $it_id);
}
// 오늘 본 상품 저장 끝

// 조회수 증가
if (get_cookie('ck_it_id') != $it_id) {
    sql_query(" update {$g5['g5_shop_item_table']} set it_hit = it_hit + 1 where it_id = '$it_id' "); // 1증가
    set_cookie("ck_it_id", $it_id, 3600); // 1시간동안 저장
}

// 스킨경로
$skin_dir = G5_SHOP_SKIN_PATH;
$ca_dir_check = true;

if($it['it_skin']) {
    if(preg_match('#^theme/(.+)$#', $it['it_skin'], $match))
        $skin_dir = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/shop/'.$match[1];
    else
        $skin_dir = G5_PATH.'/'.G5_SKIN_DIR.'/shop/'.$it['it_skin'];

    if(is_dir($skin_dir)) {
        $form_skin_file = $skin_dir.'/item.form.skin.php';

        if(is_file($form_skin_file))
            $ca_dir_check = false;
    }
}

if($ca_dir_check) {
    if($ca['ca_skin_dir']) {
        if(preg_match('#^theme/(.+)$#', $ca['ca_skin_dir'], $match))
            $skin_dir = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/shop/'.$match[1];
        else
            $skin_dir = G5_PATH.'/'.G5_SKIN_DIR.'/shop/'.$ca['ca_skin_dir'];

        if(is_dir($skin_dir)) {
            $form_skin_file = $skin_dir.'/item.form.skin.php';

            if(!is_file($form_skin_file))
                $skin_dir = G5_SHOP_SKIN_PATH;
        } else {
            $skin_dir = G5_SHOP_SKIN_PATH;
        }
    }
}

define('G5_SHOP_CSS_URL', str_replace(G5_PATH, G5_URL, $skin_dir));

$g5['title'] = $it['it_name'].' &gt; '.$it['ca_name'];

// 아이템 상단3,
echo "<!--아이템 상단1,-->";

// 분류 상단 코드가 있으면 출력하고 없으면 기본 상단 코드 출력
if ($ca['ca_include_head'] && is_include_path_check($ca['ca_include_head']))
    @include_once($ca['ca_include_head']);
else
    include_once(G5_SHOP_PATH.'/_head2.php');

// 아이템 상단5,
echo "<!--아이템 상단2,-->";
?>
<!--상단6-->
<!-- 상품 상세보기 시작 { -->
<?php

// 보안서버경로
if (G5_HTTPS_DOMAIN)
    $action_url = G5_HTTPS_DOMAIN.'/'.G5_SHOP_DIR.'/cartupdate.php';
else
    $action_url = G5_SHOP_URL.'/cartupdate.php';

?>

<?php if($is_orderable) { ?>
<script src="<?php echo G5_JS_URL; ?>/shop.js"></script>
<?php } ?>

<div id="sit">

   
    <?php
    // 상품 구입폼
    include_once($skin_dir.'/item.form.skin3.php');
    ?>


</div>

<?php
// 하단 HTML
echo conv_content($it['it_tail_html'], 1);
?>

<?php
if ($ca['ca_include_tail'] && is_include_path_check($ca['ca_include_tail']))
    @include_once($ca['ca_include_tail']);
else
    include_once(G5_SHOP_PATH.'/_tail.php');