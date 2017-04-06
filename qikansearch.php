<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<SCRIPT language=javascript src="js/std.js"></SCRIPT>
<LINK rel=stylesheet type=text/css href="css/style.css">
<title>期刊查询</title>
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
<table cellpadding="0" cellspacing="0" width="95%" border="0" align="center">
  <tbody>
    <tr>
      <td><table width="100%" border="0" cellspacing="1" cellpadding="2">
        <form name="frmsearch" method="Post" action="./qikanlist.php" target="framelist">
        <tbody>
          <tr>
            <td width="8%" align="left">查询项</td>
            <td width="15%" align="left"><select name="SearchItem" id="SearchItem" value="title" style="HEIGHT: 20px; WIDTH: 80px">
              <option value="Name">期刊名</option>
              <option value="ISDN">编号</option>
              <option value="Kanhao">刊号</option>
              <option value="Publish">出版社</option>
            </select></td>
            <td width="10%" align="left">查询类型</td>
            <td width="15%" align="left">
            <select name="SearchType" id="SearchType" style="HEIGHT: 20px; WIDTH: 80px">
              <option value="0">完全匹配</option>
              <option value="1" selected>包含</option>
            </select></td>
            <td width="8%" align="left">关键字</td>
            <td width="18%" align="left"><input name="KeyWord" id="KeyWord" maxlength="50" style="WIDTH:100px;HEIGHT:19px"></td>
            <td align="left"><input type="button" border="0" name="search" id="search" value="查询" width="43" height="18" onClick="SearchTelBook()" scrolling="NO"> <input name="reset" type="reset" value="重置条件"></td>
            <input name="flag" id="flag" type="hidden" value="<?Php echo $_GET['flag']?>">
            <input name="CurPage" id="CurPage" type="hidden" value="<?Php echo $_GET['CurPage']?>">
          </tr>
        </tbody>
        </form>
      </table>
        <iframe name="framelist" src="./qikanlist.php" border="0" width="100%" height="700" frameborder="1"></iframe></td>
    </tr>
  </tbody>
</table>
</body></html>