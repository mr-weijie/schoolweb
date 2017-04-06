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
		//echo $SqlStr;
		$rs = mysql_query($SqlStr);
		$Recs=mysql_num_rows($rs);//记录数量
		$i=0;
		echo '<table border="0" cellpadding="2" cellspacing="1" width="98%" class="show"><tbody>';
		while($row = mysql_fetch_array($rs)) 
		{
			$RowID=$row['RowID'];
			$Id=$row['Id'];
			$Title=$row['Title'];
			$Content=$row['Content'];
			$PicName="";
			if(preg_match("/\/ueditor\/php\/upload\/image\/(.*?)\.jpg/i", $Content, $matches))//利用正则查找内容中的图片
			{
			    $PicName=$matches[0];
			} 
				else if(preg_match("/\/ueditor\/php\/upload\/image\/(.*?)\.gif/i", $Content, $matches))
			{
			    $PicName=$matches[0];
			}
			if($PicName!="")
			{
				echo '<tr><td align="center">'.$Title.'</td></tr>';
				echo '<tr><td align="center"><A href="#" target=_blank ><IMG title='.$Title.' border=0 src="'.$PicName.'" width="400" height="200"></A></td><tr>';
			}
		}
		echo '</tbody></table>';
		mysql_free_result($rs);
}                 
?>