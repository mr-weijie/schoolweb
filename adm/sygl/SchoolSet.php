<?PHP include '../Inc/conn.php';?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>系统管理——学校设置</title>
<script language="javascript" src="/js/std.js"></script>
<link rel="stylesheet" href="/css/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0">
<?php 
$Act= trim($_POST['act']);
if($Act==1)//说明是提交来的数据
{
	$SchoolName= trim($_POST['SchoolName']);
	$SchoolAddress= trim($_POST['SchoolAddress']);
	$HeadMasterEmail= trim($_POST['HeadMasterEmail']);
	$RecordId= trim($_POST['Id']);
	if(strlen($SchoolName)==0)
	{
		echo "<script>alert('学校名称不能为空，请填写学校名称后再提交');history.back(-1);</script>";
		exit;
	}
	if(strlen($SchoolAddress)==0)
	{
		echo "<script>alert('学校地址不能为空，请填写学校地址后再提交');history.back(-1);</script>";
		exit;
	}
	if(strlen($HeadMasterEmail)==0)
	{
		echo "<script>alert('电子邮箱不能为空，请填写电子邮箱后再提交');history.back(-1);</script>";
		exit;
	}
	$SqlStr="Select Count(*) As Recs From schoolinfo";
	$rs = mysql_query($SqlStr);
	if($rs!='')
	{
		$row = mysql_fetch_array($rs); 
		$Recs=$row['Recs'];
		if($Recs==0)
		{
			$RowID=strtoupper(md5($SchoolName.date("Y-m-d H:i:s")));//最后转换成大写
			$SqlStr="Insert Into schoolinfo(RowID) Values('".$RowID."')";
			$rs=mysql_query($SqlStr);
			if(!$rs)//操作失败
			{
				$retstr="<script>alert('学校信息设置提交失败!');window.location.href='/sygl.php'; </script>";
				exit($retstr);
			}
		}
	}
	$SqlStr="Update schoolinfo Set SchoolName='".$SchoolName."',SchoolAddress='".$SchoolAddress."',HeadMasterEmail='".$HeadMasterEmail."'";
	$rs=mysql_query($SqlStr);
	if($rs)//操作成功
	{
		$retstr="<script>alert('学校信息设置提交成功!');window.location.href='/adm/sygl/SchoolSet.php'; </script>";
		exit($retstr);
	}else//操作失败
	{
				$retstr="<script>alert('学校信息设置提交失败!');window.location.href='/adm/sygl/SchoolSet.php'; </script>";
				exit($retstr);
	}
	exit;
}
$SqlStr="SELECT ID,SchoolName,SchoolAddress,HeadMasterEmail from schoolinfo ";
$rs = mysql_query($SqlStr);
if($rs!='')
{
	$row = mysql_fetch_array($rs); 
	$ID=$row['ID'];
	$SchoolName=$row['SchoolName'];
	$SchoolAddress=$row['SchoolAddress'];
	$HeadMasterEmail=$row['HeadMasterEmail'];
}
mysql_free_result($rs);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%" background="../images/ManageBackGround.gif">
            <tbody>
            <tr>
              <td height="33" background="../images/ManageTop.gif">&nbsp;</td>
            </tr>
            <tr> 
			  <td height="100%">
				<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" height="100%">
				  <tbody><tr>
				  <td><table class="indicator" cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                		<tbody>
                        <tr>
							<td class="left"></td>
							<td class="center">当前位置 &gt;&gt; 学校设置</td>
							<td class="right"></td>
            		    </tr>
                		</tbody>
                       </table>
                  </td>
				  </tr>
				  <tr valign="top">
				    <td height="21" valign="top"></td>
				  </tr>
				  <tr valign="top">
				    <td height="100%" valign="top">
				    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="ManageList">
                    <tbody>
                    <tr><th colspan="2" align="center">修改学校设置</th></tr>
                   	<form name="FrmManage" method="post" action="SchoolSet.php" >
                    	<input type="hidden" name="NotNullFeild" value="SchoolName,SchoolAddress,HeadMasterEmail">
            			<input type="hidden" name="NotNullDesc" value="学校名称,学校地址,管理员信箱" > 			
            <input type="hidden" name="EregPattern" value="d,C,C,d,d,d,C,date,date">
					<tr><td align="right"><font color="red"> *</font>学校名称</td><td align="left"><input type="text" name="SchoolName" value="<?php echo $SchoolName?>" maxlength="400"></td></tr>
                    <tr><td align="right"><font color="red"> *</font>学校地址</td><td align="left"><input type="text" name="SchoolAddress" value="<?php echo $SchoolAddress?>" size="50" maxlength="400"></td></tr>
                    <tr><td align="right"><font color="red"> *</font>管理员信箱</td><td align="left"><input type="text" name="HeadMasterEmail" value="<?php echo $HeadMasterEmail?>" size="40" maxlength="512"></td></tr>
                    <tr><td width="30%"></td><td width="70%"><input type="hidden" name="Id" value="<?php echo $ID ?>"><br></td></tr>
                    <tr><td colspan="2" align="center" height="30"><input name="save" type="button" style="BACKGROUND-IMAGE: url(/adm/images/save.gif)" class="ManageButtonExt" alt="保存" onClick="javascript:SaveRecord(true);" onMouseOver="javascript:changebtn(this);" onMouseOut="javascript:changebtn(this);">&nbsp;<input type="hidden" name="act" value="1"/></td></tr></tbody></table><br><br><br><br>
				    </td>
				  </tr></form>
				</tbody></table>
			  </td>
            </tr>
          </tbody></table>
</body></html>
