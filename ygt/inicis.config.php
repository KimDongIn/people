<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(empty($default)) {
/*
    이니시스 실서비스 진행방법
    1. 아래경로에 이니시스 키파일을 받아서 넣어주셔야 실서비스가 가능합니다.
    ./shop/inicis/key
    2. 이니시스관리자에 mid 및 signkey를 찾아서 넣어주세요.
    3. de_card_test를 0으로 변경해주세요.
*/

    $default= [
        'de_card_test'=> 1,// 테스트결제 일때 1, 아닐때 0
        'de_pg_service'=> 'inicis',
        'de_inicis_mid'=> '',// 이니시스 mid
        'de_inicis_sign_key'=> '',// 이니시스 signkey
    ];
}
