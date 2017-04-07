<?PHP include '../Inc/conn.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>公告</title>
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
$ArticleRowID=$_GET['ArticleRowID'];
$Flag=$_GET['flag'];
if(strlen($ArticleRowID)==0)	$ArticleRowID=$_POST['ArticleRowID'];
if($Act==1)
{
	$rowid=$_POST['rowid'];
	$Flag=$_POST['Flag'];
	$Title=$_POST['Title'];
	$content=$_POST['content'];
	if(strlen($rowid)==0)
	{
		$rowid=strtoupper(md5($Title.$content.$Flag.date("Y-m-d H:i:s")));//最后转换成大写
		$SqlStr="Insert Into tblcontent(RowID,Flag,Auditing,Title,Recommend,Author,OutTime,Content) Values('".$rowid."','".$Flag."','0','".$Title."','0','".$_SESSION['Admin']."',Now(),'".$content."')";
	}else
	{
		$SqlStr="Update tblcontent Set Title='".$Title."',Content='".$content."',outTime=Now() Where RowID='".$rowid."'";
	}
	$rs=mysql_query($SqlStr);
	if($rs)//操作成功
	{
		$retstr="<script>alert('记录提交成功!');window.location.href='ArticleList.php?rowid=".$ArticleRowID."'</script>";
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
	$SqlStr="Select Flag,Title,Content,outTime from tblcontent Where RowID='".$rowid."'";
	$rs = mysql_query($SqlStr);
	$row = mysql_fetch_array($rs);
	$Flag=$row['Flag'];
	$Title=$row['Title'];
	$Content=$row['Content'];
	$outTime=strtotime($row['outTime']);
	//将时间转换成日期字符yyyymmdd,再转换成整型格式
	$outTime= date('Y-m-d',$outTime);
	mysql_free_result($rs);
}

?>
<div>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="ManageList">
<form name="FrmManage" id="FrmManage" action="EditArticle.php" method="post"  >
<tr><th colspan="2">增加弹出公告</th></tr>
<tr style="display:none;"><td height="25" width="75" align="right"><font color="red"> *</font>标识字段&nbsp;</td><td height="25" align="left"><input type="text" name="Flag" value="<?php echo $Flag?>"></td></tr>
<tr><td height="25" align="right"><font color="red"> *</font>文章标题&nbsp;</td><td height="25" align="left"><input type="text" name="Title" value="<?php echo $Title?>" maxlength="200">&nbsp;&nbsp;<input type="button" id="btnEditContent" value="编辑文章内容" onclick="javascript:editContent();"  onmouseover="javascript:changebtn(this);" onmouseout="javascript:changebtn(this);"></td></tr>
<tr><td align="right" valign="top"><font color="red"> *</font>文章内容&nbsp;</td>
	<td align="left"><div id="div_Content" style="display:block;"><?php echo $Content?></div><div id="div_UE" style="display:<?php if(strlen($rowid)>0) {echo 'none;';}else{echo 'block;';}?>"><script id="editor" type="text/plain" style="width:100%;height:550px"></script></div></td></tr>
<tr align="right"><td colspan="2"></td></tr>
<tr><td width="75"></td><td width="559">
	        <input type="hidden" name="rowid" value="<?php echo $rowid?>">
	        <input type="hidden" name="content" id="content">
	        <input type="hidden" name="Act" id="Act" value="1">
	        <input type="hidden" name="ArticleRowID" value="<?php echo $ArticleRowID?>">
 			<input type="hidden" name="NotNullFeild" value="Flag,Title,Content">
            <input type="hidden" name="NotNullDesc" value="标识字段,文章标题,文章内容" > 			
            <input type="hidden" name="EregPattern" value="d,C,C"></td></tr>
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