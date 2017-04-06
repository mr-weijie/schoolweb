<?PHP include 'Inc/conn.php';?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>新闻中心</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
<SCRIPT language=javascript src="js/std.js"></SCRIPT>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="10">
<table width="984" border="0" align="center" cellpadding="0" cellspacing="0">
<tbody><tr>
<TD style="BACKGROUND: url(images/bodyBg_Left.gif) #ffffff"  width=12></TD>
<td><?php include 'inc/head.php'?></td>
<TD style="BACKGROUND: url(images/bodyBg_Right.gif) #ffffff" width=12></TD>
</tr></tbody></table>

<table width="984" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<TD style="BACKGROUND: url(images/bodyBg_Left.gif) #ffffff"  width=12></TD>
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
<table width="960" border="0" celspacing="0" cellpadding="0" cellspacing="0" align="center" height="100%">
	<tbody><tr>
		<td valign="top" width="160" align="left" height="100%">
<!----------------模块次主页模式--------------------->
<table cellpadding="0" cellspacing="0" width="100%" border="0">
<tbody>
<?php listLeftNews(64,20)?>
</tbody></table>
<!----------------模块次主页论文模式--------------------->
		</td>
		<td valign="top" width="15" height="100%">
		</td>
		<td valign="top" align="right" height="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td>&nbsp;</td></tr></tbody></table>
		</td>
		<td valign="top" align="right" height="100%">
        	<table cellpadding="0" cellspacing="4" width="100%" border="0" bgcolor="#ffffff">
            	<tbody>
                	<tr><td style="word-break:break-all;" align="center"><font style="color:sienna;FONT-SIZE:18pt;"><?php echo $Title?></font></td></tr>
                    <tr><td style="word-break:break-all;"><b>作者或出处：</b><font style="FONT-SIZE:9pt;"><?php echo $Author?></font></td></tr>
                    <tr><td style="word-break:break-all;"><b>阅读次数：</b><font style="FONT-SIZE:9pt;"><?php echo $Click?></font></td></tr>
                    <tr><td style="word-break:break-all;"><b>发表日期：</b><font style="FONT-SIZE:9pt;"><?php echo $OutTime?></font></td></tr>
                    <tr><td style="word-break:break-all;"><b>具体内容：</b>&nbsp;</td></tr>
                    <tr><td style="word-break:break-all;"><?php echo $Content?></td></tr>
                </tbody>
            </table>
		</td>
		<td valign="top" width="30" height="100%">
		</td>
	</tr>
</tbody></table>
<!------------------页面结束了----------------------->


</td><TD style="BACKGROUND: url(images/bodyBg_Right.gif) #ffffff" width=12></td></tr></tbody></table>
<?php include '/inc/bottom.php'?>

</body></html>
<?php 
function listLeftNews($Flag,$Nums)
{
	$SqlStr="SELECT FunctionName from webfunction where ManageFunId=".$Flag ;
	$rs = mysql_query($SqlStr);
	$row = mysql_fetch_array($rs);
	if($row!='')
	{
		$FunctionName=$row['FunctionName'];
	}
	mysql_free_result($rs);
	echo '<tr>';
	echo '<td bgcolor="#0072bc">';
	echo '<table cellpadding="1" cellspacing="0" width="100%" border="0">';
	echo '	<tbody><tr>';
	echo '	<td>';
    echo ' 	<table cellpadding="0" cellspacing="0" width="100%" border="0">';
    echo ' 	<tbody>';
    echo ' 	<tr>';
    echo '  <td height="18" background="./images/catalogbg.gif">&nbsp;<font style="color:#ffffff;">'.$FunctionName.'</font></td>';
    echo '  </tr>';
    echo '  <tr>';
    echo '   	<td bgcolor="#0072bc"></td>';
    echo '  </tr>';
    echo '  </tbody>';
    echo '</table>';
    echo '<table cellpadding="0" cellspacing="0" width="100%" border="0" bgcolor="#ffffff">';
    echo '<tbody>';
    echo '<tr>';
    echo '<td>';
    echo '<table cellpadding="2" cellspacing="0" width="100%" border="0">';
    echo '<tbody>';
	$SqlStr="SELECT RowID,Title from tblcontent where Flag=".$Flag." order by OutTime Desc limit 0,".$Nums;
	$rs = mysql_query($SqlStr);
 	while($row = mysql_fetch_array($rs)) 
	{
		$Title=$row['Title'];
		if(strlen($Title)>20) $Title=mb_substr($Title,0,18,'utf-8').'...';
		$RowID=$row['RowID'];
        echo '<tr>';
		echo '<td width="100%"><img src="./images/news_icon6.gif" align="absmiddle">&nbsp;<a href="news.php?id='.$RowID.'">'.$Title.'</a></td></tr>';
		echo '<tr>';
	}
	mysql_free_result($rs);
    echo '<tr><td align="right"><a href="newslist.php?flag='.$Flag.'">更多&gt;&gt;</a>&nbsp;&nbsp;</td></tr>';
    echo '</tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr>';
}
?>