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
$PopupRowID=$_GET['PopupRowID'];
if(strlen($PopupRowID)==0)	$PopupRowID=$_POST['PopupRowID'];
if($Act==1)
{
	$rowid=$_POST['rowid'];
	$Flag=$_POST['Flag'];
	$Title=$_POST['Title'];
	$FromWhere=$_POST['FromWhere'];
	$ImportantLevel=$_POST['ImportantLevel'];
	$WindowSize=$_POST['WindowSize'];
	$WindowTop=$_POST['WindowTop'];
	$WindowLeft=$_POST['WindowLeft'];
	$isPopUp=$_POST['isPopUp'];
	$isCloseAuto=$_POST['isCloseAuto'];
	$timeDelay=$_POST['timeDelay'];
	$outTime=$_POST['outTime'];
	$stopDate=$_POST['stopDate'];
	$content=$_POST['content'];
	if(strlen($rowid)==0)
	{
		$rowid=strtoupper(md5($Title.$FromWhere.$Flag.date("Y-m-d H:i:s")));//最后转换成大写
		$SqlStr="Insert Into popupwindow(RowID,Flag,Title,FromWhere,ImportantLevel,WindowSize,WindowTop,WindowLeft,isPopUp,isCloseAuto,timeDelay,Content,outTime,stopDate,ModDate) Values('".$rowid."','".$Flag."','".$Title."','".$FromWhere."','".$ImportantLevel."','".$WindowSize."','".$WindowTop."','".$WindowLeft."','".$isPopUp."','".$isCloseAuto."','".$timeDelay."','".$content."','".$outTime."','".$stopDate."',now())";
	}else
	{
		$SqlStr="Update popupwindow Set Flag='".$Flag."',Title='".$Title."',FromWhere='".$FromWhere."',ImportantLevel='".$ImportantLevel."',WindowSize='".$WindowSize."',WindowTop='".$WindowTop."',WindowLeft='".$WindowLeft."',isPopUp='".$isPopUp."',isCloseAuto='".$isCloseAuto."',timeDelay='".$timeDelay."',Content='".$content."',outTime='".$outTime."',stopDate='".$stopDate."',ModDate=now() Where RowID='".$rowid."'";
	}
	$rs=mysql_query($SqlStr);
	if($rs)//操作成功
	{
		$retstr="<script>alert('记录提交成功!');window.location.href='PopupSet.php?rowid=".$PopupRowID."'</script>";
	}else//操作失败
	{
		$retstr="<script>alert('记录提交失败!');history.back(-1);</script>";
	}
	exit($retstr);	
}
$rowid=$_GET['rowid'];
if(strlen($rowid)==32)
{
	$SqlStr="Select Flag,Title,FromWhere,ImportantLevel,WindowSize,WindowTop,WindowLeft,isPopUp,isCloseAuto,timeDelay,Content,outTime,stopDate from Popupwindow Where RowID='".$rowid."'";
	$rs = mysql_query($SqlStr);
	$row = mysql_fetch_array($rs);
	$Flag=$row['Flag'];
	$Title=$row['Title'];
	$FromWhere=$row['FromWhere'];
	$ImportantLevel=$row['ImportantLevel'];
	$WindowSize=$row['WindowSize'];
	$WindowTop=$row['WindowTop'];
	$WindowLeft=$row['WindowLeft'];
	$isPopUp=$row['isPopUp'];
	$isCloseAuto=$row['isCloseAuto'];
	$timeDelay=$row['timeDelay'];
	$Content=$row['Content'];
	$outTime=strtotime($row['outTime']);
	//将时间转换成日期字符yyyymmdd,再转换成整型格式
	$outTime= date('Y-m-d',$outTime);
	$stopDate=strtotime($row['stopDate']);
	$stopDate= date('Y-m-d',$stopDate);

	mysql_free_result($rs);
}

?>
<div>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="ManageList">
<form name="FrmManage" id="FrmManage" action="EditPopup.php"  method="post"  >
<tr><th colspan="2">增加弹出公告</th></tr>
<tr style="display:none;"><td height="25" width="105" align="right"><font color="red"> *</font>标识字段&nbsp;</td><td height="25" align="left"><input type="text" name="Flag" value="26"></td></tr>
<tr><td height="25" align="right"><font color="red"> *</font>公告标题&nbsp;</td><td height="25" align="left"><input type="text" name="Title" value="<?php echo $Title?>" maxlength="200"></td></tr>
<tr><td height="25" align="right"><font color="red"> *</font>发布部门&nbsp;</td><td height="25" align="left"><input type="text" name="FromWhere" value="<?php echo $FromWhere?>" maxlength="50"></td></tr>
<tr><td height="25" align="right"><font color="red"> *</font>重要程度&nbsp;</td>
	<td align="left">
    <select name="ImportantLevel">
	<option value="0">选择重要程度</option>    
	<?php 
		$SqlStr="Select TypeCode,Type from microtype Where FieldName='ImportantLevel' Order by TypeCode";
		$rs = mysql_query($SqlStr);
	  	while($row = mysql_fetch_array($rs)) 
		{
			$TypeCode=$row['TypeCode'];
			$Type=$row['Type'];
	    	echo '<option value="'.$TypeCode.'"';
			if (intval($TypeCode)==$ImportantLevel) echo ' selected';
			echo '>'.$Type.'</option>';
		}
	mysql_free_result($rs);
	?>
    </select></td></tr>
