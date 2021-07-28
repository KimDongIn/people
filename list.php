<?php
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
   
   

 
    $area = $_POST['area'];
    // POST로 넘어온 값들을 $check에 저장
 
    $array = array($area);
    // check의 값들을 새로운 배열에 저장
 
    foreach ($array as $value){
        $result = implode("|",$value);
        // 배열 값들을 "|" 로 나누어서 한 문자열로 저장
 
        echo "<pre>";
        var_dump($result);
        echo "</pre>";
    }
 


   
   
   
   
   
   
   /*
$link = "/resumeList.php";
//$link = "/indexComp.php";

goto_url($link);*/
?>
