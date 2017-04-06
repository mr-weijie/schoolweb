<?PHP include 'Inc/conn.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/css/style.css" type="text/css">
<script type="text/javascript" src="/js/std.js"></script>
<?php
	$Id=$_GET['Id'];
	$SqlStr="select a.Title,a.FromWhere,b.Type,a.Content,a.outTime  from PopUpWindow a left join (select Type,TypeCode from MicroType where TableName='PopUpWindow' and FieldName='ImportantLevel') b on a.ImportantLevel= b.TypeCode where RowId='".$Id."'";
	$rs=mysql_query($SqlStr);
	if($rs)//操作成功;
	{
		$row = mysql_fetch_array($rs);
		$title=$row['title'];
		$TypeCode=$row['Type'];
		$FromWhere=$row['FromWhere'];
		$Content=$row['Content'];
		$outTime=strtotime($row['outTime']);
		$outTime= date('Y-m-d',$outTime);

	}
?>

<title><?php echo $title;?></title>
<SCRIPT LANGUAGE=javascript>
<!--
IsCloseAuto = '<?php echo $_GET['IsCloseAuto']?>';
TimeDelay = '<?php echo $_GET['TimeDelay']?>';
Id = '<?php echo $_GET['Id'] ?>';
function init()
{
	try
	{
		IsCloseAuto = parseInt(IsCloseAuto);
		TimeDelay = parseInt(TimeDelay);
		if (IsCloseAuto == 2)
			if (TimeDelay>0)
			{
				TimeDelay = TimeDelay*1000*60;
				setTimeout("WinClose()",TimeDelay);
			}
	}
	catch(e)				
	{alert(e.description);}
	window.focus();
}
function WinClose()
{
	window.close();
}
function unload()
{
	try
	{
		var popid = GetCookie("popallid");
		if (popid == "" || popid == null || popid=='undefined')
			return;
		popid = popid.split(",")
		var str = "";
		for (var i=0;i<popid.length;i++)
			if (popid[i] != Id.toString(10))
				if (str == "")
					str = popid[i];
				else
					str += "," + popid[i];
		SetCookie("popallid",str);
	}
	catch(e)
	{;}
}
//-->
</SCRIPT>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" style="background:url(/ws2004/public/pic/0)" onload="init();"  onunload="unload();">
<table width="100%" border="0" cellspacing="8" cellpadding="0" height="100%">
  <tr>
    <td align="center"><font color="sienna" size="4"><?php echo $title?></font></td>
  </tr>
  <tr>
    <td align="center"><font color="#0066CC">发布人或部门：<?php echo $FromWhere ?> 重要程度：<?php echo $TypeCode ?></font></td>
  </tr>
  <tr>
    <td height="100%" valign="top"><?php echo $Content ?></td>
  </tr>
  <tr>
    <td align="right"><font color="#0066CC">发布日期：<?php echo $outTime ?></font></td>
  </tr>
  <tr>
    <td align="center">[ <a href="Javascript:window.close()"><font color="green">关闭窗口</font></a> ]</td>
  </tr>
</table>
</body>
</html>
</body>
</html>