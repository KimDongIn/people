<?
	extract($_POST);
extract($_GET);
$con = mysqli_connect("localhost","carhnt","carhnt2017!","carhnt_godohosting_com");//HOST, ID , PW, DB_name
 mysqli_query($con,"set names utf8");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
	echo '$mbname';
	$con();
	while($row)
		
	while($row = mysql_fetch_array($result)){
        echo "번호: ".$row[name]."/ 이름: ".$row[jumin1]."<br/>";
    }
	
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
</body>
<footer>
			<div class="footerSell">
				<center class="foodText">
					<p>회사명 : peoplecar 사업자등록번호 : 000-00-000000<br>
						주소 : 경기도 수원시 권선구 호매실로104번길 23-37 호매실동 1412-4 이메일 : vtac@hanmail.net 대표자 : 이해택 <br>
						Copyright 2020. HPEERAGE All rights reserved</p>
				</center>
			</div>
		</footer>
</html>
