<?PHP include '../Inc/conn.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>编辑记录</title>
<link rel="stylesheet" href="/css/style.css" type="text/css">
<script type="text/javascript" src="/js/std.js"></script>
    <script type="text/javascript" charset="utf-8" src="/adm/editor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/adm/editor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/adm/editor/lang/zh-cn/zh-cn.js"></script>
    <style type="text/css">
        div{
            width:100%;
        }
    </style>
</head>
<body>
<?php 
$Act=$_POST['Act'];
$FlagRowID=$_GET['flagrowid'];
$Flag=$_GET['flag'];
$CurPage=$_GET['CurPage'];
if($CurPage=='') $CurPage=$_POST['CurPage'];
if($CurPage=='') $CurPage=1;
if(strlen($FlagRowID)==0)	$FlagRowID=$_POST['flagrowid'];
if($Act==1)
{
	$rowid=$_POST['rowid'];
	$Flag=$_POST['Flag'];
	$ISDN=$_POST['ISDN'];
	$Name=$_POST['Name'];
	$Kanhao=$_POST['Kanhao'];
	$Publish=$_POST['Publish'];
	if(strlen($rowid)==0)
	{
		$rowid=strtoupper(md5($Name.$Kanhao.date("Y-m-d H:i:s")));//最后转换成大写
		$SqlStr="Insert Into Qikan(RowID,Flag,ISDN,Name,Kanhao,Publish) Values('".$rowid."','".$Flag."','".$ISDN."','".$Name."','".$Author."','".$Publish."')";
	}else
	{
		$SqlStr="Update Qikan Set ISDN='".$ISDN."',Name='".$Name."',Kanhao='".$Kanhao."',Publish='".$Publish."' Where RowID='".$rowid."'";
	}
	$rs=mysql_query($SqlStr);
	if($rs)//操作成功
	{
		$retstr="<script>alert('记录提交成功!');window.location.href='QikanList.php?rowid=".$FlagRowID."&CurPage=".$CurPage."'</script>";
	}else//操作失败
	{
		$retstr="<script>alert('记录提交失败!');history.back(-1);</script>";
	}
	exit($retstr);	
	//echo $SqlStr;
	//echo 'IntroduceList.php?rowid='.$IntroduceRowID;
}
$rowid=$_GET['rowid'];
if(strlen($rowid)==32)
{
	$SqlStr="Select ID,RowID,Flag,ISDN,Name,Kanhao,Publish from Qikan Where RowID='".$rowid."'";
	$rs = mysql_query($SqlStr);
	$row = mysql_fetch_array($rs);
	$Flag=$row['Flag'];
	$ISDN=$row['ISDN'];
	$Name=$row['Name'];
	$Kanhao=$row['Kanhao'];
	$Publish=$row['Publish'];
	mysql_free_result($rs);
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
<div>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="ManageList">
<form name="FrmManage" id="FrmManage" method="post"  >
<tr><th colspan="2"><?php if(strlen($rowid)>0) {echo '编辑'.$FunctionName;} else {echo '新增<font color="#FF0000"><b>'.$FunctionName.'</b></font>记录';}?></th></tr>
<tr style="display:none;"><td height="25" width="75" align="right"><font color="red"> *</font>标识字段&nbsp;</td><td height="25" align="left"><input type="text" name="Flag" value="<?php echo $Flag?>"></td></tr>
<tr><td height="25" align="right"><font color="red"> *</font>期刊编号&nbsp;</td><td height="25" align="left"><input type="text" name="ISDN" value="<?php echo $ISDN?>" size="50" maxlength="200">&nbsp;&nbsp;</td></tr>
<tr><td height="25" align="right"><font color="red"> *</font>期刊名称&nbsp;</td><td height="25" align="left"><input type="text" name="Name" value="<?php echo $Name?>" size="50" maxlength="200">&nbsp;&nbsp;
</td></tr>
<tr><td height="25" align="right"><font color="red"> *</font>期刊刊号&nbsp;</td><td height="25" align="left"><input type="text" name="Kanhao" value="<?php echo $Kanhao?>" size="50" maxlength="200">&nbsp;&nbsp;</td></tr>
<tr><td height="25" align="right"><font color="red"> *</font>出版社&nbsp;</td><td height="25" align="left"><input type="text" name="Publish" value="<?php echo $Publish?>" size="50" maxlength="200">&nbsp;&nbsp;</td></tr>
<tr align="right"><td colspan="2"></td></tr>
<tr><td width="75"></td><td width="559">
	        <input type="hidden" name="rowid" value="<?php echo $rowid?>">
	        <input type="hidden" name="content" id="content">
	        <input type="hidden" name="Act" id="Act" value="1">
			<input type="hidden" name="flagrowid" value="<?php echo $Flagrowid?>" />
			<input type="hidden" name="CurPage" value="<?php echo $CurPage?>" />
	        <input type="hidden" name="ArticleRowID" value="<?php echo $ArticleRowID?>">
 			<input type="hidden" name="NotNullFeild" value="Flag,ISDN,Name,Kanhao,Publish">
            <input type="hidden" name="NotNullDesc" value="标识字段,期刊编号,期刊名称,期刊刊号,出版社" > 			
            <input type="hidden" name="EregPattern" value="d,C,C,C,C,C,C"></td></tr>
<tr><td colspan="2" align="center" height="30">
		<input name="save" type="button" style="BACKGROUND-IMAGE: url(/adm/images/save.gif)" class="ManageButtonExt" alt="保存" onclick="submitContent();"  onmouseover="javascript:changebtn(this);" onmouseout="javascript:changebtn(this);">&nbsp;<input name="back" type="button" style="BACKGROUND-IMAGE: url(/adm/images/back.gif)" class="ManageButtonExt" alt="返回" onclick="javascript:Back();"  onmouseover="javascript:changebtn(this);" onmouseout="javascript:changebtn(this);">&nbsp;</td></tr>
        </form></table>
</div>


<script type="text/javascript">
    //必须先实例化编辑器，否则，会出现对象属性为空或不是对象的错误
    var ue = UE.getEditor('editor');

    function getContent() {
	  return UE.getEditor('editor').getContent();
    }

     function setContent(contentString,isAppendTo) {
        var arr = [];
        UE.getEditor('editor').setContent(contentString, isAppendTo);
    }
   function submitContent() {
		SaveRecord(true);
    }
   function editContent() {
		document.getElementById("div_UE").style.display="block";
		ue.execCommand('insertHtml', document.getElementById("div_Content").innerHTML);
		document.getElementById("btnEditContent").disabled=true;
        document.getElementById("div_Content").style.display="none";
		//ue.setContent(document.getElementById("textarea").innerHTML,false);
    }
</script>
</body>
</html>