<tr><td height="25" align="right"><font color="red"> *</font>窗口大小&nbsp;</td>
	<td height="25" align="left">
    	<select name="WindowSize">
        	<option value="0">选择窗口大小</option>
	<?php 
		$SqlStr="Select TypeCode,Type from microtype Where FieldName='WindowSize' Order by TypeCode";
		$rs = mysql_query($SqlStr);
	  	while($row = mysql_fetch_array($rs)) 
		{
			$TypeCode=$row['TypeCode'];
			$Type=$row['Type'];
	    	echo '<option value="'.$TypeCode.'"';
			if (intval($TypeCode)==$WindowSize) echo ' selected';
			echo '>'.$Type.'</option>';
		}
	mysql_free_result($rs);
	?>
        </select></td></tr>
<tr><td height="25" width="105" nowrap="nowrap" align="right"><font color="red"> *</font>窗口距顶</td><td height="25" align="left"><input type="text" name="WindowTop" value="<?php echo $WindowTop?>" maxlength="4"></td></tr>
<tr><td height="25" align="right"><font color="red"> *</font>窗口距左</td><td height="25" align="left"><input type="text" name="WindowLeft" value="<?php echo $WindowLeft?>" maxlength="4"></td></tr>
<tr><td height="25" align="right"><font color="red"> *</font>自动弹出</td>
	<td height="25" align="left">
    	<select name="isPopUp">
        	<option value="0">选择自动弹出</option>
	<?php 
		$SqlStr="Select TypeCode,Type from microtype Where FieldName='isPopUp' Order by TypeCode";
		$rs = mysql_query($SqlStr);
	  	while($row = mysql_fetch_array($rs)) 
		{
			$TypeCode=$row['TypeCode'];
			$Type=$row['Type'];
	    	echo '<option value="'.$TypeCode.'"';
			if (intval($TypeCode)==$isPopUp) echo ' selected';
			echo '>'.$Type.'</option>';
		}
	mysql_free_result($rs);
	?>
        </select></td></tr>
<tr><td height="25" align="right"><font color="red"> *</font>自动关闭</td>
	<td height="25" align="left">
    	<select name="isCloseAuto">
        	<option value="0">选择自动关闭</option>
	<?php 
		$SqlStr="Select TypeCode,Type from microtype Where FieldName='isCloseAuto' Order by TypeCode";
		$rs = mysql_query($SqlStr);
	  	while($row = mysql_fetch_array($rs)) 
		{
			$TypeCode=$row['TypeCode'];
			$Type=$row['Type'];
	    	echo '<option value="'.$TypeCode.'"';
			if (intval($TypeCode)==$isCloseAuto) echo ' selected';
			echo '>'.$Type.'</option>';
		}
	mysql_free_result($rs);
	?>
        </select></td></tr>
<tr><td height="25" align="right"><font color="red"> *</font>延迟关闭(分钟)</td>
	<td height="25" align="left"><input type="text" name="timeDelay" value="<?php echo $timeDelay?>" maxlength="4"></td></tr>
<tr><td height="25" align="right"><font color="red"> *</font>发布日期</td><td height="25" align="left"><input type="text" name="outTime" 	value="<?php if(strlen($rowid)==32) {echo $outTime;}else{echo date('Y-m-d');}?>"  size="6"maxlength="16">&nbsp;</td></tr>
<tr>
  <td align="right" valign="top"><font color="red"> *</font>截止日期</td>
  <td align="left"><input type="text" name="stopDate" 	value="<?php if(strlen($rowid)==32) {echo $stopDate;}else{echo date('Y-m-d');}?>" size="6" maxlength="16">&nbsp;<input type="button" id="btnEditContent" value="编辑公告内容" onclick="javascript:editContent();"  onmouseover="javascript:changebtn(this);" onmouseout="javascript:changebtn(this);"></td>
</tr>
<tr><td align="right" valign="top"><font color="red"> *</font>公告内容</td>
	<td align="left"><div id="div_Content" style="display:block;"><?php echo $Content?></div><div id="div_UE" style="display:none;"><script id="editor" type="text/plain" style="width:<?php echo $width?>;height:<?php echo $height?>;"></script></div></td></tr>
<tr align="right"><td colspan="2"></td></tr>
<tr><td width="105"></td><td width="529">
	        <input type="hidden" name="rowid" value="<?php echo $rowid?>">
	        <input type="hidden" name="content" id="content">
	        <input type="hidden" name="Act" id="Act" value="1">
	        <input type="hidden" name="PopupRowID" value="<?php echo $PopupRowID?>">
 			<input type="hidden" name="NotNullFeild" value="Flag,Title,FromWhere,WindowTop,WindowLeft,timeDelay,Content,outTime,stopDate">
            <input type="hidden" name="NotNullDesc" value="标识字段,公告标题,发布部门,窗口距顶,窗口距左,延迟关闭(分钟),公告内容,发布日期,截止日期" > 			
            <input type="hidden" name="EregPattern" value="d,C,C,d,d,d,C,date,date"></td></tr>
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