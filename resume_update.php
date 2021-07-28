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
	//저장공간
	$profileUploadPath = $_SERVER["DOCUMENT_ROOT"]."/upload/profile/";

	$imgChange;
	
	// 이미지가 있으면
	if($profile && $imgDel != 1 ){
		
		if($profileSize > ( 1024*1024 *5 )){ // 이미지업로드 파일이 5mb 이상이라면 에러처리
			$returnText = "profileSize";
			echo $returnText;
			exit;
		}
//		echo '<script> console.log(1) </script>';
		
		$ext = explode(".",$profile);						// 이미지 이름 / 확장자 배열로
		$actual_image_name = time()."-image.".$ext[1];		// 새로운 이미지 네이밍 (현시간+'-image'+.확장자)
		$tmp = $_FILES['profile']['tmp_name'];
		
		if(!move_uploaded_file($tmp, $profileUploadPath.$actual_image_name)){       
			$returnText ="profileFail";
			echo $returnText;
			exit;
		}
		
		//원본 파일 삭제
		$fileUrl = $profileUploadPath.$oriImg;
		unlink( $fileUrl );
		
		$imgChange = $actual_image_name;
		
	}else{
		
		//원본 파일 삭제
		$fileUrl = $profileUploadPath.$oriImg;
		unlink( $fileUrl );
		
		$imgChange = '';
	}
	
	$sql = "update resume
					set mb_id           = '{$mb_id}',
						name 			= '{$name}',			
						email 			= '{$email}',			
						phone1 			= '{$phone1}',		
						phone2 			= '{$phone2}',		
						phone3 			= '{$phone3}',		
						last_access 	= now(),	
						status 			= '{$status}',		
						subject 		= '{$subject}',				
						place1 			= '{$wr_4}',		
						place2 			= '{$wr_6}',
						place3 			= '{$place3}',
						img 			= '{$imgChange}',
						career_year	 	= '{$career_year}',	
						career_month	= '{$career_month}',	
						price 			= '{$price}',			
						room			= '{$room}',
						work_start_day 	= '{$work_start_day}',	
						employ_kinds 	= '{$employ_kindsArray}',			
						myself_text	 	= '{$myself_text}',	
						hobby_text 		= '{$hobby_text}',	
						other_text 		= '{$other_text}'
						WHERE mb_id = '{$mb_id}'
			";
			//echo $sql;
			
	 sql_query($sql);
	//echo $sql;
	$returnText ="success";

	//해당 아이디로 등록된 자격증 삭제
	sql_query("delete from resume_certificate where mb_id = '{$mb_id}'");
	
	//자격증 재입력
	for($j = 0;$j<count($certificate);$j++){
		
		$certifi1 = $certificate[$j];
		$certifi2 = $certificate_agency[$j];
		$certifi3 = $certificate_date[$j];
		
		$sqlCertificate = sql_query(" insert into resume_certificate 
												   set mb_id 			= '{$mb_id}',
												   certificate			= '${certifi1}',
												   certificate_agency	= '${certifi2}',
												   certificate_date		= '${certifi3}'
									");
	}

	// 전문직 업로드
	// 해당아이디 전문직 삭제
	sql_query("delete from resume_specialty  where mb_id = '{$mb_id}'");
	
	for($j = 0;$j<count($specialty);$j++){
		
		$specialty1 = $specialty[$j];
		
		
		$sqlspecialty = sql_query(" insert into resume_specialty 
												   set mb_id 			= '{$mb_id}',
												       specialty		= '${specialty1}'
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


?>
<script>
	//   history.back();
	//   <?alert('수정 되었습니다.');?>

</script>
