<?
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	$cnt = sql_query("select count(*) as cnt from g5_member where mb_id = '$mb_id'");
	$sql = sql_fetch_array($cnt);
	//print("select count(*) from g5_member where mb_id = '$mb_id'");
	//print($sql['cnt']);
	if($sql['cnt'] > 0) {
		$returnText = "no";
		echo $returnText;
		exit;
	}else /*if($sql['cnt'] == 0)*/ {
		$returnText = "yes";
		echo $returnText;
		exit;
	}
	
?>