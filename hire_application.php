<?
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	$result = sql_query("select * from hire_application where resume_id = '{$resume_id}'");
	$sum1=0;
	$sum2=0;
	while($row = sql_fetch_array($result)){
		if($row['resume_id']==$resume_id && $row['hire_num']==$hire_num){
			$sum1 = 1;
		}
	}
//	print_r($sum1);
//	if($hire_application['resume_id']==$resume_id){
	if($sum1==1){
		//if($hire_application['hire_num']==$mb_id){
			//echo("<script>alert('이력서가 이미 등록 되어있습니다. 마이페이지를 확인하십시오.');</script>");
			print "<script>alert('이력서가 이미 지원 되어있습니다. 마이페이지를 확인하십시오.'); location.replace('/myPageIndi.php'); </script>";
		//}
	} else {
	$cnt = sql_fetch_array(sql_query("select count(*) as cnt from hire where mb_id = '{$mb_id}'"));
	$sql = "insert into hire_application
					set mb_id           = '{$mb_id}',
						resume_num 		= '{$resume_num}',
						hire_num		= '{$hire_num}',
						resume_id		= '{$resume_id}'
						
			";
			//WHERE mb_id 	= '{$mb_id}'
			//echo $sql;
	$querySucess = sql_query($sql);
	$returnText ="success";
	
	echo $returnText;
	}
?>

<script>
  history.back();
  alert('즉시 지원 됬습니다.');
</script>
