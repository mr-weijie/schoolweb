<?PHP include 'Inc/conn.php';?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>具体图书详情</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
<SCRIPT language=javascript src="js/std.js"></SCRIPT>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="10">
<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td>
<?php 
$Id= trim($_GET['Id']);
if($Id!='')
{
	$SqlStr="SELECT Id,Flag,ISDN,Name,Author,Publish,Position,Content from tushu where RowID='".$Id."'";
	$rs = mysql_query($SqlStr);
	$row = mysql_fetch_array($rs);
	if($row!='')
	{
		$Flag=$row['Flag'];
		$ISDN=$row['ISDN'];
		$Name=$row['Name'];
		$Author=$row['Author'];
		$Publish=$row['Publish'];
		$Position=$row['Position'];
		$Content=$row['Content'];
	}
	mysql_free_result($rs);

}
?>
<!------------------页面开始了----------------------->
<table width="100%" border="0" celspacing="0" cellpadding="0" cellspacing="0" align="center" height="100%">
	<tbody><tr>
		<td valign="top" align="right" height="100%">
        	<table cellpadding="0" cellspacing="4" width="100%" border="0" bgcolor="#ffffff">
            	<tbody>
                	<tr><td style="word-break:break-all;" align="center">图书编号：<font style="color:sienna;FONT-SIZE:18pt;"><?php echo $ISDN?></font></td></tr>
                    <tr><td style="word-break:break-all;"><b>图书名称：</b><font style="FONT-SIZE:9pt;"><?php echo $Name?></font></td></tr>
                    <tr><td style="word-break:break-all;"><b>图书作者：</b><font style="FONT-SIZE:9pt;"><?php echo $Author?></font></td></tr>
                    <tr><td style="word-break:break-all;"><b>出 版 社：</b><font style="FONT-SIZE:9pt;"><?php echo $Publish?></font></td></tr>
                    <tr><td style="word-break:break-all;"><b>图书位置：</b><font style="FONT-SIZE:9pt;"><?php echo $Position?></font></td></tr>
                    <tr><td style="word-break:break-all;"><b>内容简介：</b>&nbsp;</td></tr>
                    <tr><td style="word-break:break-all;"><?php echo $Content?></td></tr>
                </tbody>
            </table>
		</td>
		</td>
	</tr>
</tbody></table>
<!------------------页面结束了----------------------->
</tr></tbody></table>

</body></html>
