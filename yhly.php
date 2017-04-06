<?PHP include 'Inc/conn.php';?>
<SCRIPT language=javascript src="js/std.js"></SCRIPT>
<LINK rel=stylesheet type=text/css href="css/style.css">
<style type="text/css">
.MsgTB TR
{
	height: 35px;
}
.inputCase
{
	border: 1px solid #aaaaaa;
}
.MsgTB TEXTAREA
{
	border: 1px solid #aaaaaa;
	margin-top: 5px;
	margin-bottom: 5px;
}
.MsgTB TD
{
	padding-left: 10px;
}
</style>
<?php 
$Act= trim($_POST['act']);
if($Act==1)//说明是提交来的数据
{
	$Name= trim($_POST['Name']);
	$Email= trim($_POST['Email']);
	$ContactPhone= trim($_POST['ContactPhone']);
	$Title= trim($_POST['Title']);
	$Content= trim($_POST['Content']);
	if(strlen($Name)==0)
	{
		echo "<script>alert('姓名不能为空，请填写姓名后再提交');history.back(-1);</script>";
		exit;
	}
	if(strlen($Email)==0)
	{
		echo "<script>alert('电子邮箱不能为空，请填写电子邮箱后再提交');history.back(-1);</script>";
		exit;
	}
	if(strlen($Title)==0)
	{
		echo "<script>alert('留言主题不能为空，请填写留言主题后再提交');history.back(-1);</script>";
		exit;
	}
	if(strlen($Content)==0)
	{
		echo "<script>alert('留言内容不能为空，请填写留言内容后再提交');history.back(-1);</script>";
		exit;
	}
	$IP=getIP();
	$RowID=strtoupper(md5($Name.$Email.$Content.date("Y-m-d H:i:s")));//最后转换成大写

	$SqlStr="Insert Into leaveword(RowID,Name,Email,ContactPhone,title,Content,DateTime,IP) Values('".$RowID."','".$Name."','".$Email."','".$ContactPhone."','".$Title."','".$Content."',Now(),'".$IP."')";
	$rs=mysql_query($SqlStr);
	if($rs)//操作成功
	{
		$retstr="<script>alert('留言提交成功，但须等待管理员审核后才能正常显示!');window.location.href='/LiuYanList.php'; </script>";
		exit($retstr);
	}else//操作失败
	{
		$obj->status='Err';
		$obj->msg ='数据库操作出错！';
		$retstr=json_encode($obj);
		exit($retstr);	
	}
	
	
	exit;
}


?>
<center>
<table border="0" cellpadding="5" cellspacing="0">
	<tbody><tr height="35">
		<td height="35" valign="bottom" align="right" style="padding-bottom:2px;">&nbsp;&nbsp;<a style="color:#EB713E;font-size:10pt;" href="#" title="查看全部留言">查看全部留言</a>&nbsp;
		</td>
	</tr>
	<tr height="35" style="background:#ffffff url(/SysImages/topbg.gif) repeat-x 0 -3px;">
		<td height="35" valign="center" style="border-top:1px solid #dddddd;"><span style="position:relative;top:2px;font-size:10pt;color:#333333;font-weight:600;">&nbsp;请仔细填写以下留言信息</span></td>
	</tr>
	<tr>
		<td bgcolor="#ffffff" valign="top" style="padding-top:5px;border:1px solid #dddddd;" align="center">
			<table border="0" class="MsgTB" cellspacing="0" cellpadding="0">
				<form name="form1" id="form1" method="post" action="#" onSubmit="return false;">
				<tbody><tr height="30">
					<td align="right" width="100">您的姓名(必填)：</td>
					<td><input type="text" name="Name" size="30" maxlength="50" class="InputCase" value="">&nbsp;</td>
				</tr>
				<tr height="30">
					<td align="right">电子邮箱(必填)：</td>
					<td><input type="text" name="Email" size="30" maxlength="50" class="InputCase">&nbsp;</td>
				</tr>
				<tr height="30">
					<td align="right">联系电话(选填)：</td>
					<td><input type="text" name="ContactPhone" size="30" maxlength="30" class="InputCase"></td>
				</tr>
				<tr height="30">
					<td align="right">留言主题(必填)：</td>
					<td><input type="text" name="Title" size="49" maxlength="100" class="InputCase">&nbsp;</td>
				</tr>
				<tr height="165">
					<td align="right">留言内容(必填)：<br></td>
					<td><textarea name="Content" style="overflow:auto;width:352px;" cols="50" rows="10"></textarea></td>
				</tr>
				<tr>
					<td colspan="2" align="center" height="35" style="padding-top:20px;padding-bottom:10px;">
						<button onClick="form_submit(form1);" class="btnOut" onMouseMove="this.className=&#39;btnMove&#39;" onMouseOut="this.className=&#39;btnOut&#39;">
							<span>确&nbsp;定</span>
						</button>
						&nbsp;&nbsp;
						<button onClick="document.form1.reset()" class="btnOut" onMouseMove="this.className=&#39;btnMove&#39;" onMouseOut="this.className=&#39;btnOut&#39;">
							<span>重&nbsp;填</span>
						</button>						
					</td>
				</tr>				
				<input type="hidden" name="act" value="1"/>
			</tbody></form></table>
		</td>
	</tr>
	
		
	<tr height="9">
		<td>&nbsp;
		</td>
	</tr>
</tbody></table>
</center>
<script language="javascript">
<!--
	document.Message_form.elements["Name"].focus();
-->
</script>
<iframe name="hideframe" style="display:none;" src="./default.asp_files/saved_resource.html"></iframe>


<script language="javascript">
<!--
function MessageCheck(the_form)
{
	if(KillSpace(the_form.Name.value) == "")
	{
		alert("请填写您的姓名");
		the_form.Name.focus();
		return(false);
	}
	if(KillSpace(the_form.Email.value) == "")
	{
		alert("请填写您的电子邮箱地址");
		the_form.Email.focus();
		return(false);		
	}
	if(!IsEmail(the_form.Email.value))
	{
		alert("您填写的电子邮箱地址格式不对，请您重新填写");
		the_form.Email.select();
		return(false);
	}	
	if(KillSpace(the_form.Title.value) == "")
	{
		alert("请填写留言主题");
		the_form.Title.focus()
		return false;
	}
	if(the_form.Content.value.length>1000)
	{
		alert("您填写的留言内容已超过1000个字，请减少至1000字以内");
		the_form.Content.focus();
		return false;
	}
	return(true);
}
function form_submit(the_form)
{
	var bRet = MessageCheck(the_form);
	if (bRet)
	{
		//the_form.target = "hideframe";
		the_form.submit();
		return true;
	}
	return false;
}
function IsEmail(x)
{
	var sEmail, bEmail
	var nAtLoc
	
	sEmail = KillSpace(x);
	nAtLoc=sEmail.indexOf("@")
	bEmail=true
	
	if(!((nAtLoc>1) && (sEmail.lastIndexOf(".")>nAtLoc+1)))
	{		
		bEmail=false			
	}
	if(sEmail.indexOf("@",nAtLoc+1)!=-1)
	{	
		bEmail=false
	}
	if(sEmail.charAt(nAtLoc+1)==".")
	{	
		bEmail=false
	}
	if(sEmail.length - sEmail.lastIndexOf(".")<2)
	{	
		bEmail=false
	}	
	return bEmail		
}
-->
</script>

