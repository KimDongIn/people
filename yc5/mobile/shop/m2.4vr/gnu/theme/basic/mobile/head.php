<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub2.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>

<?

if( $member['mb_level']%2 == 0 && $member['mb_level'] != 0 ){ 

	include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/headerComp.php');

} else if ($member['mb_level']%2 == 1 && $member['mb_level'] != 0 ){ 

	include_once ($_SERVER["DOCUMENT_ROOT"].'/m/FPG/headerIndi.php');
}
?>