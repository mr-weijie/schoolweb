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
	$TeacherName=$_POST['TeacherName'];
	$TermName=$_POST['TermName'];
	$Title=$_POST['Title'];
	$KeBiaoContent=$_POST['content'];
	if(strlen($rowid)==0)
	{
		$rowid=strtoupper(md5($Title.$content.$Flag.date("Y-m-d H:i:s")));//最后转换成大写
		$SqlStr="Insert Into infosearch_teakebiao(RowID,Flag,TeacherName,TermName,Title,KeBiaoContent) Values('".$rowid."','".$Flag."','".$TeacherName."','".$TermName."','".$Title."','".$KeBiaoContent."')";
	}else
	{
		$SqlStr="Update infosearch_teakebiao Set TeacherName='".$TeacherName."',TermName='".$TermName."',Title='".$Title."',KeBiaoContent='".$KeBiaoContent."' Where RowID='".$rowid."'";
	}
	$rs=mysql_query($SqlStr);
	if($rs)//操作成功
	{
		$retstr="<script>alert('记录提交成功!');window.location.href='TeacherClassList.php?rowid=".$FlagRowID."&CurPage=".$CurPage."'</script>";
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
	$SqlStr="Select ID,RowID,Flag,TeacherName,TermName,Title,KeBiaoContent from infosearch_teakebiao Where RowID='".$rowid."'";
	$rs = mysql_query($SqlStr);
	$row = mysql_fetch_array($rs);
	$Flag=$row['Flag'];
	$TeacherName=$row['TeacherName'];
	$TermName=$row['TermName'];
	$Title=$row['Title'];
	$Content=$row['KeBiaoContent'];
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
<tr><td height="25" align="right"><font color="red"> *</font>教师名称&nbsp;</td><td height="25" align="left"><input type="text" name="TeacherName" value="<?php echo $TeacherName?>" size="50" maxlength="200">&nbsp;&nbsp;<input type="button" id="btnEditContent" value="编辑文章内容" onclick="javascript:editContent();"  onmouseover="javascript:changebtn(this);" onmouseout="javascript:changebtn(this);"></td></tr>
<tr><td height="25" align="right"><font color="red"> *</font>学期名称&nbsp;</td><td height="25" align="left">
<select name="TermName">
<option value="0">选择学期名称</option>
<?php 
	$SqlStr="Select TermName from InfoSearch_Term order by TermName";
	$rs = mysql_query($SqlStr);
  	while($row = mysql_fetch_array($rs)) 
	{
		$Name=$row['TermName'];
    	echo '<option value="'.$Name.'" ';
		if($Name==$TermName) echo 'selected';
		echo '>'.$Name.'</option>';
	}
	mysql_free_result($rs);
?>
</select>&nbsp;&nbsp;
</td></tr>
<tr><td height="25" align="right"><font color="red"> *</font>课表名称&nbsp;</td><td height="25" align="left"><input type="text" name="Title" value="<?php echo $Title?>" size="50" maxlength="200">&nbsp;&nbsp;</td></tr>
<tr><td align="right" valign="top"><font color="red"> *</font>课表内容&nbsp;</td>
	<td align="left"><div id="div_Content" style="display:block;"><?php echo $Content?></div><div id="div_UE" style="display:<?php if(strlen($rowid)>0) {echo 'none;';}else{echo 'block;';}?>"><script id="editor" type="text/plain" style="width:100%;height:550px"></script></div></td></tr>
<tr align="right"><td colspan="2"></td></tr>
<tr><td width="75"></td><td width="559">
	        <input type="hidden" name="rowid" value="<?php echo $rowid?>">
	        <input type="hidden" name="content" id="content">
	        <input type="hidden" name="Act" id="Act" value="1">
			<input type="hidden" name="flagrowid" value="<?php echo $Flagrowid?>" />
			<input type="hidden" name="CurPage" value="<?php echo $CurPage?>" />
	        <input type="hidden" name="ArticleRowID" value="<?php echo $ArticleRowID?>">
 			<input type="hidden" name="NotNullFeild" value="Flag,ClassName,TermName,Title,Content">
            <input type="hidden" name="NotNullDesc" value="标识字段,班级名称,学期名称,课表名称,课表内容" > 			
            <input type="hidden" name="EregPattern" value="d,C,C,C,C"></td></tr>
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
		var content=getContent();
		if(content.length==0) content=document.getElementById("div_Content").innerHTML;
		if(content.length==0)
		{
			alert("提交的内容不能为空！");
			return false;
		}
		document.getElementById("content").value=content;
		SaveRecord(true);
		//document.getElementById("FrmManage").submit();
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