<?PHP include '../Inc/conn.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/css/style.css" type="text/css">
<script type="text/javascript" src="/js/std.js"></script>
<title>编辑记录</title>
</head>
<body>
<?php
$Act=$_POST['Act']; 
if(strlen($Act)>0)//说明是保存操作
{
	$Flagrowid=$_POST['Flagrowid'];
	$rowid=$_POST['RowId'];
	$Name=$_POST['Name'];
	$TelePhone=$_POST['TelePhone'];
	$Flag=$_POST['Flag'];
	if(strlen($rowid)==0)
	{
		$rowid=strtoupper(md5($Name.$TelePhone.$Flag.date("Y-m-d H:i:s")));//最后转换成大写
		$SqlStr="Insert Into PhoneBook(RowID,Flag,Name,TelePhone) Values('".$rowid."','".$Flag."','".$Name."','".$TelePhone."')";
	}else
	{
		$SqlStr="Update PhoneBook Set Name='".$Name."',TelePhone='".$TelePhone."' Where RowID='".$rowid."'";
	}
	$rs=mysql_query($SqlStr);
	if($rs)//操作成功
	{
		$retstr="<script>alert('记录提交成功!');window.location.href='PhoneList.php?rowid=".$Flagrowid."'; </script>";
	}else//操作失败
	{
		$retstr="<script>alert('记录提交失败!');history.back(-1);</script>";
	}
	exit($retstr);	

exit();
	

}
$rowid=$_GET['rowid'];
$Flag=$_GET['flag'];

if(strlen($rowid)!=32&&strlen($rowid)>0)//说明是参数错误
{
	exit("<script>alert('参数错误！');history.back(-1);</script>");
}
if(strlen($rowid)>0)
{
	$SqlStr="Select Id,Flag,Name,TelePhone from phonebook Where RowID='".$rowid."'";
	$rs = mysql_query($SqlStr);
	if($rs=='')
	{
		exit("<script>alert('记录不存在或已被删除！');history.back(-1);</script>");
	}
	$row = mysql_fetch_array($rs); 
	$Flag=$row['Flag'];
	$Flagrowid=$row['RowID'];
	$Name=$row['Name'];
	$TelePhone=$row['TelePhone'];
}
if(strlen($Flag)>0)
{
	$SqlStr="Select Rowid,FunctionName From managefunction Where Flag='".$Flag."'";
	$rs = mysql_query($SqlStr);
	$row = mysql_fetch_array($rs); 
	$Flagrowid=$row['Rowid'];
	$FunctionName=$row['FunctionName'];
}
?>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="ManageList">
<form name="FrmManage" action="EditPhone.php"  method="post">
<tr><th colspan="2"><?php if(strlen($rowid)>0) {echo '编辑'.$FunctionName;} else {echo '新增<font color="#FF0000"><b>'.$FunctionName.'</b></font>记录';}?></th></tr>
<tr style="display:none;"><td align="right"><font color="red"> *</font>标识字段</td><td align="left"><input type="text" name="Flag" value="<?php echo $Flag?>" ></td></tr>
<tr><td align="right"><font color="red"> *</font>个人姓名或部门</td><td align="left"><input type="text" name="Name"  value="<?php echo $Name?>" size="50" maxlength="200"></td></tr>
<tr><td align="right"><font color="red"> *</font>电话号码</td><td align="left"><input type="text" name="TelePhone" value="<?php echo $TelePhone?>" size="80" maxlength="512"></td></tr>
<tr><td width="18%"></td><td width="82%">
<input type="hidden" name="RowId" value="<?php echo $rowid?>" />
<input type="hidden" name="Flagrowid" value="<?php echo $Flagrowid?>" />
<input type="hidden" name="NotNullFeild" value="Flag,Name,TelePhone">
<input type="hidden" name="NotNullDesc" value="标识字段,个人姓名或部门,电话号码" >
<input type="hidden" name="EregPattern" value="d,C,C">
<input type="hidden" name="Act" value="1">
<br></td></tr>
<tr><td colspan="2" align="center" height="30"><input name="save" type="button" style="BACKGROUND-IMAGE: url(/adm/images/save.gif)" class="ManageButtonExt" alt="保存" onclick="javascript:SaveRecord(true);"  onmouseover="javascript:changebtn(this);" onmouseout="javascript:changebtn(this);">&nbsp;<input name="back" type="button" style="BACKGROUND-IMAGE: url(/adm/images/back.gif)" class="ManageButtonExt" alt="返回" onclick="javascript:Back();"  onmouseover="javascript:changebtn(this);" onmouseout="javascript:changebtn(this);">&nbsp;</td></tr></form></table>
</body>
</html>