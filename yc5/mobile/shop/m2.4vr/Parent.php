<!DOCTYPE html>
<html>
<head>
<meta charset="EUC-KR">
    <title>Parent</title>
    
    <script type="text/javascript">
    
        var openWin;
    
        function openChild()
        {
            // window.name = "부모창 이름"; 
            window.name = "parentForm";
            // window.open("open할 window", "자식창 이름", "팝업창 옵션");
            openWin = window.open("Child.php",
                    "childForm", "width=570, height=350, resizable = no, scrollbars = no");    
        }
   </script>
    
</head>
<body>
	<?echo 1234;?>
	<?echo $i;?>
	<?=$_GET['no']?>
    <br>
    <b><font size="5" color="gray">부모창</font></b>
    <br><br>
    <input type="button" value="자식창 열기" onclick="openChild()"><br>
    전달할 값 : <input type="text" id="pInput">

</body>
</html>
