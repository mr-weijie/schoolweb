<?PHP include '../Inc/conn.php';?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>——系统管理</title>
<script language="javascript" src="/css/std.js"></script>
<link rel="stylesheet" href="/css/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0">
<table width="984" height="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tbody><tr><td width="12" class="leftBG"></td><td>
<table width="960" border="0" cellspacing="0" cellpadding="0" align="center" height="100%">
  <tbody><tr>
    <td height="74">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	    <tbody><tr>
	      <td height="74" background="../images/xitong.jpg"></td>
	    </tr>
	  </tbody></table>
	</td>
  </tr>
  <tr>
    <td height="100%">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" height="100%">
        <tbody><tr>
          <td width="155" valign="top" height="100%" background="../images/ManageFunListBackGround.gif">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          	<tbody>
            	<tr><td height="31" background="../images/ManageFunListTop.gif" align="center"><font color="darkred">admin 您好！</font></td></tr>
                    <?php 
		$SqlStr="SELECT RowID,FunctionName,FunctionDir,FunctionFileName from managefunction Where Root='101' order by SortId ";
		$rs = mysql_query($SqlStr);
  		while($row = mysql_fetch_array($rs)) 
		{
			$RowID=$row['RowID'];
			$FunctionName=$row['FunctionName'];
			$FunctionDir=$row['FunctionDir'];
			$FunctionFileName=$row['FunctionFileName'];
        	echo '<tr><td height="24" background="../images/ManageFunListBar.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%"><tbody><tr><td width="30">&nbsp;</td><td><a href="'.$FunctionFileName.'?rowid='.$RowID.'" target="framelist">'.$FunctionName.'</a></td></tr></tbody></table></td></tr>';

		}
		mysql_free_result($rs);
?>
                <tr><td height="56" align="right"><img src="../images/ManageFunListBarBack.gif"> <a href="/adm/default.php">上一级</a>&nbsp;</td></tr><tr><td height="56" background="../images/ManageFunListBottom.gif">&nbsp;</td></tr></tbody></table></td>
          <td valign="top"><iframe name="framelist" src="SchoolSet.php" border="0" width="100%" height="100%" frameborder="0"></iframe></td>
          </tr>
        </tbody></table>
      </td>
  </tr>
</tbody></table>
</td><td width="12" class="rightBG"></td></tr></tbody></table>



</body></html>