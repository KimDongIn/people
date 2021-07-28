<HTML>
<HEAD>
<TITLE> New Document </TITLE>
<script language="javascript">
function popup(frm)
{
  var url    ="testpop.asp";
  var title  = "testpop";
  var status = "toolbar=no,directories=no,scrollbars=no,resizable=no,status=no,menubar=no,width=240, height=200, top=0,left=20";
  window.open("", title,status); //window.open(url,title,status); window.open 함수에 url을 앞에와 같이
                                            //인수로  넣어도 동작에는 지장이 없으나 form.action에서 적용하므로 생략
                                            //가능합니다.
  frm.target = title;                    //form.target 이 부분이 빠지면 form값 전송이 되지 않습니다.
  frm.action = url;                    //form.action 이 부분이 빠지면 action값을 찾지 못해서 제대로 된 팝업이 뜨질 않습니다.
  frm.method = "post";
  frm.submit();    
  }
</script>
</HEAD>
<BODY>
<form name="form">
테스트값1&nbsp;<input type=text name="test1" value=""><br>
테스트값2&nbsp;<input type=text name="test2" value=""><br><br>
<input type="button" name="button1" value="전 송" onclick="javascript:popup(this.form);">
</form>
</BODY>
</HTML>