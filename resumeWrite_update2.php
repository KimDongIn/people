<?

	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	

	$cnt = sql_fetch_array(sql_query("select count(*) as cnt from resume where mb_id = '{$mb_id}'"));
	//echo $member['mb_id'];
	/*
	if($cnt > 0 ){
		//$returnText = "already";
		echo $returnText;
		exit;
	}*/

	$returnText = "";
	//input Type checkBox array text
	function arrayList($val){
		$data = "";
		for($i = 0;$i<count($val);$i++){
			$data.=$val[$i].",";
		}
		$data = substr($data,0,-1);
		return $data;
	}
	
	$profile 	= $_FILES['profile']['name'];
	$profileSize= $_FILES['profile']['size'];
	$profileFormats = array("jpg", "png", "gif", "bmp","jpeg");
	$profileUploadPath = $_SERVER["DOCUMENT_ROOT"]."/upload/profile/";
	
	if(!$profile){
		$returnText = "profileNull";
		echo $returnText;
		exit;
	}
	
	if($profileSize > ( 1024*1024 *5 )) // 이미지업로드 파일이 5mb 이상이라면 에러처리
    {
		$returnText = "profileSize";
		echo $returnText;
		exit;
	}
	
	$ext = explode(".",$profile);
	$actual_image_name = date("ymdthis")."-image.".$ext[1];
	$tmp = $_FILES['profile']['tmp_name'];
	
	if(!move_uploaded_file($tmp, $profileUploadPath.$actual_image_name))
	{       
		$returnText ="profileFail";
		echo $returnText;
		exit;
	}
	$imgChange ="img 			= '{$actual_image_name}',";
	
	//arrayData
	if(count($specialty) > 0) $specialtyArray = arrayList($specialty);
	if(count($specialty) > 0) $employ_kindsArray = arrayList($employ_kinds);
	
	
	//이력서관리 입력
	$sql = "insert into resume
					set mb_id           = '{$mb_id}',
						name 			= '{$name}',			
						email 			= '{$email}',			
						phone1 			= '{$phone1}',		
						phone2 			= '{$phone2}',		
						phone3 			= '{$phone3}',		
						last_access 	= '',	
						status 			= '{$status}',		
						subject 		= '{$subject}',				
						place1			='{$wr_4}',
						place2			='{$wr_6}',
						place3			='{$place3}',
						room			= '{$room}',
										   {$imgChange}		
						career_year	 	= '{$career_year}',	
						career_month	= '{$career_month}',	
						price 			= '{$price}',			
						work_start_day 	= '{$work_start_day}',	
						employ_kinds 	= '{$employ_kindsArray}',			
						myself_text	 	= '{$myself_text}',	
						hobby_text 		= '{$hobby_text}',	
						other_text 		= '{$other_text}',
						wdate 			= now()
			";
	$querySucess = sql_query($sql);
	
	$returnText ="success";
	
	$no = sql_fetch_array(sql_query("select no from resume"));
	$num = $no['no'];
	$sql = "insert into member
					set resume_num		='{$num}'
			";
	$query = sql_query($sql);
			
	//해당 아이디로 등록된 자격증 삭제
	sql_query("delete from resume_certificate where mb_id = '{$mb_id}'");
	
	//자격증 재입력
	for($j = 0;$j<count($certificate);$j++){
		
		$certifi1 = $certificate[$j];
		$certifi2 = $certificate_agency[$j];
		$certifi3 = $certificate_date[$j];
		
		$sqlCertificate = sql_query("
		insert into resume_certificate 
		   set mb_id 			= '{$mb_id}',
		   certificate			= '${certifi1}',
		   certificate_agency	= '${certifi2}',
		   certificate_date		= '${certifi3}'
		");
	}
	
	sql_query("delete from resume_specialty  where mb_id = '{$mb_id}'");
	
	for($j = 0;$j<count($specialty);$j++){
		
		$specialty1 = $specialty[$j];
		
		
		$sqlspecialty = sql_query(" insert into resume_specialty 
												   set mb_id 			= '{$mb_id}',
												   specialty			= '${specialty1}'
									");
	}

	// 이력서 추가사항 업로드
	$memberResume ="
		UPDATE g5_member
		SET mb_sex		= 	'{$sex}',
		mb_birth 		= 	'{$birth}',
		mb_3 			=	'{$education}'
		WHERE mb_id 	= 	'{$mb_id}';
	";
	
	$qurup = sql_query( $memberResume );
	
	
	


	$returnText ="success";	
	echo $returnText;
	exit;
	$link="/index.php";
	goto_url($link);
?>