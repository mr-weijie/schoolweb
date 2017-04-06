<?PHP include 'Inc/conn.php';?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>新闻中心</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
<SCRIPT language=javascript src="js/std.js"></SCRIPT>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="10">
<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td>
<?php 
$Flag= trim($_GET['flag']);
$Id= trim($_GET['id']);
if($Id!='')
{
	$SqlStr="SELECT Title,Author,Click,Content,OutTime from tblcontent where RowID='".$Id."'";
	$rs = mysql_query($SqlStr);
	$row = mysql_fetch_array($rs);
	if($row!='')
	{
		$Title=$row['Title'];
		$Author=$row['Author'];
		$Click=$row['Click'];
		$Content=$row['Content'];
		$OutTime=$row['OutTime'];
		$OutTime=date('Y-m-d',strtotime($row['OutTime']));
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
                	<tr><td style="word-break:break-all;" align="center"><font style="color:sienna;FONT-SIZE:18pt;"><?php //echo $Title?></font></td></tr>
                    <tr><td style="word-break:break-all;"><b>作者或出处：</b><font style="FONT-SIZE:9pt;"><?php echo $Author?></font></td></tr>
                    <tr><td style="word-break:break-all;"><b>阅读次数：</b><font style="FONT-SIZE:9pt;"><?php echo $Click?></font></td></tr>
                    <tr><td style="word-break:break-all;"><b>发表日期：</b><font style="FONT-SIZE:9pt;"><?php echo $OutTime?></font></td></tr>
                    <tr><td style="word-break:break-all;"><b>具体内容：</b>&nbsp;</td></tr>
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
