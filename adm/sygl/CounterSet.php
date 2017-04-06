<?PHP include '../Inc/conn.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="/css/style.css" type="text/css">
<script type="text/javascript" src="/js/std.js"></script>
</head>
<body>
<?php
	$Act=$_POST['Act']; 
	if(strlen($Act)>0)
	{
		$VisitCounter=$_POST['VisitCounter']; 
		$SqlStr="Update Schoolinfo Set Counter='".$VisitCounter."'";
		$rs=mysql_query($SqlStr);
		if($rs)//操作成功;
		{
			$retstr="<script>alert('记录提交成功!');document.location.href='CounterSet.php';</script>";
		}else//操作失败
		{
			$retstr="<script>alert('记录提交失败!');document.location.href='CounterSet.php';</script>";
		}
		exit($retstr);	
	}
	$SqlStr="Select Counter From Schoolinfo";
	$rs = mysql_query($SqlStr);
	if($rs!='')
	{
		$row = mysql_fetch_array($rs); 
		$Counter=$row['Counter'];
	}
	mysql_free_result($rs);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%" background="./——系统管理_files/ManageBackGround.gif">
            <tbody>
            <tr> 
			  <td height="100%" valign="top">
				<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" height="100%">
				  <tbody><tr>
				  <td>
				<table class="indicator" cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                <tbody><tr>		
				<td class="left"></td>
				<td align="left" class="center">当前位置 &gt;&gt; 计数器</td>
				<td class="right"></td>
                </tr>
                </tbody></table>
                </td>
				  </tr>
				  <tr valign="top">
				    <td height="100%" valign="top">
				    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="ManageList">
                    <form name="FrmManage" action="#" method="post">
                    <tbody>
                    <tr><th colspan="2" align="center">设置计数器</th></tr>
                    <tr><td align="right"><font color="red"> *</font>计数器</td><td align="left"><input type="text" name="VisitCounter" value="<?php echo $Counter?>" maxlength="8"></td></tr>
                    <tr><td width="30%"></td><td width="70%">
                     <input type="hidden" name="NotNullFeild" value="VisitCounter">
                     <input type="hidden" name="NotNullDesc" value="计数器">
                     <input type="hidden" name="EregPattern" value="d">
                     <input type="hidden" name="Act" value="1" />
                     </td></tr>
                     <tr><td colspan="2" align="center" height="30"><input name="save" type="button" style="BACKGROUND-IMAGE: url(/adm/images/save.gif)" class="ManageButtonExt" alt="保存" onClick="javascript:SaveRecord(true);" onMouseOver="javascript:changebtn(this);" onMouseOut="javascript:changebtn(this);">&nbsp;<input type="hidden" name="buttonback" vlaue=""></td></tr></tbody></table><br><br><br><br>
				    </td>
				  </tr></form>
				</tbody></table>
			  </td>
            </tr>
          </tbody></table>
</body>
</html>