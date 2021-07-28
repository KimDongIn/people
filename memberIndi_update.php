<?
include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');

	
	$sql = "update g5_member
					set 
						mb_email 		= '{$mb_email}',			
						mb_hp			= '{$mb_hp}',
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
