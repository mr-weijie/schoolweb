<?PHP include 'Inc/conn.php';?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>——系统管理</title>
<link rel="stylesheet" href="/css/style.css" type="text/css">
<script language="javascript" src="./css/std.js.下载"></script>
<link rel="stylesheet" href="/css/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0">
<table width="984" height="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tbody><tr><td width="12" class="leftBG"></td><td>
<table width="960" border="0" cellspacing="0" cellpadding="0" align="center" height="100%">
  <tbody><tr>
    <td height="74">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	    <tbody><tr>
	      <td height="74" background="./images/xitong.jpg"></td>
	    </tr>
	  </tbody></table>
	</td>
  </tr>
  <tr>
    <td height="100%">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" height="100%">
	  <tbody><tr>
	    <td width="155" valign="top" height="100%" background="./images/ManageFunListBackGround.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td height="31" background="./images/ManageFunListTop.gif" align="center"><font color="darkred">admin 您好！</font></td></tr>
    <?php 
		$SqlStr="SELECT Flag,FunctionName,FunctionDir,FunctionFileName from managefunction Where Root='0' order by SortId ";
		$rs = mysql_query($SqlStr);
  		while($row = mysql_fetch_array($rs)) 
		{
			$FunctionName=$row['FunctionName'];
			$FunctionDir=$row['FunctionDir'];
			$Flag=$row['Flag'];
			$FunctionFileName=$row['FunctionFileName'];
        	echo '<tr><td height="24" background="./images/ManageFunListBar.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%"><tbody><tr><td width="30">&nbsp;</td><td><a href="/'.$FunctionDir.'/'.$FunctionFileName.'?flag='.$Flag.'">'.$FunctionName.'</a></td></tr></tbody></table></td></tr>';

		}
		mysql_free_result($rs);
?>
        
        <tr><td height="56" align="right"></td></tr><tr><td height="56" background="./images/ManageFunListBottom.gif">&nbsp;</td></tr></tbody></table></td>
	    <td valign="top">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%" background="./images/ManageBackGround.gif">
            <tbody><tr>
              <td height="33" background="./images/ManageTop.gif">&nbsp;</td>
            </tr>
            <tr> 
			  <td height="100%">
				<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" height="100%">
				  <tbody><tr>
				  <td>
				<table class="indicator" cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                <tbody><tr>		
				<td class="left"></td>
				<td class="center">当前位置 &gt;&gt; 系统管理</td>
				<td class="right"></td>
                </tr>
                </tbody></table>
                </td>
				  </tr>
				  <tr valign="top">
				    <td height="21" valign="top"></td>
				  </tr>
				  <form name="frmserverip"></form>
				  <tr style="display:none;">
				    <td>
				    <input type="text" name="ServerIp" size="60" value="http://www.jxzxx.org.cn">
				    <input type="text" name="ServerPort" value="80">
				    </td>
				  </tr>
				  
				  <tr valign="top">
				    <td height="100%" valign="top">
				    <h4 align="center"><br><br><br><br><br><br>选择左边需要管理的栏目！</h4>
				    </td>
				  </tr>
				</tbody></table>
			  </td>
            </tr>
          </tbody></table>
	    </td>
	  </tr>
	</tbody></table>
	</td>
  </tr>
</tbody></table>
</td><td width="12" class="rightBG"></td></tr></tbody></table>



</body></html>