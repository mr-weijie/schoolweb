<?PHP include '../Inc/conn.php';?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="/css/style.css" type="text/css">
<script type="text/javascript" src="/js/std.js"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0">
<?php
$Act=$_POST['Act']; 
if($Act!='') DeleteRecord();//删除目标记录
$rowid= trim($_GET['rowid']);
$CurPage= trim($_GET['CurPage']);
if(strlen($rowid)==0) $Flag= trim($_POST['rowid']);
if(strlen($CurPage)==0) $CurPage= trim($_POST['CurPage']);
if($CurPage=='') $CurPage=1;

if(strlen($rowid)!=32)//说明是参数错误
{
	exit("<script>alert('参数错误！');history.back(-1);</script>");
}
	$SqlStr="Select FunctionName,Flag From managefunction Where RowID='".$rowid."'";
	$rs = mysql_query($SqlStr);
	if($rs=='')
	{
		exit("<script>alert('参数错误！');history.back(-1);</script>");
	}
	$row = mysql_fetch_array($rs); 
	$FunctionName=$row['FunctionName'];
	$Flag=$row['Flag'];
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%" background="./frdlnk_files/ManageBackGround.gif">
            <tbody><tr>
              <td height="33" background="./frdlnk_files/ManageTop.gif">&nbsp;</td>
            </tr>
            <tr> 
			  <td height="100%" align="center" valign="top">
				<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" height="100%">
				  <tbody><tr>
				  <td>
				<table class="indicator" cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                <tbody><tr>		
				<td class="left"></td>
				<td class="center">当前位置 &gt;&gt; <?php echo $FunctionName?></td>
				<td class="right"></td>
                </tr>
                </tbody></table>
                </td>
				  </tr>
				  <tr valign="top">
				    <td height="21" valign="top"></td>
				  </tr>
				  <tr valign="top">
		      <td height="100%" valign="top"><?php FrdLnkList()?></td></tr></tbody></table></td></tr></tbody></table>
</body></html>



<?php function FrdLnkList()
{ global $ConStr,$CurPage,$rowid,$Flag; 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ManageList">
  <form name="FrmManage" action="#" method="post">
  <tbody><tr>
    <td id="ManageContent">
    <table width="100%" border="0" cellspacing="1" cellpadding="0">
    <tbody>
    <tr><th width="40">序号</th><th width="260">连接名称</th><th>连接地址</th><th width="40">操作</th><th nowrap="" width="40">选择</th></tr>
    <?php
	$Nums=5;//每页最多显示信息条数
	$ConStr="Where Flag='".$Flag."'";
	$SqlStr="SELECT count(*) As Recs from Friendlinks ".$ConStr;
	$rs = mysql_query($SqlStr);
	$row = mysql_fetch_array($rs);
	$Recs=$row['Recs'];
	$pages=round($Recs/$Nums+0.499);//总页数
	if($CurPage>$pages) $CurPage=$pages; 
	$SqlStr="Select ID,RowID,LinkName,Link,LinkPic from Friendlinks ".$ConStr." Order by ID limit ".($CurPage-1)*$Nums.",".$Nums;;
	$rs = mysql_query($SqlStr);
	$XH=0;
  	while($row = mysql_fetch_array($rs)) 
	{
		$XH++;
		$ID=$row['ID'];
		$RowID=$row['RowID'];
		$LinkName=$row['LinkName'];
		$Link=$row['Link'];
		$LinkPic=$row['LinkPic'];
    	echo '<tr><td align="center">'.$XH.'</td><td><A href="EditFrdLnk.php?rowid='.$RowID.'">'.$LinkName.'</a></td><td>'.$Link.'</td><td align="center"><A href="'.$Link.'" target="_blank">查看链接</a></td><td align="center"><input type="checkbox" name="Id" value="'.$ID.'"></td></tr>';
	}
	mysql_free_result($rs);

	?>
	</tbody></table></td></tr>
    <tr><td colspan="3" height="40"><div align="right"><input name="add" type="button" style="BACKGROUND-IMAGE: url(/adm/images/add.gif)" class="ManageButton" alt="增加" onClick="javascript:AddRecord('<?php echo "EditFrdLnk.php?flag=".$Flag?>');" onMouseOver="javascript:changebtn(this);" onMouseOut="javascript:changebtn(this);">&nbsp;&nbsp;<input name="del" type="button" style="BACKGROUND-IMAGE: url(/adm/images/del.gif)" class="ManageButton" alt="删除" onClick="javascript:DelRecord(1);" onMouseOver="javascript:changebtn(this);" onMouseOut="javascript:changebtn(this);"><input name="Act" type="hidden"><input name="DelID" type="hidden">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td></tr>
<?php
	if($pages>1)
	{
	    echo '<tr class="ManagePage">';
		if($CurPage==1)
		{
			echo '<td colspan="10" height="22" align="right"><A href="?rowid='.$rowid.'&CurPage=2">下一页</A>&nbsp;|&nbsp;';
		}else
		{
			echo '<td colspan="10" height="22" align="right"><A href="?rowid='.$rowid.'&CurPage='.($CurPage-1).'">上一页</A>&nbsp;|&nbsp;';
			if($CurPage<$pages) echo '<A href="?rowid='.$rowid.'&CurPage='.($CurPage+1).'">下一页</A>&nbsp;|&nbsp;';
		}
		echo '&nbsp;总共'.$pages.'页</td></tr>';
	}
?></form>
</tbody></table>
<?php }?>







<?php 
function DeleteRecord()//删除目标记录
{
	$arr = explode(',',$_POST['DelID']);
  	foreach($arr as $ID)
	{
		$SqlStr="Delete from Friendlinks where ID='".$ID."'";
		$rs = mysql_query($SqlStr);
	}
	

}              
?>