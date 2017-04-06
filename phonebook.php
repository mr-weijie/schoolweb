<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<SCRIPT language=javascript src="js/std.js"></SCRIPT>
<LINK rel=stylesheet type=text/css href="css/style.css">
<title>电话簿</title>
<script language="javascript">
<!--
function SearchTelBook()
{
	document.frmsearch.submit();
}
//-->
</script>

</head>
<body class="InfoSearch" leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" scroll="auto" bgcolor="#C1DEFF">
<table align="center" border="0" width="100%">
<tbody><tr>
	<td width="100%"><img src="images/telBookTop.jpg" height="71" width="100%"></td>
</tr>
<tr>
	<td height="10"></td>
</tr>
<tr><td height="26">
<form name="frmsearch" action="./TelBookSResult.php" method="post" target="TelBookS">
    <table align="center" width="100%"><tbody><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><font id="SearchItem">教师姓名或部门名称</font><input name="KeyWord" id="KeyWord" maxlength="180" style="WIDTH:160px;HEIGHT:20px"></td><td><input type="image" border="0" name="search" id="search" value="查询" src="./images/search.gif" onClick="javascript:SearchTelBook();"></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></form></td></tr>
<tr>
	<td align="center">
		<iframe name="TelBookS" src="./TelBookSResult.php" border="0" width="100%" height="550" frameborder="0">
		</iframe>
	</td>
</tr>
</tbody></table>

</body></html>