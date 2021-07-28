<?
include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');


$areaSQL = "select no, area_details, area_number from area_detail where  area_number = '$city' ";


$resultSQL = sql_query($areaSQL);

$i=0;

while ($row = sql_fetch_array($resultSQL))
{
	$i++;
	//'<option value="">'시/구/군'</option>';
    //$option.='<option value="'.$row['no'].'">'.$row['area_details'].'</option>';
	$option.='<option value="'.$row['no'].'" >'.$row['area_details'].'</option>';
	
	//$option.='<option name="place2" value="'.$row['no'].'"  '.if(.$row['no']. == .$mb['place2'].'){ '.echo " selected "'}'>.$row['area_details'].'</option>';

}

if($i<=0){
	echo "<option value=''>시/구/군 선택해주세요</option>";
}
echo $option;

?>