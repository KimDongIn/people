<!--peopleCar 추가 bo_head2.php======================================-->
<!--<link rel="stylesheet" type="text/css" href="/css/main.css">-->
<!--
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/css/gnu2.css">
-->
<!--peopleCar 추가 end======================================-->

<?	
include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
//echo $member['mb_id'];

if ($member['mb_level'] == 0){
		
	include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/header.php');
		
} else if( $member['mb_level']%2 == 0 && $member['mb_level'] != 0 ){ 

	include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/headerComp.php');
	
} else if ($member['mb_level']%2 == 1 && $member['mb_level'] != 0 ){ 
	
	include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/headerIndi.php');
	
}
	
include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/inquiryList.php');
			
?>