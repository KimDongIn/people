<!DOCTYPE html>
<html>
<head>
<meta charset="EUC-KR">
    <title>Child</title>
 
    <script type="text/javascript">
        function setParentText(){
             opener.document.getElementById("pInput").value = document.getElementById("cInput").value
        }
   </script>
 
</head>
<body>
    <br>
    <b><font size="5" color="gray">자식창</font></b>
    <br><br>
	<?$i = 1;?>
    <input type="text" > <input id="cInput" type="button" value="<?=$i?>" onclick="setParentText()">
    <br><br>
    <input type="button" value="창닫기" onclick="window.close()">
</body>
</html>
