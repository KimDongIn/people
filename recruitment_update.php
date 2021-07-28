<?
include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');


function arrayList($val){
		$data = "";
		for($i = 0;$i<count($val);$i++){
			$data.=$val[$i].",";
		}
		$data = substr($data,0,-1);
		return $data;
	}
	
//arrayData
if(count($specialty) > 0) $specialtyArray = arrayList($specialty);
if(count($employ_kinds) > 0) $employ_kindsArray = arrayList($employ_kinds);	
	


	$profile 	= $_FILES['profile']['name'];
	$profileSize= $_FILES['profile']['size'];
	$profileFormats = array("jpg", "png", "gif", "bmp","jpeg");
	$profileUploadPath = $_SERVER["DOCUMENT_ROOT"]."/upload/comp_img/";

	$imgChange;
	if($profile){
		if($profileSize > ( 1024*1024 *5 )) // 이미지업로드 파일이 5mb 이상이라면 에러처리
		{
			$returnText = "profileSize";
			echo $returnText;
			exit;
		}
		$ext = explode(".",$profile);
		$actual_image_name = time()."-image.".$ext[1];
		$tmp = $_FILES['profile']['tmp_name'];
		
		if(!move_uploaded_file($tmp, $profileUploadPath.$actual_image_name))
		{       
			$returnText ="profileFail";
			echo $returnText;
			exit;
		}
		$imgChange ="img 			= '{$actual_image_name}',";
			
	}
	
	$sql = "update hire
					set mb_id           = '{$mb_id}',
						name 			= '{$name}',			
						email 			= '{$email}',			
						phone1 			= '{$phone1}',		
						phone2 			= '{$phone2}',		
						phone3 			= '{$phone3}',		
						last_access 	= now(),	
						age 			= '{$age}',		
						subject 		= '{$subject}',				
						place1 			= '{$wr_4}',		
						place2 			= '{$wr_6}',
						place3 			= '{$place3}',
						{$imgChange}
						career	 		= '{$career}',	
						people			= '{$people}',
						price 			= '{$price}',	
						price_chk		= '{$price_chk}',
						bonus			= '{$bonus}',
						work_s 			= '{$work_s}',	
						work_e 			= '{$work_e}',	
						employ_kinds 	= '{$employ_kindsArray}',			
						detailed	 	= '{$detailed}',	
						company_name	='{$company_name}',
						business_time	= '{$business_time}',	
						welfare 		= '{$welfare}'
						WHERE mb_id = '{$mb_id}'
						and no = '{$no}'
			";
			//echo $sql;
			
	 sql_query($sql);
	//echo $sql;
	$returnText ="success";
	
	sql_query("delete from hire_specialty  where mb_id = '{$mb_id}' and hire_num = '{$no}'");
	
	for($j = 0;$j<count($specialty);$j++){
		
		$specialty1 = $specialty[$j];
		
		
		$sqlspecialty = sql_query(" insert into hire_specialty 
												   set mb_id 			= '{$mb_id}',
												   specialty			= '${specialty1}',
												   hire_num				= '{$no}'
									");
	}

?>
<script>
   history.back();
	alert(<? echo $imgChange ?>);
   <?alert('수정 되었습니다.');?>
</script>
