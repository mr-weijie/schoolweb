<?PHP include 'Inc/conn.php';?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $SchoolName?>校园网站系统</title>
<LINK rel=stylesheet type=text/css href="css/style.css">
<SCRIPT language=javascript src="js/std.js"></SCRIPT>
<LINK rel=stylesheet type=text/css href="css/style.css">
<style type="text/css">
body {
	margin-top: 0px;
}
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0">
<TABLE border=0 cellSpacing=0 cellPadding=0 width=984 height="100%" align="center">
<tbody>
<tr>
    <TD style="BACKGROUND: url(images/bodyBg_Left.gif) #ffffff"  width=12></TD>
<td>
<?php include 'inc/head.php'?>
<!------------------页面开始了----------------------->
<table width="960" border="0" celspacing="0" cellpadding="0" cellspacing="0" align="center" height="100%">
	<tbody><tr>
		<td valign="top" width="184" height="100%">
<!---------------功能列表-Start----------------->
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
	<tbody><tr>
		<td height="31"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%"><tbody><tr><td width="156" background="./images/ManageFunListTop.gif" align="center" height="100%"><font color="darkred">您好！</font></td><td><img src="images/righttop.gif"></td></tr><tr><td><img src="images/FunctionListLine.gif"></td><td></td></tr></tbody></table></td>
	</tr>
	<tr>
		<td height="100%">
        	<table width="156" border="0" cellspacing="0" cellpadding="0" height="100%" background="./images/ManageFunListBackGround.gif" class="ChildFunction">
            	<tbody>
          <?php 
		  $SqlStr="SELECT RowID,FunctionName,FunctionDir,ManageFunId from webfunction where Root=31 And Deep = 3 and IsManage=1 and IsUse = 1 order by OrderID";
		  $rs = mysql_query($SqlStr);
			if($rs=='')
			{
				echo '对不起，没有找相应的系统菜单数据';
				return;
			}
		while($row = mysql_fetch_array($rs)) 
		{
			$FunctionName=$row['FunctionName'];
			$Flag=$row['RowID'];
//			$FunctionDir=$row['FunctionDir'];
			echo '<tr><td height="24" background="./images/ManageFunListBar.gif">';
			echo '<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">';
			echo '<tbody><tr><td width="30">&nbsp;</td>';
			echo '<td><a href="?flag='.$Flag.'&FN='.$FunctionName.'">&nbsp;&nbsp;'.$FunctionName.'</a></td>';
			echo '</tr></tbody></table></td></tr>';
		}
			mysql_free_result($rs);
		 	$FunctionName= trim($_GET['FN']);
		  ?>


<tr><td height="56" background="./images/ManageFunListBottom.gif"><br><br><br><br></td></tr>
<tr><td height="100%" background="./images/ManageFunListBackGround.gif"></td></tr><tr><td><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td></tr>
</tbody></table></td></tr></tbody></table>
<!---------------功能列表-End----------------->
		</td>
		<td valign="top" height="100%">

<!-----------------校园风光模式-------------------->
<table cellpadding="0" cellspacing="0" width="100%" border="0" bgcolor="#ffffff">
	<tbody>
    	<tr><td>
        	<table cellpadding="0" cellspacing="0" width="99%" height="800" border="0" align="right">
            	<tbody>
                	<tr>
                    	<td valign="top" height="30">&nbsp;</td>
                    </tr>
                    <tr>
                 		<td height="30" valign="top">
                        	<table class="indicator" cellpadding="0" cellspacing="0" width="100%" height="50" border="0">
                            	<tbody>
                                	<tr>
                                    	<td background="images/indicator_left.gif"></td>
                                        <td background="images/indicator_center.gif">当前位置 &gt;&gt; <?php echo $FunctionName?></td>
                                        <td background="images/indicator_right.gif"></td>
                                    </tr>
                                 </tbody>
                            </table>
                         </td>
                     </tr>
                     <tr>
                     	<td height="8"></td>
                     </tr>
                     <tr>
                   	<td valign="top" ><?php ShowDetailInfo(); ?></td></tr></tbody></table></td></tr></tbody></table>
<!-----------------校园风光模式-------------------->







		</td>
		<td valign="top" width="30" height="100%">
		</td>
	</tr>
</tbody></table>
<!------------------页面结束了----------------------->


</td>
  <TD style="BACKGROUND: url(images/bodyBg_Right.gif) #ffffff" width=12></TD></TR></TBODY></TABLE>
	<?php include '/inc/bottom.php'?><br>
</body></html>

<?php 
function ShowDetailInfo()
{
		 $FN= trim($_GET['FN']);
		 $Flag= trim($_GET['flag']);
		 $page=intval(trim($_GET['page']));
		 if($page==0) $page=intval(trim($_GET['Page']));
		 if($page==0) $page=1;
 		 if($Flag=='')
		 {
			return;
		 }
		 //先查出相应的ID
		$SqlStr="SELECT ManageFunId from webfunction where RowID='".$Flag."'";
		$rs = mysql_query($SqlStr);
		$row = mysql_fetch_array($rs);
		if($row=='')
		{
			return;
		}
		$ManageFunId=$row['ManageFunId'];
		//再根据ID找到相应Flag的记录
		$SqlStr="SELECT RowID,Id,Title,Content from TblContent where Flag='".$ManageFunId."'";

		$rs = mysql_query($SqlStr);
		$Recs=mysql_num_rows($rs);//记录数量
		$i=0;
		while($row = mysql_fetch_array($rs)) 
		{
			$i++;
			if($i==$page)
			{
				$RowID=$row['RowID'];
				$Id=$row['Id'];
				$Title=$row['Title'];
				$Content=$row['Content'];
			}
		}
		mysql_free_result($rs);
		$array1 = explode("<DIV>&nbsp;",$Content);
		$array2 = explode("<p>&nbsp;",$Content);
		$rows=sizeof($array1)+sizeof($array2);//取文本内容总行数
		echo '<table border="0" cellpadding="2" cellspacing="1" width="98%" class="show"><tbody>';
		echo '<tr><td align="center">'.$Title.'</td></tr>';
        echo '<tr><td>'.$Content.'</td></tr>';
		echo '<tr><td>';
		if($rows<50)
		{
			for($i=0;$i<50-$rows;$i++)
			{
		//		echo '<p>&nbsp;RRR</p>'.$rows;	
			}
		
		}
		echo '</td></tr>';
		if($Recs>1)
		{
			echo '<tr class="ManagePage"><td colspan="20" height="22" align="right"><a href="?flag='.$Flag.'&FN='.$FN.'&page=1">第一页</a>&nbsp;|&nbsp;<a href="?flag='.$Flag.'&FN='.$FN.'&page='.(($page-1)==0?1:($page-1)).'">上一页</a>&nbsp;|&nbsp;<a href="?flag='.$Flag.'&FN='.$FN.'&page='.(($page+1)>$Recs?$Recs:($page+1)).'">下一页</a>&nbsp;|&nbsp;<a href="?flag='.$Flag.'&FN='.$FN.'&page='.$Recs.'">最末页</a>&nbsp;第<select name="Page" onChange="onTurnPage(this)">'; 
			for($i=1;$i<=$Recs;$i++)
			{
				echo '<option value="'.$i.'">'.$i.'</option>';
			}
			echo '</select>页&nbsp;总共'.$Recs.'页</td></tr>';
		}
		echo '</tbody></table>';
		
}                 
?>