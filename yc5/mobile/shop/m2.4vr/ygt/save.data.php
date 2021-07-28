<?php
require_once("./common.php");
require_once("./pg.class.php");

$json= [
    'errorCode'=> '40000',
    'errorMsg'=> ''
];

if(empty($is_member)) {
    $json['errorMsg']= '회원만 이용 가능합니다. 로그인 후 진행 해주세요.';
    die(json_encode($json));
}



$oid   = get_session('ss_order_inicis_id');
if(empty($oid)) {
    $json['errorMsg']= '잘못된 경로로 접근하였습니다.';
    die(json_encode($json));
}


if( G5_IS_MOBILE){
    $_POST['post_cart_id'] = $cart_id;
}

$pd_data = base64_encode(serialize($_POST));


$PaymentLog= new PaymentLog();

if(!empty($row= $PaymentLog->get($oid))){
    if($row['is_confirm']) {
        $json['errorCode']= '20000';
            $json['errorMsg']= '이미 결제된 내역이 있습니다.';

        die(json_encode($json));
    }
    $PaymentLog->delete($oid);
}

$default_pg = 'inicis';
$sql = " insert into payment_data
            set pd_id   = '$oid',
                mb_id   = '{$member['mb_id']}',
                pd_pg   = '$default_pg',
                pd_ip   = '{$_SERVER['REMOTE_ADDR']}',
                pd_data = '$pd_data',
                created_at = now() ";
sql_query($sql);

$json['errorCode']= '00000';
//set_session('ss_order_inicis_id', "");
echo json_encode($json);
