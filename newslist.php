<?PHP include 'Inc/conn.php';?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>新闻中心</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
<script type="text/javascript" src="js/Dialog.js"></script>
<script type="text/javascript" src="js/zOpenD.js"></script>
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
$CurPage= trim($_GET['CurPage']);
if($CurPage=='') $CurPage=1;
?>
<table width="960" border="0" cellspacing="0" cellpadding="0" align="center" height="74">
	<tbody>
    <tr><td background="images/news.gif">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tbody>
            	<tr>
                	<td width="30"></td>
                    <td width="750" id="glowdiv" style="text-align:left;font-family:黑体,宋体,幼圆,隶书;LETTER-SPACING: 4px;color=#ffffff;font-weight:bold;font-size:18pt;filter:Glow(Color=#3366ff,Strength=2;)" align="center" valign="middle"></td>
                </tr>
            </tbody>
         </table>
         </td>
     </tr></tbody>
    </table>

<!------------------页面开始了----------------------->
<table width="960" border="0" celspacing="0" cellpadding="0" cellspacing="0" align="center" height="100%">
	<tbody><tr>
		<td valign="top" width="184" height="100%">



<!---------------功能列表------------------>
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
	<tbody><tr>
		<td height="31"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%"><tbody><tr><td width="156" background="./images/ManageFunListTop.gif" align="center" height="100%"><font color="darkred">您好！</font></td><td><img src="./images/righttop.gif"></td></tr><tr><td><img src="./images/FunctionListLine.gif"></td><td></td></tr></tbody></table></td>
	</tr>
	<tr>
		<td height="100%">
        <table width="156" border="0" cellspacing="0" cellpadding="0" height="100%" background="./images/ManageFunListBackGround.gif" class="ChildFunction">
        	<tbody>
            	<tr><td height="24" background="./images/ManageFunListBar.gif">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
                    	<tbody>
                        <tr>
                        	<td width="30">&nbsp;</td>
                            <td><a href="/newslist.php">新闻中心</a></td>
                        </tr>
                        </tbody>
                    </table>
                    </td>
                </tr>
          <?php 
		  $SqlStr="SELECT RowID,FunctionName from webfunction where Root=55 And Deep = 3 and IsManage=1 and IsUse = 1 order by OrderID";
		  $rs = mysql_query($SqlStr);
			if($rs=='')
			{
				echo '对不起，没有找相应的系统菜单数据';
				return;
			}
		while($row = mysql_fetch_array($rs)) 
		{
			$FunctionName=$row['FunctionName'];
			$RowID=$row['RowID'];
			echo '<tr><td height="24" background="./images/ManageFunListBar.gif">';
			echo '<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">';
			echo '<tbody><tr><td width="30">&nbsp;</td>';
			echo '<td><a href="?flag='.$RowID.'">&nbsp;&nbsp;'.$FunctionName.'</a></td>';
			echo '</tr></tbody></table></td></tr>';
		}
			mysql_free_result($rs);
		  ?>
          <tr><td height="56" background="./images/ManageFunListBottom.gif"><br><br><br><br></td></tr>
	<tr><td height="100%" background="./images/ManageFunListBackGround.gif"></td></tr><tr><td><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td></tr>
</tbody></table></td></tr></tbody></table>
		</td>
		<td valign="top" width="15" height="100%">
		</td>
		<td valign="top" height="100%">
<table cellpadding="0" cellspacing="0" width="100%" border="0" bgcolor="#ffffff">
	<tbody>
    	<tr>
        	<td>
            	<table cellpadding="0" cellspacing="0" width="98%" border="0" align="right">
                	<tbody>
                    	<tr>
                        	<td>&nbsp;</td>
                        </tr>
                        <tr>
						<?php 
						$SqlStr="SELECT Image from webfunction where ManageFunId=".$Flag;
						$rs = mysql_query($SqlStr);
						$row = mysql_fetch_array($rs);
						if($row!='')
						{
							$Image=$row['Image'];
						}
						if($Image!='')
						{
                        	echo '<td><img src="'.$Image.'"></td>';
						}else
						{
                        	echo '<td></td>';
						}
						mysql_free_result($rs);
						?>
                        </tr>
                        <tr>
                        	<td height="8"></td>
                        </tr>
                        <tr>
                        	<td valign="top" align="right">
                            	<table border="0" cellpadding="6" cellspacing="1" width="98%">
                                	<tbody>
                                    <?php listNewsInfo($Flag,15,$CurPage); ?>
                                    </tbody>
                                </table>
                             </td>
                         </tr>
                     </tbody>
                 </table>
            </td>
       </tr>
    </tbody>
</table>
		</td>
		<td valign="top" width="30" height="100%">
		</td>
	</tr>
</tbody></table>
</td><TD style="BACKGROUND: url(images/bodyBg_Right.gif) #ffffff" width=12></TD></tr></tbody></table>
<?php include '/inc/bottom.php'?>

</body></html>

<?php 
function listNewsInfo($Flag,$Nums,$CurPage)
{
	$SqlStr="SELECT ManageFunId from webfunction where RowID='".$Flag."'";
	$rs = mysql_query($SqlStr);
	$row = mysql_fetch_array($rs);
	$ManageFunId=$row['ManageFunId'];
	mysql_free_result($rs);
	$SqlStr="SELECT count(*) As Recs from tblcontent where Flag=".$ManageFunId;
	$rs = mysql_query($SqlStr);
	$row = mysql_fetch_array($rs);
	$Recs=$row['Recs'];
	mysql_free_result($rs);
	$pages=round($Recs/$Nums+0.499);//总页数
	if($CurPage>$pages) $CurPage=$pages;
	$SqlStr="SELECT RowID,Title from tblcontent where Flag=".$ManageFunId." order by OutTime Desc limit ".($CurPage-1)*$Nums.",".$Nums;
	$rs = mysql_query($SqlStr);
	$I=0;
 	while($row = mysql_fetch_array($rs)) 
	{
		$I++;
		$Title=$row['Title'];
		$RowID=$row['RowID'];
		echo '<tr>';
    	echo '<td width="100%">';
//    	echo '<img src="./images/news_icon.gif" align="absmiddle">&nbsp;<a href="/news.php?id='.$RowID.'" target="blank"><font style="FONT-SIZE:9pt;">'.$Title.'</font></a></td>';
		echo '<img src="./images/news_icon.gif" align="absmiddle">&nbsp;<a onclick="javascript:zOpenD(\'/ShowInfo.php?id='.$RowID.'\',\''.$Title.'\',900,500)">&nbsp;&nbsp;'.$Title.'</a></td>';
    	echo '</tr>';
	}
    echo '<tr class="ManagePage">';
	if($pages>1)
	{
		if($CurPage==1)
		{
		    echo '<td colspan="20" height="22" align="right"><A href="newslist.php?flag='.$Flag.'&CurPage=2">下一页</A>&nbsp;|&nbsp;';
		}else
		{
		    echo '<td colspan="20" height="22" align="right"><A href="newslist.php?flag='.$Flag.'&CurPage='.($CurPage-1).'">上一页</A>&nbsp;|&nbsp;';
			if($CurPage<$pages) echo '<A href="newslist.php?flag='.$Flag.'&CurPage='.($CurPage+1).'">下一页</A>&nbsp;|&nbsp;';
		}
		echo '&nbsp;总共'.$pages.'页</td></tr>';		
	}
	mysql_free_result($rs);
}                 $Flag= trim($_GET['']);
$CurPage= trim($_GET['CurPage']);
?>