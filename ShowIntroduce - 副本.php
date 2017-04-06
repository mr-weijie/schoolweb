<?PHP include 'Inc/conn.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK rel=stylesheet type=text/css href="css/style.css">
<SCRIPT language=javascript src="js/std.js"></SCRIPT>
<title>学校概况</title>
</head>
<body>
<table cellpadding="0" cellspacing="0" width="100%" height="100%" border="0" bgcolor="#ffffff">
	<tbody>
    	<tr><td><?php ShowDetailInfo(); ?></td></tr></tbody></table>
</body>
</html>

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
		$SqlStr="SELECT RowID,Id,Title,Content from TblContent where Flag='".$Flag."'";
		echo $SqlStr;
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
//		$array1 = explode("<DIV>&nbsp;",$Content);
//		$array2 = explode("<p>&nbsp;",$Content);
//		$rows=sizeof($array1)+sizeof($array2);//取文本内容总行数
		echo '<table border="0" cellpadding="2" cellspacing="1" width="98%" class="show"><tbody>';
		echo '<tr><td align="center">'.$Title.'</td></tr>';
        echo '<tr><td align="left">'.$Content.'</td></tr>';
		echo '<tr><td>&nbsp;</td></tr>';
		if($Recs>1)
		{
			echo '<form name="form1" method="get"><tr class="ManagePage"><td colspan="20" height="22" align="right"><a href="?flag='.$Flag.'&page=1">第一页</a>&nbsp;|&nbsp;<a href="?flag='.$Flag.'&page='.(($page-1)==0?1:($page-1)).'">上一页</a>&nbsp;|&nbsp;<a href="?flag='.$Flag.'&page='.(($page+1)>$Recs?$Recs:($page+1)).'">下一页</a>&nbsp;|&nbsp;<a href="?flag='.$Flag.'&page='.$Recs.'">最末页</a>&nbsp;第<select name="page" onChange="TurnPagesubmit()">'; 
			for($i=1;$i<=$Recs;$i++)
			{
				echo '<option value="'.$i.'"';
				if($i==intval($page)) echo ' selected';
				echo '>'.$i.'</option>';
			}
			echo '</select>页&nbsp;总共'.$Recs.'页';
			echo '<input type="hidden" name="flag" value="'.$Flag.'"></td></tr></form>';
		}
		echo '</tbody></table>';
		echo '<script>function TurnPagesubmit(){document.form1.submit();}</script>';
		
}                 
?>