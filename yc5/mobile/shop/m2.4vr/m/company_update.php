<?
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	

	$returnText = "";
	//input Type checkBox array text
	function arrayList($val){
		$data = "";
		for($i = 0;$i<5;$i++){
			$data.=$val[$i].",";
		}
		return $data;
	}

$imgs1 = arrayList($imgs);

$uploadBase = '/upload/company/';

$uploadNameArray = array();
foreach ($_FILES['upload']['name'] as $f => $name) {   

    $name = $_FILES['upload']['name'][$f];
    $uploadName = explode('.', $name);

    // $fileSize = $_FILES['upload']['size'][$f];
    $fileType = array("jpg", "png", "gif", "bmp","jpeg");
    $uploadname= time().$f.'.'.$uploadName[1];
	
	array_push($uploadNameArray,$uploadname);
    $uploadFile = $uploadBase.$uploadname;
	
    if(move_uploaded_file($_FILES['upload']['tmp_name'][$f], $uploadFile)){
//		$img = $uploadname;
        echo 'success';
    }else{
        echo 'error';
    }
}  

//print_r($_FILES['upload']); // 확인용

$uploadFileName1 = 	$uploadNameArray[0];
$uploadFileName2 = 	$uploadNameArray[1];
$uploadFileName3 = 	$uploadNameArray[2];
$uploadFileName4 = 	$uploadNameArray[3];

//기업정보 입력 insert into update
//데이타 없음
if( $comp_num == "" ){
	$sql = "insert into company				
		set
		mb_id 	    		='{$mb_id}',		
		company_name		='{$company_name}',
		master_name			='{$master_name}',	
		email 				='{$email}',		
		phone 				='{$phone1}',		
		place1				='{$place1}',		
		place2				='{$place2}',		
		place3				='{$place3}',
		img1 				= '{$uploadFileName1}',
		img2 				= '{$uploadFileName2}',
		img3 				= '{$uploadFileName3}',
		img4 				= '{$uploadFileName4}',
		last_access 		= '',			
		wdate			=now()
	";
	$querySucess = sql_query($sql);

	
}else{ //데이타있음
	$sql = "update company				
		set
		mb_id 	    		='{$mb_id}',		
		company_name		='{$company_name}',
		master_name			='{$master_name}',	
		email 				='{$email}',		
		phone 				='{$phone1}',		
		place1				='{$place1}',		
		place2				='{$place2}',		
		place3				='{$place3}',
		img1 				= '{$uploadFileName1}',
		img2 				= '{$uploadFileName2}',
		img3 				= '{$uploadFileName3}',
		img4 				= '{$uploadFileName4}',
		last_access 		= '',			
		wdate			=now()
		where mb_id = '{$mb_id}'
	";
	$querySucess = sql_query($sql);
}
//회원정보 업로드
$sql2 = "update g5_member				
		set		
		mb_company			='{$company_name}',
		mb_nick				='{$master_name}',	
		mb_email 			='{$email}',		
		mb_hp 				='{$phone1}'
		WHERE 
		mb_id = '{$mb_id}' 
	";
$querySucess2 = sql_query($sql2);



?>
<!--
<script>
	alert("<? echo $mb_id ?>");
</script>
-->
<script>
   history.back();
  <? alert('업데이트 되었습니다.'); ?>
</script>