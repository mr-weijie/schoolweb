<?PHP include '../Inc/conn.php';?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>系统管理——显示技术支持设置</title>
<script language="javascript" src="/js/std.js"></script>
<link rel="stylesheet" href="/css/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0">
<?php 
$Act= trim($_POST['act']);
if($Act==1)//说明是提交来的数据
{
	$TechSupport= trim($_POST['TechSupport']);
	$SqlStr="Update schoolinfo Set TechSupport='".$TechSupport."'";
	$rs=mysql_query($SqlStr);
	if($rs)//操作成功
	{
		$retstr="<script>alert('显示技术支持设置提交成功!');window.location.href='/adm/sygl/TechSupportSet.php'; </script>";
		exit($retstr);
	}else//操作失败
	{
		$retstr="<script>alert('显示技术支持设置提交失败!');window.location.href='/adm/sygl/TechSupportSet.php'; </script>";
		exit($retstr);
	}
	exit;
}
$SqlStr="SELECT TechSupport from schoolinfo ";
$rs = mysql_query($SqlStr);
if($rs!='')
{
	$row = mysql_fetch_array($rs); 
	$TechSupport=$row['TechSupport'];
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
							<td class="center">当前位置 &gt;&gt; 技术支持</td>
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
                    <form name="FrmManage" action=""  method="post">
                        <input type="hidden" name="NotNullFeild" value="">
            			<input type="hidden" name="NotNullDesc" value="" > 			
            			<input type="hidden" name="EregPattern" value="">
                    <tr><th colspan="2">修改技术支持</th></tr>
                    <tr><td align="center"><font color="red"> *</font>显示技术支持</td><td>
                    	<select name="TechSupport">
                        	<option value="0" >选择显示技术支持</option>
                            <option value="1" <?php if(intval($TechSupport)==1) echo 'selected';?>>是</option>
                            <option value="2" <?php if(intval($TechSupport)==2) echo 'selected';?>>否</option>
                        </select></td></tr>
                    <tr><td width="30%"></td>
                    	<td width="70%">&nbsp;</td></tr>
                    <tr><td colspan="2" align="center" height="30">
                    <input name="save" type="button" style="BACKGROUND-IMAGE: url(/adm/images/save.gif)" class="ManageButtonExt" alt="保存" onclick="javascript:SaveRecord(true);"  onmouseover="javascript:changebtn(this);" onmouseout="javascript:changebtn(this);">&nbsp;<input type="hidden" name="buttonback" vlaue=""><input type="hidden" name="act" value="1"/></td></tr></form></table><br><br><br><br>
				    </td>
				  </tr></form>
				</tbody></table>
			  </td>
            </tr>
          </tbody></table>
</body></html>
