<?
include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');

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
		$imgChange ="img			= '{$actual_image_name}',";
	
		
	}
	
	$sql = "update g5_member
					set 
						mb_email 		= '{$mb_email}',			
						mb_hp			= '{$mb_hp}',
						mb_company 		= '{$mb_company}',
										   {$imgChange}
						mb_addr1		= '{$wr_4}',
						mb_addr2		= '{$wr_6}',
						mb_addr3		= '{$place3}'
						WHERE mb_id = '{$mb_id}'
			";

			//echo $sql;
			
	 sql_query($sql);
	//echo $sql;
	$returnText ="success";
	
	//echo $returnText;

?>
<script>
   history.back();
   <?alert('수정 되었습니다.');?>
</script>

