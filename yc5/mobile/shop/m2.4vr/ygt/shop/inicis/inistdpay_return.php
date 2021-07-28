<?php
include_once('./_common.php');
include_once(G5_SHOP_PATH.'/settle_inicis.inc.php');
require_once(G5_SHOP_PATH.'/inicis/libs/HttpClient.php');
require_once(G5_SHOP_PATH.'/inicis/libs/json_lib.php');
require_once(G5_PATH.'/pg.class.php');

@header("Progma:no-cache");
@header("Cache-Control:no-cache,must-revalidate");

$request_mid = isset($_POST['mid']) ? clean_xss_tags($_POST['mid']) : '';

if( ($request_mid != $default['de_inicis_mid']) ){
    alert("요청된 mid 와 설정된 mid 가 틀립니다.");
}

$orderNumber = isset($_POST['orderNumber']) ? preg_replace("/[ #\&\+%@=\/\\\:;,\.'\"\^`~|\!\?\*$#<>()\[\]\{\}]/i", "", strip_tags($_POST['orderNumber'])) : 0;
$session_order_num = get_session('ss_order_inicis_id');

if( !$orderNumber ){
    alert("주문번호가 없습니다.");
}

$PaymentLog= new PaymentLog();
$row = $PaymentLog->get($session_order_num);

if( empty($row) ){
    alert("임시 주문정보가 저장되지 않았습니다.");
}

if( $row['is_confirm']) {
    alert("이미 결제된 내용입니다.");
}

$data = unserialize(base64_decode($row['pd_data']));
if(empty($data['change_level'])) {
    
    alert("저장된 내용이 없습니다.");
}

if (empty($data['payMethod']) || $data['payMethod'] != "신용카드")
{
	$a = $data['od_settle_case'];
// echo "<script>alert('여기";
//	echo $a;
// echo "여기');</script>";
  	
 alert("결제방법을 선택해주세요." );
}
include G5_SHOP_PATH.'/inicis/inistdpay_result.php';

$tno;
$app_no;
$od_receipt_time    = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3 \\4:\\5:\\6", $app_time);
$amount;


sql_query("update {$g5['member_table']} set mb_level= '{$data['change_level']}' where mb_id= '{$row['mb_id']}' and mb_level < '{$data['change_level']}'");

$PaymentLog->fetch($session_order_num, ['is_confirm'=> 1, 'receipt_time'=> $od_receipt_time, 'app_no'=> $app_no, 'tno'=> $tno, amount=> $amount]);

goto_url(G5_URL. "/../myPageComp.php");
